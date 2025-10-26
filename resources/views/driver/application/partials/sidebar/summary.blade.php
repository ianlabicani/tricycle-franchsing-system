<!-- Application Summary -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Application Summary</h2>

    <div class="space-y-4">
        <div class="flex items-center justify-between pb-3 border-b">
            <span class="text-gray-600">Status</span>
            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                {{ $application->status_label }}
            </span>
        </div>
        <div class="flex items-center justify-between pb-3 border-b">
            <span class="text-gray-600">Type</span>
            <span class="font-bold text-gray-800">{{ ucfirst($application->franchise_type) }}</span>
        </div>
        <div class="flex items-center justify-between pb-3 border-b">
            <span class="text-gray-600">Submitted</span>
            <span class="font-bold text-gray-800">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'Not yet' }}</span>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-gray-600">Processing Time</span>
            <span class="font-bold text-gray-800">10-15 days</span>
        </div>
    </div>
</div>
