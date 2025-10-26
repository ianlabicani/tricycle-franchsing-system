<!-- Submitted Documents Summary -->
@if($application->documents->count() > 0)
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Submitted Documents</h2>

    <div class="space-y-3 mb-4">
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-600">Total Uploaded</span>
            <span class="font-bold text-gray-800">{{ $application->documents->count() }}</span>
        </div>
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-600">Approved</span>
            <span class="font-bold text-green-600">{{ $application->approvedDocuments()->count() }}</span>
        </div>
        <div class="flex items-center justify-between text-sm">
            <span class="text-gray-600">Pending</span>
            <span class="font-bold text-yellow-600">{{ $application->pendingDocuments()->count() }}</span>
        </div>
        @if($application->rejectedDocuments()->count() > 0)
        <div class="flex items-center justify-between text-sm pb-3 border-b">
            <span class="text-gray-600">Rejected</span>
            <span class="font-bold text-red-600">{{ $application->rejectedDocuments()->count() }}</span>
        </div>
        @endif
    </div>

    <a href="#submitted-documents" class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
        <i class="fas fa-eye mr-1"></i>View All Documents
    </a>
</div>
@else
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Submitted Documents</h2>

    <div class="text-center py-6">
        <i class="fas fa-file-upload text-gray-300 text-4xl mb-3"></i>
        <p class="text-gray-600 text-sm">No documents uploaded yet</p>
        @if(in_array($application->status, ['draft', 'incomplete']))
        <a href="{{ route('driver.application.edit', $application) }}" class="block mt-3 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
            <i class="fas fa-plus mr-1"></i>Upload Documents
        </a>
        @endif
    </div>
</div>
@endif
