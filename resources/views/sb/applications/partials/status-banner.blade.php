<!-- Status Banner -->
@if(session('success'))
    <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg mb-6">
        <div class="flex items-center space-x-3">
            <i class="fas fa-check-circle text-green-600 text-xl"></i>
            <p class="text-green-800 font-semibold">{{ session('success') }}</p>
        </div>
    </div>
@endif

<!-- Warning: Not all documents approved -->
@if(!$application->allDocumentsApproved() && !in_array($application->status, ['rejected', 'completed', 'released']))
    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg mb-6">
        <div class="flex items-start space-x-4">
            <i class="fas fa-exclamation-circle text-red-600 text-3xl mt-1"></i>
            <div>
                <h3 class="text-lg font-bold text-red-900">⚠️ Cannot Proceed: Documents Not Approved</h3>
                <p class="text-red-800 mt-1">All documents must be approved before proceeding to the next step. Review the documents section below and approve all items.</p>
                <div class="mt-3 space-y-1 text-sm text-red-700">
                    @if($application->pendingDocuments()->count() > 0)
                        <p><i class="fas fa-clock mr-2"></i><strong>Pending:</strong> {{ $application->pendingDocuments()->count() }} document(s) awaiting review</p>
                    @endif
                    @if($application->rejectedDocuments()->count() > 0)
                        <p><i class="fas fa-times mr-2"></i><strong>Rejected:</strong> {{ $application->rejectedDocuments()->count() }} document(s) requiring re-upload</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endif
