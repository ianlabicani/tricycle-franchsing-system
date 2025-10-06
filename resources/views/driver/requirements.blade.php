@extends('driver.shell')

@section('driver-content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Requirements Submission</h1>
        <p class="text-gray-600 mt-2">Upload and manage your franchise application requirements</p>
    </div>

    <!-- Progress Overview -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-gray-800">Upload Progress</h2>
            <span class="text-2xl font-bold text-green-600">5/5 Complete</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-4">
            <div class="bg-green-600 h-4 rounded-full" style="width: 100%"></div>
        </div>
        <p class="text-sm text-gray-600 mt-2">All required documents have been uploaded and verified.</p>
    </div>

    <!-- Requirements List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <!-- Valid Driver's License -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-id-card text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Valid Driver's License</h3>
                        <p class="text-sm text-gray-500">Professional or Non-Professional</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
            </div>
            <div class="border-t pt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Uploaded on:</span>
                    <span class="font-semibold text-gray-800">Oct 1, 2025</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-2">
                    <span class="text-gray-600">File:</span>
                    <span class="font-semibold text-blue-600">drivers_license.pdf</span>
                </div>
                <div class="mt-4 flex space-x-2">
                    <button class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button class="flex-1 bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition text-sm font-semibold">
                        <i class="fas fa-sync-alt mr-1"></i> Replace
                    </button>
                </div>
            </div>
        </div>

        <!-- Vehicle OR/CR -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-file-alt text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Vehicle OR/CR</h3>
                        <p class="text-sm text-gray-500">Original Registration Certificate</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
            </div>
            <div class="border-t pt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Uploaded on:</span>
                    <span class="font-semibold text-gray-800">Oct 1, 2025</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-2">
                    <span class="text-gray-600">File:</span>
                    <span class="font-semibold text-blue-600">vehicle_orcr.pdf</span>
                </div>
                <div class="mt-4 flex space-x-2">
                    <button class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button class="flex-1 bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition text-sm font-semibold">
                        <i class="fas fa-sync-alt mr-1"></i> Replace
                    </button>
                </div>
            </div>
        </div>

        <!-- Police Clearance -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-shield-alt text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Police Clearance</h3>
                        <p class="text-sm text-gray-500">NBI or Local Police Clearance</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
            </div>
            <div class="border-t pt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Uploaded on:</span>
                    <span class="font-semibold text-gray-800">Oct 2, 2025</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-2">
                    <span class="text-gray-600">File:</span>
                    <span class="font-semibold text-blue-600">police_clearance.pdf</span>
                </div>
                <div class="mt-4 flex space-x-2">
                    <button class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button class="flex-1 bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition text-sm font-semibold">
                        <i class="fas fa-sync-alt mr-1"></i> Replace
                    </button>
                </div>
            </div>
        </div>

        <!-- Barangay Clearance -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-certificate text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Barangay Clearance</h3>
                        <p class="text-sm text-gray-500">From place of residence</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
            </div>
            <div class="border-t pt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Uploaded on:</span>
                    <span class="font-semibold text-gray-800">Oct 2, 2025</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-2">
                    <span class="text-gray-600">File:</span>
                    <span class="font-semibold text-blue-600">brgy_clearance.pdf</span>
                </div>
                <div class="mt-4 flex space-x-2">
                    <button class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button class="flex-1 bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition text-sm font-semibold">
                        <i class="fas fa-sync-alt mr-1"></i> Replace
                    </button>
                </div>
            </div>
        </div>

        <!-- Medical Certificate -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-notes-medical text-green-600 text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800">Medical Certificate</h3>
                        <p class="text-sm text-gray-500">Recent medical examination</p>
                    </div>
                </div>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Verified</span>
            </div>
            <div class="border-t pt-4">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-600">Uploaded on:</span>
                    <span class="font-semibold text-gray-800">Oct 3, 2025</span>
                </div>
                <div class="flex items-center justify-between text-sm mt-2">
                    <span class="text-gray-600">File:</span>
                    <span class="font-semibold text-blue-600">medical_cert.pdf</span>
                </div>
                <div class="mt-4 flex space-x-2">
                    <button class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                        <i class="fas fa-eye mr-1"></i> View
                    </button>
                    <button class="flex-1 bg-gray-600 text-white py-2 rounded-lg hover:bg-gray-700 transition text-sm font-semibold">
                        <i class="fas fa-sync-alt mr-1"></i> Replace
                    </button>
                </div>
            </div>
        </div>

        <!-- Add New Document -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-2 border-dashed border-gray-300 hover:border-blue-500 transition cursor-pointer">
            <div class="flex flex-col items-center justify-center h-full py-8">
                <div class="bg-blue-100 p-4 rounded-full mb-4">
                    <i class="fas fa-plus text-blue-600 text-3xl"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Upload Additional Document</h3>
                <p class="text-sm text-gray-500 text-center">Click to upload any additional required documents</p>
            </div>
        </div>

    </div>

    <!-- Important Notes -->
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-6 rounded-lg mt-8">
        <div class="flex items-start space-x-3">
            <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mt-1"></i>
            <div>
                <h3 class="font-bold text-yellow-800 mb-2">Important Notes:</h3>
                <ul class="list-disc list-inside text-yellow-700 space-y-1 text-sm">
                    <li>All documents must be clear, legible, and in PDF or image format (JPG, PNG)</li>
                    <li>Maximum file size: 5MB per document</li>
                    <li>Documents must be valid and not expired</li>
                    <li>Ensure all information is accurate and matches your application form</li>
                    <li>Once verified, documents cannot be deleted but can be replaced if needed</li>
                </ul>
            </div>
        </div>
    </div>

@endsection
