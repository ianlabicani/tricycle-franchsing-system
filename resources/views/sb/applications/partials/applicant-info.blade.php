<!-- Applicant Information Section -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Applicant Information</h2>

    <div class="space-y-6">
        <!-- Personal Information -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center justify-between">
                <span>Personal Information</span>
                <span class="text-sm font-normal text-green-600"><i class="fas fa-check-circle mr-1"></i>Verified</span>
            </h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                    <p class="text-gray-800 font-semibold">{{ $application->user->name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                    <p class="text-gray-800 font-semibold">{{ $application->user->email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Contact Number</label>
                    <p class="text-gray-800 font-semibold">+63 912 345 6789</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                    <p class="text-gray-800 font-semibold">January 15, 1985</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Complete Address</label>
                    <p class="text-gray-800 font-semibold">123 Main Street, Barangay Centro, City, Province</p>
                </div>
            </div>
        </div>

        <!-- Vehicle Information -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b flex items-center justify-between">
                <span>Vehicle Information</span>
                <span class="text-sm font-normal text-green-600"><i class="fas fa-check-circle mr-1"></i>Verified</span>
            </h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Plate Number</label>
                    <p class="text-gray-800 font-semibold">ABC-1234</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Engine Number</label>
                    <p class="text-gray-800 font-semibold">EN123456789</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Chassis Number</label>
                    <p class="text-gray-800 font-semibold">CH987654321</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Year Model</label>
                    <p class="text-gray-800 font-semibold">2020</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Make/Brand</label>
                    <p class="text-gray-800 font-semibold">Honda</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Color</label>
                    <p class="text-gray-800 font-semibold">Blue</p>
                </div>
            </div>
        </div>

        <!-- Route Information -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Preferred Route</label>
                    <p class="text-gray-800 font-semibold">Route A (Church - Market - Terminal)</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Operating Hours</label>
                    <p class="text-gray-800 font-semibold">6:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>

        <!-- Purpose/Remarks -->
        @if($application->purpose)
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Purpose / Remarks</h3>
            <p class="text-gray-700">{{ $application->purpose }}</p>
        </div>
        @endif
    </div>
</div>
