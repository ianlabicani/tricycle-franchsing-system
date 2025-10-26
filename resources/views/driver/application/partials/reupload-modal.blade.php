<!-- Re-upload Modal -->
<div id="reuploadModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 p-4" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-800">Re-upload Document</h3>
                <button type="button" onclick="closeReuploadModal()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <form id="reuploadForm" enctype="multipart/form-data" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" id="documentId" name="document_id">
                <input type="hidden" id="documentType" name="document_type">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select New File</label>
                    <div class="border-2 border-dashed border-orange-300 rounded-lg p-4 text-center hover:border-orange-500 hover:bg-orange-50 transition cursor-pointer" onclick="document.getElementById('fileInput').click()">
                        <input type="file" id="fileInput" name="file" accept="image/*,.pdf" class="hidden" onchange="updateFileName(this)">
                        <i class="fas fa-cloud-upload-alt text-orange-400 text-3xl mb-2"></i>
                        <p class="text-sm font-medium text-gray-600" id="fileName">Click to select or drag and drop</p>
                        <p class="text-xs text-gray-500 mt-1">JPG, PNG, WebP, or PDF</p>
                    </div>
                </div>

                <p class="text-xs text-gray-600 bg-blue-50 p-3 rounded">
                    <i class="fas fa-info-circle mr-1"></i>
                    <strong>Tip:</strong> Make sure the new file addresses the rejection reason provided by the reviewer.
                </p>
            </form>
        </div>

        <div class="bg-gray-50 px-6 py-4 rounded-b-xl flex items-center justify-end space-x-3">
            <button type="button" onclick="closeReuploadModal()" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">
                Cancel
            </button>
            <button type="button" onclick="submitReupload()" class="px-4 py-2 text-white bg-orange-600 rounded-lg hover:bg-orange-700 transition font-semibold text-sm">
                <i class="fas fa-upload mr-1"></i>Re-upload
            </button>
        </div>
    </div>
</div>
