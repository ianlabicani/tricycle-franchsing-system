<!-- Sidebar modals and scripts -->

<!-- Document Reject Modal -->
<div id="documentRejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Document</h3>
        <form id="documentRejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection <span class="text-red-500">*</span></label>
                <textarea name="reason" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Explain why this document is being rejected..." required></textarea>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeDocumentRejectModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    Reject Document
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Application Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Application</h3>
        <form action="{{ route('sb.applications.reject', $application) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection <span class="text-red-500">*</span></label>
                <textarea name="remarks" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Please provide a clear reason for rejection..." required></textarea>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Review Application</h3>
        <form action="{{ route('sb.applications.review', $application) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-3">Document Completeness <span class="text-red-500">*</span></label>
                <div class="space-y-2">
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="is_complete" value="1" required class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                        <span class="ml-3">
                            <span class="block font-semibold text-gray-800">Complete</span>
                            <span class="text-sm text-gray-600">All documents submitted and acceptable</span>
                        </span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="is_complete" value="0" required class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                        <span class="ml-3">
                            <span class="block font-semibold text-gray-800">Incomplete</span>
                            <span class="text-sm text-gray-600">Missing or incorrect documents</span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Review Notes</label>
                <textarea name="remarks" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Add notes about missing documents or review details..."></textarea>
                <p class="text-xs text-gray-500 mt-1">If marking as incomplete, specify which documents are missing or invalid</p>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeReviewModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let documentToReject = null;

    function openRejectModal(documentId) {
        if (documentId) {
            documentToReject = documentId;
            const form = document.getElementById('documentRejectForm');
            const appId = '{{ $application->id }}';
            form.action = `/sb/applications/${appId}/documents/${documentId}/reject`;
            document.getElementById('documentRejectModal').classList.remove('hidden');
            document.getElementById('documentRejectModal').classList.add('flex');
        } else {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('flex');
    }

    function closeDocumentRejectModal() {
        document.getElementById('documentRejectModal').classList.add('hidden');
        document.getElementById('documentRejectModal').classList.remove('flex');
        documentToReject = null;
    }

    function openReviewModal() {
        document.getElementById('reviewModal').classList.remove('hidden');
        document.getElementById('reviewModal').classList.add('flex');
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        document.getElementById('reviewModal').classList.remove('flex');
    }
</script>
