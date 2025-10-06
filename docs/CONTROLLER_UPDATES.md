# Application Lifecycle - Controller Updates

## Issue Fixed

**Error:** `SQLSTATE[01000]: Warning: 1265 Data truncated for column 'status'`

**Cause:** The old code was using `under_review` status which doesn't exist in the new lifecycle enum.

## Changes Made

### 1. ApplicationController Updates

#### `index()` Method - Statistics

**Old:**

```php
'pending' => Application::where('status', 'submitted')->count(),
```

**New:**

```php
'pending' => Application::where('status', 'pending_review')->count(),
'under_review' => Application::whereIn('status', ['incomplete', 'for_scheduling'])->count(),
```

#### `review()` Method - Complete Rewrite

**Old Behavior:**

-   Set status to `under_review` (invalid status)
-   No distinction between complete/incomplete

**New Behavior:**

```php
public function review(Request $request, Application $application)
{
    // Validates is_complete boolean
    $status = $request->is_complete ? 'for_scheduling' : 'incomplete';

    $application->update([
        'status' => $status,
        'remarks' => $request->remarks,
        'reviewed_at' => now(),
        'reviewed_by' => auth()->id(),
    ]);
}
```

**Status Flow:**

-   If documents **complete** → `for_scheduling` (ready for inspection)
-   If documents **incomplete** → `incomplete` (driver must fix)

---

### 2. InspectionController Updates

#### `store()` Method - Scheduling

**Added timestamp tracking:**

```php
$application->update([
    'status' => 'inspection_scheduled',
    'scheduled_at' => now(),  // NEW: Track when scheduled
]);
```

#### `complete()` Method - Inspection Results

**Old:**

```php
'status' => 'inspection_passed'  // Invalid status
```

**New:**

```php
if ($request->result === 'passed') {
    $application->update([
        'status' => 'for_treasury',  // Correct: Next step is payment
        'inspected_at' => now(),
    ]);
} else {
    $application->update([
        'status' => 'inspection_failed',
        'inspected_at' => now(),
    ]);
}
```

#### `cancel()` Method - Cancellation

**Old:**

```php
'status' => 'submitted'  // Invalid: No such status anymore
```

**New:**

```php
'status' => 'for_scheduling'  // Correct: Can be rescheduled
```

---

### 3. View Updates

#### Review Modal (show.blade.php)

**Old:**

-   Simple textarea for notes
-   Sets `under_review` status

**New:**

-   Radio buttons for Complete/Incomplete selection
-   Required `is_complete` boolean field
-   Clear descriptions of each option
-   Conditional messaging based on selection

**New UI:**

```html
<input type="radio" name="is_complete" value="1" /> Complete → All required
documents are valid and ready for scheduling

<input type="radio" name="is_complete" value="0" /> Incomplete → Missing or
invalid documents - requires driver action
```

#### Quick Actions Section

**Updated condition:**

```php
// OLD
@if($application->status !== 'approved' && $application->status !== 'rejected')

// NEW
@if(!in_array($application->status, ['approved', 'rejected', 'released', 'completed']))
```

**Updated button label:**

```html
<!-- OLD -->
<i class="fas fa-search mr-2"></i>Mark as Under Review

<!-- NEW -->
<i class="fas fa-clipboard-check mr-2"></i>Review Documents
```

---

## Complete Status Flow

### Step 2: Initial Review

```
pending_review → [SB Reviews] → incomplete OR for_scheduling
```

**SB Staff Actions:**

1. Click "Review Documents"
2. Select "Complete" or "Incomplete"
3. Add optional notes
4. Submit review

**Results:**

-   **Complete:** Status → `for_scheduling`, can schedule inspection
-   **Incomplete:** Status → `incomplete`, driver notified to fix

### Step 3-4: Inspection Flow

```
for_scheduling → [Schedule] → inspection_scheduled →
[Inspect] → inspection_failed OR for_treasury
```

**Inspection Actions:**

1. Schedule: `for_scheduling` → `inspection_scheduled`
2. Complete (Pass): `inspection_scheduled` → `for_treasury`
3. Complete (Fail): `inspection_scheduled` → `inspection_failed`
4. Cancel: `inspection_scheduled` → `for_scheduling`

---

## Validation

### ApplicationController::review()

```php
'remarks' => 'nullable|string|max:500',
'is_complete' => 'required|boolean',
```

### InspectionController::complete()

```php
'result' => 'required|in:passed,failed',
'remarks' => 'required|string|max:500',
```

---

## Database Fields Updated

### Applications Table

```php
// Timestamps now being set:
- reviewed_at
- scheduled_at
- inspected_at

// Foreign keys being set:
- reviewed_by
- approved_by
- rejected_by
```

---

## Testing Checklist

-   [x] Review application as complete → status becomes `for_scheduling`
-   [x] Review application as incomplete → status becomes `incomplete`
-   [x] Schedule inspection → status becomes `inspection_scheduled`
-   [x] Complete inspection (pass) → status becomes `for_treasury`
-   [x] Complete inspection (fail) → status becomes `inspection_failed`
-   [x] Cancel inspection → status reverts to `for_scheduling`
-   [x] Approve application → status becomes `approved`
-   [x] Reject application → status becomes `rejected`

---

## Next Steps

After these fixes, the application lifecycle now correctly follows:

```
draft → pending_review → [incomplete → for_scheduling] →
inspection_scheduled → [inspection_failed → for_scheduling] →
for_treasury → for_approval → approved → released → completed
```

All status transitions are now valid and tracked with proper timestamps!
