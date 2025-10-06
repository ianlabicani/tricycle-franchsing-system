@extends('driver.shell')

@section('driver-content')

    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Vehicle Inspection</h1>
        <p class="text-gray-600 mt-2">Schedule and track your vehicle inspection appointments</p>
    </div>

    <!-- Current Inspection Status -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h2 class="text-2xl font-bold mb-2">Inspection Scheduled</h2>
                <p class="text-blue-100">Your vehicle inspection has been confirmed</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <i class="fas fa-clipboard-check text-5xl"></i>
            </div>
        </div>

        <div class="grid md:grid-cols-4 gap-6 mt-6">
            <div class="bg-white bg-opacity-10 rounded-lg p-4">
                <p class="text-blue-100 text-sm mb-1">Date</p>
                <p class="text-xl font-bold">Oct 12, 2025</p>
            </div>
            <div class="bg-white bg-opacity-10 rounded-lg p-4">
                <p class="text-blue-100 text-sm mb-1">Time</p>
                <p class="text-xl font-bold">10:00 AM</p>
            </div>
            <div class="bg-white bg-opacity-10 rounded-lg p-4">
                <p class="text-blue-100 text-sm mb-1">Queue Number</p>
                <p class="text-xl font-bold">#15</p>
            </div>
            <div class="bg-white bg-opacity-10 rounded-lg p-4">
                <p class="text-blue-100 text-sm mb-1">Inspector</p>
                <p class="text-xl font-bold">Insp. Reyes</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Inspection Details -->
        <div class="lg:col-span-2 space-y-6">

            <!-- Inspection Information -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Inspection Details</h2>

                <div class="space-y-4">
                    <div class="flex items-start space-x-4 pb-4 border-b border-gray-200">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <i class="fas fa-map-marker-alt text-blue-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 mb-1">Location</h3>
                            <p class="text-gray-600">Main Office Parking Area</p>
                            <p class="text-sm text-gray-500 mt-1">123 Franchise Center, Your City</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 pb-4 border-b border-gray-200">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <i class="fas fa-user-tie text-green-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 mb-1">Assigned Inspector</h3>
                            <p class="text-gray-600">Inspector Reyes</p>
                            <p class="text-sm text-gray-500 mt-1">Contact: +63 912 345 6789</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 pb-4 border-b border-gray-200">
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <i class="fas fa-car text-purple-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 mb-1">Vehicle Details</h3>
                            <p class="text-gray-600">Plate Number: ABC-1234</p>
                            <p class="text-sm text-gray-500 mt-1">Unit: TC-045 | Route: Route A</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-orange-100 p-3 rounded-lg">
                            <i class="fas fa-clock text-orange-600 text-xl"></i>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-gray-800 mb-1">Estimated Duration</h3>
                            <p class="text-gray-600">30-45 minutes</p>
                            <p class="text-sm text-gray-500 mt-1">Please arrive 15 minutes early</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex space-x-3">
                    <button class="flex-1 bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-directions mr-2"></i>Get Directions
                    </button>
                    <button class="flex-1 bg-orange-600 text-white py-3 rounded-lg hover:bg-orange-700 transition font-semibold">
                        <i class="fas fa-calendar-alt mr-2"></i>Reschedule
                    </button>
                </div>
            </div>

            <!-- Inspection Checklist -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Inspection Checklist</h2>

                <div class="space-y-3">
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        <span class="text-gray-800">Vehicle lights (headlights, taillights, brake lights)</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        <span class="text-gray-800">Braking system functionality</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        <span class="text-gray-800">Tire condition and tread depth</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        <span class="text-gray-800">Engine condition and emissions</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        <span class="text-gray-800">Body and frame condition</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        <span class="text-gray-800">Safety equipment (mirrors, horn, seatbelts)</span>
                    </div>
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                        <span class="text-gray-800">Registration and documentation</span>
                    </div>
                </div>
            </div>

            <!-- Previous Inspections -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">Inspection History</h2>

                <div class="space-y-4">
                    <div class="flex items-start space-x-4 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-gray-800">Annual Inspection 2024</h3>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Passed</span>
                            </div>
                            <p class="text-sm text-gray-600">Date: March 15, 2024 | Inspector: Insp. Cruz</p>
                            <p class="text-sm text-gray-500 mt-1">Score: 95/100 | No major issues found</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <i class="fas fa-check-circle text-green-600 text-2xl mt-1"></i>
                        <div class="flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <h3 class="font-bold text-gray-800">Initial Inspection 2023</h3>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">Passed</span>
                            </div>
                            <p class="text-sm text-gray-600">Date: June 10, 2023 | Inspector: Insp. Reyes</p>
                            <p class="text-sm text-gray-500 mt-1">Score: 92/100 | Minor brake adjustment needed</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- What to Bring -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">What to Bring</h2>

                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-check text-blue-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Original OR/CR</p>
                            <p class="text-sm text-gray-500">Official Receipt & Certificate of Registration</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-check text-blue-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Driver's License</p>
                            <p class="text-sm text-gray-500">Valid and unexpired</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-check text-blue-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Vehicle</p>
                            <p class="text-sm text-gray-500">Clean and in good condition</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-check text-blue-600 mt-1"></i>
                        <div>
                            <p class="font-semibold text-gray-800">Previous Report</p>
                            <p class="text-sm text-gray-500">If renewal (optional)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inspection Fee -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Inspection Fee</h2>

                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
                    <p class="text-blue-800 font-semibold text-sm mb-2">Total Amount</p>
                    <p class="text-blue-900 text-3xl font-bold">₱1,500.00</p>
                    <p class="text-blue-700 text-xs mt-2">Payment due after inspection</p>
                </div>

                <div class="mt-4 space-y-2 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>Inspection Fee:</span>
                        <span class="font-semibold">₱1,200.00</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Processing Fee:</span>
                        <span class="font-semibold">₱300.00</span>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Need Help?</h2>

                <div class="space-y-3">
                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-phone text-green-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Call Us</p>
                            <p class="text-xs text-gray-500">+63 123 456 7890</p>
                        </div>
                    </a>

                    <a href="#" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-envelope text-blue-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Email</p>
                            <p class="text-xs text-gray-500">support@franchise.com</p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection
