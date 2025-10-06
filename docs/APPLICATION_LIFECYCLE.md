# Tricycle Franchise Application Lifecycle

This document outlines the complete lifecycle of a tricycle franchise application from submission to renewal.

## Status Flow Diagram

```
draft → pending_review → [incomplete OR for_scheduling] → inspection_scheduled →
inspection_pending → [inspection_failed OR for_treasury] → for_approval →
[approved → released → completed → for_renewal] OR [rejected]
```

## Lifecycle Steps

### Step 1: Application Submission

**Status:** `pending_review`  
**Actor:** Driver  
**Table:** applications

**Description:**  
Driver submits the franchise application and uploads all required documents.

**Required Documents:**

-   Official Receipt/Certificate of Registration (OR/CR)
-   Cedula
-   2x2 Picture
-   Vehicle Stencil
-   Tricycle Photo

**Actions:**

1. Fill out application form with personal and vehicle information
2. Upload all required documents
3. Submit to SB for review
4. System sets `date_submitted` timestamp
5. Status changes from `draft` to `pending_review`

**Next Status:** `for_scheduling` or `incomplete`

---

### Step 2: Initial Review by SB Staff

**Status:** `incomplete` or `for_scheduling`  
**Actor:** SB Staff  
**Table:** applications

**Description:**  
SB staff reviews the submitted application and verifies all required documents are complete and valid.

**Actions:**

1. Review application details
2. Verify all required documents are uploaded
3. Check document validity and quality
4. If incomplete:
    - Set status to `incomplete`
    - Add remarks about missing/invalid documents
    - Notify driver
5. If complete:
    - Set status to `for_scheduling`
    - Record `reviewed_at` timestamp
    - Record `reviewed_by` user ID

**Next Status:** `inspection_scheduled`

---

### Step 3: Scheduling of Vehicle Inspection

**Status:** `inspection_scheduled`  
**Actor:** SB Staff  
**Table:** inspections

**Description:**  
SB staff schedules a vehicle inspection by setting a date, time, queue number, and assigning an inspector.

**Actions:**

1. Create inspection record linked to application
2. Set inspection date and time
3. Assign queue number to application
4. Assign inspector
5. Set inspection location
6. Record `scheduled_at` timestamp
7. Status changes to `inspection_scheduled`
8. Notify driver of inspection schedule

**Inspection Fields:**

-   `scheduled_date`
-   `scheduled_time`
-   `inspector_name`
-   `location`
-   `queue_number` (on application)
-   `scheduled_by` (SB staff user ID)

**Next Status:** `inspection_pending`

---

### Step 4: Vehicle Inspection

**Status:** `inspection_pending`, then `inspection_failed` or `for_treasury`  
**Actor:** Inspector or SB Staff  
**Table:** inspections

**Description:**  
Inspector performs physical inspection of the vehicle and verifies all documents.

**Inspection Checklist:**

-   Vehicle condition and roadworthiness
-   Engine and chassis numbers match documents
-   Plate number verification
-   Safety features (lights, brakes, etc.)
-   Document authenticity verification
-   Vehicle photo capture

**Actions:**

1. Status set to `inspection_pending` when inspector starts
2. Perform vehicle inspection using checklist
3. Verify all documents
4. Take inspection photo
5. Record inspection results:
    - **Approved:** Vehicle passes all checks
        - Set `result` to `passed`
        - Set status to `for_treasury`
    - **Failed:** Vehicle doesn't meet requirements
        - Set `result` to `failed`
        - Set status to `inspection_failed`
        - Add remarks about failure reasons
    - **Needs Repair:** Minor issues requiring fixing
        - Driver fixes issues and re-inspection scheduled
6. Record `inspected_at` timestamp
7. Upload inspection photo

**Next Status:**

-   If passed: `for_treasury`
-   If failed: `inspection_failed`
-   If needs repair: remains `inspection_pending` or reschedule

---

### Step 5: Payment and Treasury Verification

**Status:** `for_treasury`  
**Actor:** Driver and Treasury Staff  
**Table:** applications

**Description:**  
Driver pays all required fees and treasury staff verifies the payments.

**Required Fees:**

-   Filing Fee
-   Franchise Fee
-   Mayor's Permit Fee
-   Sticker/Decal Fee
-   Other applicable fees

**Actions:**

1. Driver receives payment breakdown
2. Driver pays fees at treasury office
3. Driver uploads payment receipts
4. Treasury staff verifies receipts
5. Treasury staff confirms payment amounts
6. Record `payment_verified_at` timestamp
7. Status changes to `for_approval`

**Next Status:** `for_approval`

---

### Step 6: SB Approval Process

**Status:** `for_approval`, then `approved` or `rejected`  
**Actor:** SB Office / Approving Officer  
**Table:** applications

**Description:**  
SB reviews all completed steps and makes final approval decision.

**Review Checklist:**

-   All documents complete and verified
-   Inspection passed
-   All fees paid and verified
-   No outstanding violations
-   Meets all franchise requirements

**Actions:**

1. Review complete application package
2. Verify inspection results
3. Verify payment receipts
4. Make approval decision:
    - **Approve:**
        - Set status to `approved`
        - Record `date_approved` timestamp
        - Record `approved_by` user ID
        - Generate franchise document
        - Upload approved franchise PDF
    - **Reject:**
        - Set status to `rejected`
        - Record `rejected_at` timestamp
        - Record `rejected_by` user ID
        - Add rejection remarks
        - Notify driver of rejection reason

**Next Status:**

-   If approved: `released`
-   If rejected: `rejected` (end)

---

### Step 7: Document Release

**Status:** `released` then `completed`  
**Actor:** SB Staff  
**Table:** applications

**Description:**  
SB releases the approved hard copy franchise document to the driver.

**Actions:**

1. Prepare physical franchise document
2. Driver visits SB office to claim
3. Verify driver identity
4. Driver signs release form
5. Hand over franchise document
6. Record `released_at` timestamp
7. Record `released_by` user ID
8. Set franchise expiration date (typically 1 year)
9. Status changes to `released`
10. Mark as `completed` when all steps done
11. Record `completed_at` timestamp

**Next Status:** `for_renewal` (when approaching expiration)

---

### Step 8: Franchise Renewal Notification

**Status:** `for_renewal`  
**Actor:** System / Driver  
**Table:** applications

**Description:**  
System automatically reminds driver before franchise expiration and allows renewal application.

**Actions:**

1. System checks expiration dates daily
2. 30 days before expiration:
    - Send first reminder email/SMS
    - Update status to `for_renewal`
    - Record `renewal_reminder_sent_at`
3. 15 days before expiration:
    - Send second reminder
4. 7 days before expiration:
    - Send final reminder
5. Driver clicks renewal link
6. System creates new application:
    - Set `franchise_type` to `renewal`
    - Pre-fill data from previous application
    - Status set to `pending_review`
    - Link to previous application

**Next Status:** `pending_review` (new renewal application)

---

## Status Definitions

| Status               | Code                   | Description                         | Can Transition To                   |
| -------------------- | ---------------------- | ----------------------------------- | ----------------------------------- |
| Draft                | `draft`                | Application being prepared          | `pending_review`                    |
| Pending Review       | `pending_review`       | Submitted, awaiting SB review       | `incomplete`, `for_scheduling`      |
| Incomplete           | `incomplete`           | Missing required documents          | `for_scheduling`                    |
| For Scheduling       | `for_scheduling`       | Ready for inspection scheduling     | `inspection_scheduled`              |
| Inspection Scheduled | `inspection_scheduled` | Inspection date/time set            | `inspection_pending`                |
| Inspection Pending   | `inspection_pending`   | Waiting for/during inspection       | `inspection_failed`, `for_treasury` |
| Inspection Failed    | `inspection_failed`    | Vehicle failed inspection           | `inspection_scheduled` (retry)      |
| For Treasury         | `for_treasury`         | Passed inspection, payment pending  | `for_approval`                      |
| For Approval         | `for_approval`         | Payment verified, awaiting approval | `approved`, `rejected`              |
| Approved             | `approved`             | Application approved by SB          | `released`                          |
| Rejected             | `rejected`             | Application rejected                | (end state)                         |
| Released             | `released`             | Documents released to driver        | `completed`                         |
| Completed            | `completed`            | All steps completed                 | `for_renewal`                       |
| For Renewal          | `for_renewal`          | Approaching/past expiration         | `pending_review` (new app)          |

---

## Database Schema

### Applications Table Fields

```php
// Core fields
id, user_id, application_no, queue_number, franchise_type, purpose, status, remarks

// Timestamps
date_submitted, date_approved, reviewed_at, scheduled_at, inspected_at,
payment_verified_at, rejected_at, released_at, completed_at,
expiration_date, renewal_reminder_sent_at

// Actor tracking
reviewed_by, approved_by, rejected_by, released_by

// Standard timestamps
created_at, updated_at
```

### Inspections Table Fields

```php
// Core fields
id, application_id, scheduled_date, scheduled_time, inspector_name, location,
status, result, notes, remarks, cancellation_reason

// Timestamps
completed_at, cancelled_at

// Actor tracking
scheduled_by, completed_by, cancelled_by

// Standard timestamps
created_at, updated_at
```

---

## Color Coding for UI

| Status Group | Color        | Statuses                                                       |
| ------------ | ------------ | -------------------------------------------------------------- |
| Gray         | Neutral      | `draft`                                                        |
| Yellow       | Warning      | `pending_review`                                               |
| Orange       | Alert        | `incomplete`                                                   |
| Blue         | In Progress  | `for_scheduling`, `inspection_scheduled`, `inspection_pending` |
| Red          | Error/Failed | `inspection_failed`, `rejected`                                |
| Indigo       | Processing   | `for_treasury`, `for_approval`                                 |
| Green        | Success      | `approved`, `released`, `completed`                            |
| Purple       | Renewal      | `for_renewal`                                                  |

---

## Notifications

### Email/SMS Triggers

1. **Application Submitted** → Driver confirmation
2. **Application Incomplete** → Driver with missing items list
3. **Inspection Scheduled** → Driver with date/time/location/queue number
4. **Inspection Failed** → Driver with failure reasons
5. **Payment Required** → Driver with fee breakdown
6. **Application Approved** → Driver success notification
7. **Application Rejected** → Driver with rejection reason
8. **Documents Ready** → Driver to claim documents
9. **Renewal Reminder** → Driver 30/15/7 days before expiration
10. **Franchise Expired** → Driver if not renewed

---

## Business Rules

1. **Document Requirements:**

    - All 5 documents must be uploaded before `for_scheduling`
    - Documents must be clear and valid
    - Vehicle photos must show plate number

2. **Inspection Rules:**

    - Can only schedule if status is `for_scheduling`
    - Failed inspection can be retried after repairs
    - Maximum 3 inspection attempts allowed

3. **Payment Rules:**

    - Must pass inspection before payment
    - All fees must be paid in full
    - Payment valid for 30 days

4. **Approval Rules:**

    - SB can only approve if payment verified
    - Rejection requires detailed remarks
    - Approved applications cannot be reversed

5. **Renewal Rules:**
    - Franchise valid for 1 year from release date
    - Renewal reminder sent 30 days before expiration
    - Late renewals may require additional penalty fee
    - Expired >60 days requires new application

---

## Migration Commands

```bash
# Run all migrations
php artisan migrate

# Rollback if needed
php artisan migrate:rollback
```

---

## Related Files

-   Models: `app/Models/Application.php`, `app/Models/Inspection.php`
-   Controllers: `app/Http/Controllers/SB/ApplicationController.php`, `app/Http/Controllers/SB/InspectionController.php`
-   Views: `resources/views/sb/applications/`, `resources/views/sb/inspections/`
-   Migrations: `database/migrations/*_applications_*.php`, `database/migrations/*_inspections_*.php`
