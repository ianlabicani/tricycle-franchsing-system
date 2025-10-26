<!-- Success Modal -->
<div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 p-4" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <div class="p-6 text-center">
            <div class="mb-4">
                <i class="fas fa-check-circle text-green-500 text-5xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Success!</h3>
            <p class="text-gray-600 mb-6">Document re-uploaded successfully! It will be reviewed shortly.</p>
        </div>
        <div class="bg-gray-50 px-6 py-4 rounded-b-xl">
            <button type="button" onclick="confirmSuccess()" class="w-full px-4 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700 transition font-semibold">
                Done
            </button>
        </div>
    </div>
</div>

<!-- Error Modal -->
<div id="errorModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 p-4" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <div class="p-6 text-center">
            <div class="mb-4">
                <i class="fas fa-exclamation-circle text-red-500 text-5xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Error</h3>
            <p class="text-gray-600 mb-6" id="errorMessage">An error occurred. Please try again.</p>
        </div>
        <div class="bg-gray-50 px-6 py-4 rounded-b-xl">
            <button type="button" onclick="closeErrorModal()" class="w-full px-4 py-2 text-white bg-red-600 rounded-lg hover:bg-red-700 transition font-semibold">
                Close
            </button>
        </div>
    </div>
</div>

<!-- Validation Modal -->
<div id="validationModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50 p-4" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full">
        <div class="p-6 text-center">
            <div class="mb-4">
                <i class="fas fa-info-circle text-yellow-500 text-5xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Validation Required</h3>
            <p class="text-gray-600 mb-6" id="validationMessage">Please select a file to upload.</p>
        </div>
        <div class="bg-gray-50 px-6 py-4 rounded-b-xl">
            <button type="button" onclick="closeValidationModal()" class="w-full px-4 py-2 text-white bg-yellow-600 rounded-lg hover:bg-yellow-700 transition font-semibold">
                OK
            </button>
        </div>
    </div>
</div>
