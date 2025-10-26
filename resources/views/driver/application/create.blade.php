    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded-lg">
            <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
        </div>
    @endif
@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('driver.application') }}" class="hover:text-blue-600">Applications</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">New Application</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    @if($lastApp && $lastApp->status === 'for_renewal')
                        Renew Your Franchise
                    @elseif($lastApp && $lastApp->status === 'completed')
                        Renew Your Franchise
                    @else
                        New Franchise Application
                    @endif
                </h1>
                <p class="text-gray-600 mt-2">
                    @if($lastApp && $lastApp->status === 'for_renewal')
                        Your franchise has expired. Please submit a renewal application to continue operating.
                    @elseif($lastApp && $lastApp->status === 'completed')
                        Renew your existing franchise for another 3 years.
                    @else
                        Submit a new franchise application
                    @endif
                </p>
            </div>
            <a href="{{ route('driver.application') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back to Applications
            </a>
        </div>
    </div>

    @if($lastApp && in_array($lastApp->status, ['for_renewal', 'completed']))
        <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-500 rounded">
            <div class="flex items-start">
                <i class="fas fa-exclamation-triangle text-yellow-600 text-lg mr-3 mt-1"></i>
                <div>
                    <h3 class="font-bold text-yellow-800 mb-1">Renewal Information</h3>
                    <p class="text-yellow-700 text-sm">
                        Your current franchise ({{ $lastApp->application_no }}) will expire on <strong>{{ $lastApp->expiration_date->format('F d, Y') }}</strong>.
                        Submit this renewal application to extend your franchise for another 3 years.
                    </p>
                </div>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2">

            <!-- Application Form -->
            <form action="{{ route('driver.application.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-6">
                @csrf

                <!-- Franchise Type -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Application Type</h2>
                    <div class="grid md:grid-cols-3 gap-4">
                        <label class="relative border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition">
                            <input type="radio" name="franchise_type" value="new" class="peer sr-only" required>
                            <div class="text-center">
                                <i class="fas fa-plus-circle text-3xl text-gray-400 peer-checked:text-blue-600 mb-2"></i>
                                <p class="font-semibold text-gray-700 peer-checked:text-blue-600">New Franchise</p>
                                <p class="text-xs text-gray-500 mt-1">Apply for a new franchise</p>
                            </div>
                            <div class="absolute top-2 right-2 w-5 h-5 border-2 border-gray-300 rounded-full peer-checked:border-blue-600 peer-checked:bg-blue-600 flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100"></i>
                            </div>
                        </label>

                        <label class="relative border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition">
                            <input type="radio" name="franchise_type" value="renewal" class="peer sr-only" required>
                            <div class="text-center">
                                <i class="fas fa-sync-alt text-3xl text-gray-400 peer-checked:text-blue-600 mb-2"></i>
                                <p class="font-semibold text-gray-700 peer-checked:text-blue-600">Renewal</p>
                                <p class="text-xs text-gray-500 mt-1">Renew existing franchise</p>
                            </div>
                            <div class="absolute top-2 right-2 w-5 h-5 border-2 border-gray-300 rounded-full peer-checked:border-blue-600 peer-checked:bg-blue-600 flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100"></i>
                            </div>
                        </label>

                        <label class="relative border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition">
                            <input type="radio" name="franchise_type" value="amendment" class="peer sr-only" required>
                            <div class="text-center">
                                <i class="fas fa-edit text-3xl text-gray-400 peer-checked:text-blue-600 mb-2"></i>
                                <p class="font-semibold text-gray-700 peer-checked:text-blue-600">Amendment</p>
                                <p class="text-xs text-gray-500 mt-1">Modify existing franchise</p>
                            </div>
                            <div class="absolute top-2 right-2 w-5 h-5 border-2 border-gray-300 rounded-full peer-checked:border-blue-600 peer-checked:bg-blue-600 flex items-center justify-center">
                                <i class="fas fa-check text-white text-xs opacity-0 peer-checked:opacity-100"></i>
                            </div>
                        </label>
                    </div>
                    @error('franchise_type')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Personal Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Personal Information</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name <span class="text-red-500">*</span></label>
                            <input type="text" name="first_name" value="{{ Auth::user()->profile?->first_name ?? old('first_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name <span class="text-gray-500 text-sm">(Optional)</span></label>
                            <input type="text" name="middle_name" value="{{ Auth::user()->profile?->middle_name ?? old('middle_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('middle_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" value="{{ Auth::user()->profile?->last_name ?? old('last_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                            <input type="date" name="date_of_birth" value="{{ Auth::user()->profile?->date_of_birth ?? old('date_of_birth') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('date_of_birth')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="contact_number" value="{{ Auth::user()->profile?->contact_number ?? old('contact_number') }}" placeholder="+63 912 345 6789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('contact_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address <span class="text-red-500">*</span></label>
                            <input type="text" name="address" value="{{ Auth::user()->profile?->address ?? old('address') }}" placeholder="House/Unit No., Street, Barangay, City, Province" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Vehicle Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Vehicle Information</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Plate Number <span class="text-red-500">*</span></label>
                            <input type="text" name="plate_number" placeholder="ABC-1234" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Engine Number <span class="text-red-500">*</span></label>
                            <input type="text" name="engine_number" placeholder="EN123456789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Chassis Number <span class="text-red-500">*</span></label>
                            <input type="text" name="chassis_number" placeholder="CH987654321" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Year Model <span class="text-red-500">*</span></label>
                            <input type="number" name="year_model" placeholder="2020" min="1990" max="2025" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Make/Brand <span class="text-red-500">*</span></label>
                            <input type="text" name="make" placeholder="Honda" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                    </div>
                </div>

                <!-- Route Information -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Route Information</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Route <span class="text-red-500">*</span></label>
                            <select name="route" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">Select Route</option>
                                <option value="line1" {{ old('route') === 'line1' ? 'selected' : '' }}>
                                    🔴 Line 1 - Red (Jurisdiction - Magapit Route)
                                </option>
                                <option value="line2" {{ old('route') === 'line2' ? 'selected' : '' }}>
                                    🟠 Line 2 - Orange (Public Market/Cagoran-Binag - Sta. Teresa & Cambong)
                                </option>
                                <option value="line3" {{ old('route') === 'line3' ? 'selected' : '' }}>
                                    🔵 Line 3 - Blue (Magapit-Dagupan)
                                </option>
                                <option value="line4" {{ old('route') === 'line4' ? 'selected' : '' }}>
                                    🟢 Line 4 - Green (Junction-Sta. Maria Route)
                                </option>
                                <option value="line5" {{ old('route') === 'line5' ? 'selected' : '' }}>
                                    🟡 Line 5 - Yellow (Junction San Lorenzo - Malanao)
                                </option>
                                <option value="line6" {{ old('route') === 'line6' ? 'selected' : '' }}>
                                    ⚪ Line 6 - White (Junction Magapit - Cabayabasan via Logac)
                                </option>
                                <option value="line7" {{ old('route') === 'line7' ? 'selected' : '' }}>
                                    🟤 Line 7 - Brown (Public Market - Dalaya & Paranum Route)
                                </option>
                                <option value="line8" {{ old('route') === 'line8' ? 'selected' : '' }}>
                                    🟣 Line 8 - Violet (Abagao-San Juan-Bical & Fusina Route)
                                </option>
                            </select>
                            @error('route')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours <span class="text-red-500">*</span></label>
                            <input type="text" name="operating_hours" placeholder="6:00 AM - 8:00 PM" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                    </div>
                </div>

                <!-- Purpose/Remarks -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Additional Information</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Purpose / Remarks</label>
                        <textarea name="purpose" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Any additional information or special requests..."></textarea>
                    </div>
                </div>

                <!-- Required Documents -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Required Documents <span class="text-red-500">*</span></h2>
                    <p class="text-sm text-gray-600 mb-4">Please upload all required documents. You can upload them now or after submitting your application.</p>

                    <!-- Personal Documents -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-id-card text-blue-500 mr-2"></i>
                            Personal Documents
                        </h3>
                        <div class="space-y-4 bg-gray-50 p-4 rounded-lg">
                            <!-- 2x2 ID Picture -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">2x2 ID Picture <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('id_picture').click()">
                                    <input type="file" id="id_picture" name="documents[id_picture]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'id_picture_name')">
                                    <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="id_picture_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Cedula -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cedula of Owner/Operator <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('cedula').click()">
                                    <input type="file" id="cedula" name="documents[cedula]" accept="image/jpeg,image/png,application/pdf" class="hidden" onchange="updateFileName(this, 'cedula_name')">
                                    <i class="fas fa-id-card text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="cedula_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG, PNG, or PDF, Max 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- LTO Documents -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-file-pdf text-red-500 mr-2"></i>
                            LTO Documents
                        </h3>
                        <div class="space-y-4 bg-gray-50 p-4 rounded-lg">
                            <!-- LTO Certificate -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">LTO Certificate of Registration <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('lto_certificate').click()">
                                    <input type="file" id="lto_certificate" name="documents[lto_certificate]" accept="image/jpeg,image/png,application/pdf" class="hidden" onchange="updateFileName(this, 'lto_certificate_name')">
                                    <i class="fas fa-file-pdf text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="lto_certificate_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG, PNG, or PDF, Max 10MB</p>
                                </div>
                            </div>

                            <!-- LTO Receipt -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">LTO Official Receipt <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('lto_receipt').click()">
                                    <input type="file" id="lto_receipt" name="documents[lto_receipt]" accept="image/jpeg,image/png,application/pdf" class="hidden" onchange="updateFileName(this, 'lto_receipt_name')">
                                    <i class="fas fa-file-pdf text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="lto_receipt_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG, PNG, or PDF, Max 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Vehicle Identification Numbers -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-stamp text-yellow-600 mr-2"></i>
                            Vehicle Identification Numbers
                        </h3>
                        <div class="space-y-4 bg-gray-50 p-4 rounded-lg">
                            <!-- Engine Stencil -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Engine Number Stencil <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('engine_stencil').click()">
                                    <input type="file" id="engine_stencil" name="documents[engine_stencil]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'engine_stencil_name')">
                                    <i class="fas fa-stamp text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="engine_stencil_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Chassis Stencil -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Chassis Number Stencil <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('chassis_stencil').click()">
                                    <input type="file" id="chassis_stencil" name="documents[chassis_stencil]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'chassis_stencil_name')">
                                    <i class="fas fa-stamp text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="chassis_stencil_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tricycle Photos -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-image text-green-600 mr-2"></i>
                            Tricycle Photos
                        </h3>
                        <p class="text-xs text-gray-500 mb-3">Photos should clearly show the tricycle's line color markings</p>
                        <div class="space-y-4 bg-gray-50 p-4 rounded-lg">
                            <!-- Tricycle Front -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tricycle Photo (Front) <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('tricycle_front').click()">
                                    <input type="file" id="tricycle_front" name="documents[tricycle_front]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'tricycle_front_name')">
                                    <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="tricycle_front_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Tricycle Side -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tricycle Photo (Side) <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('tricycle_side').click()">
                                    <input type="file" id="tricycle_side" name="documents[tricycle_side]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'tricycle_side_name')">
                                    <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="tricycle_side_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Tricycle Back -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tricycle Photo (Back) <span class="text-red-500">*</span></label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('tricycle_back').click()">
                                    <input type="file" id="tricycle_back" name="documents[tricycle_back]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'tricycle_back_name')">
                                    <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="tricycle_back_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="flex items-center justify-between pt-6 border-t">
                    <a href="{{ route('driver.application') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-paper-plane mr-2"></i>Submit Application
                    </button>
                </div>
            </form>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Requirements Checklist -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Before You Submit</h2>

                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-check-circle text-green-500 text-xl mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Requirements Uploaded</p>
                            <p class="text-xs text-gray-500">All 5 documents verified</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-info-circle text-blue-500 text-xl mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Vehicle Inspection</p>
                            <p class="text-xs text-gray-500">Will be scheduled after submission</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <i class="fas fa-wallet text-purple-500 text-xl mt-0.5"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Payment Required</p>
                            <p class="text-xs text-gray-500">₱8,500 total fees</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-lightbulb text-blue-600 text-2xl"></i>
                    <div>
                        <h3 class="font-bold text-blue-800 mb-2">Need Help?</h3>
                        <p class="text-blue-700 text-sm mb-3">Make sure all information is accurate before submitting. You can edit your application before final approval.</p>
                        <a href="{{ route('driver.help') }}" class="text-blue-600 hover:text-blue-700 font-semibold text-sm">
                            View Application Guide <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Contact Support</h2>

                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-phone text-green-600"></i>
                        <span class="text-gray-700 text-sm">+63 912 345 6789</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-envelope text-blue-600"></i>
                        <span class="text-gray-700 text-sm">support@tricycle.gov</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-clock text-purple-600"></i>
                        <span class="text-gray-700 text-sm">Mon-Fri, 8AM-5PM</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function updateFileName(input, displayId) {
            const fileName = input.files.length > 0 ? input.files[0].name : 'Click to upload or drag and drop';
            const fileSizeKB = input.files.length > 0 ? (input.files[0].size / 1024).toFixed(2) : '';
            const displayText = input.files.length > 0
                ? `✓ ${fileName} (${fileSizeKB} KB)`
                : 'Click to upload or drag and drop';

            document.getElementById(displayId).textContent = displayText;

            // Update the parent styling to show file is selected
            const parent = input.closest('.border-2');
            if (input.files.length > 0) {
                parent.classList.add('border-green-500', 'bg-green-50');
                parent.classList.remove('border-gray-300', 'hover:border-blue-500', 'hover:bg-blue-50');
            } else {
                parent.classList.remove('border-green-500', 'bg-green-50');
                parent.classList.add('border-gray-300', 'hover:border-blue-500', 'hover:bg-blue-50');
            }
        }

        // Drag and drop functionality
        document.querySelectorAll('.border-2.border-dashed').forEach(zone => {
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                zone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                zone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                zone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                zone.classList.add('border-blue-500', 'bg-blue-50');
            }

            function unhighlight(e) {
                zone.classList.remove('border-blue-500', 'bg-blue-50');
            }

            zone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                const input = zone.querySelector('input[type="file"]');
                input.files = files;

                // Trigger the onchange event
                const event = new Event('change', { bubbles: true });
                input.dispatchEvent(event);
            }
        });
    </script>

@endsection
