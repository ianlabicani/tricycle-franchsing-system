<!-- Application Information -->
<div class="bg-white rounded-xl shadow-lg p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Application Information</h2>
        @if(in_array($application->status, ['draft', 'incomplete']))
        <div class="flex space-x-2">
            <a href="{{ route('driver.application.edit', $application) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-sm font-semibold">
                <i class="fas fa-edit mr-1"></i>Edit
            </a>
        </div>
        @endif
    </div>

    <div class="space-y-6">
        <!-- Personal Information -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Personal Information</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Full Name</label>
                    <p class="text-gray-800 font-semibold">{{ $application->full_name ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Date of Birth</label>
                    <p class="text-gray-800 font-semibold">{{ $application->date_of_birth ? $application->date_of_birth->format('F d, Y') : 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Contact Number</label>
                    <p class="text-gray-800 font-semibold">{{ $application->contact_number ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Email Address</label>
                    <p class="text-gray-800 font-semibold">{{ $application->email ?? 'N/A' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-500 mb-1">Complete Address</label>
                    <p class="text-gray-800 font-semibold">{{ $application->address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Vehicle Information -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Vehicle Information</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Plate Number</label>
                    <p class="text-gray-800 font-semibold">{{ $application->plate_number ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Engine Number</label>
                    <p class="text-gray-800 font-semibold">{{ $application->engine_number ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Chassis Number</label>
                    <p class="text-gray-800 font-semibold">{{ $application->chassis_number ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Year Model</label>
                    <p class="text-gray-800 font-semibold">{{ $application->year_model ?? 'N/A' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Make/Brand</label>
                    <p class="text-gray-800 font-semibold">{{ $application->make ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Route Information -->
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Preferred Route</label>
                    @php
                        $route = $application->route;
                        $routeData = \App\Helpers\RouteHelper::getRoute($route);
                    @endphp
                    @if($routeData)
                        <div class="inline-flex items-center px-4 py-2 rounded-lg border-2 {{ \App\Helpers\RouteHelper::getTailwindColorClass($routeData['color']) }}">
                            <span class="font-semibold">{{ $routeData['name'] }} - {{ ucfirst($routeData['color']) }}</span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2">{{ $routeData['description'] }}</p>
                    @else
                        <p class="text-gray-800 font-semibold">{{ $route ?? 'N/A' }}</p>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-500 mb-1">Operating Hours</label>
                    <p class="text-gray-800 font-semibold">{{ $application->operating_hours ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Purpose/Remarks -->
        @if(isset($application->purpose) && $application->purpose)
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Purpose / Remarks</h3>
            <p class="text-gray-700">{{ $application->purpose }}</p>
        </div>
        @endif

        <!-- Remarks from Admin -->
        @if(isset($application->remarks) && $application->remarks)
        <div>
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b">Admin Remarks</h3>
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded">
                <p class="text-yellow-800">{{ $application->remarks }}</p>
            </div>
        </div>
        @endif
    </div>
</div>
