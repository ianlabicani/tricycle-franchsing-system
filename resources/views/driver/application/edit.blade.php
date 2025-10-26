@extends('driver.shell')

@section('driver-content')

    <!-- Breadcrumb -->
    <nav class="mb-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('driver.application') }}" class="hover:text-blue-600">Applications</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li><a href="{{ route('driver.application.show', $application->id ?? 1) }}" class="hover:text-blue-600">Details</a></li>
            <li><i class="fas fa-chevron-right text-xs"></i></li>
            <li class="text-gray-800 font-semibold">Edit</li>
        </ol>
    </nav>

    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Edit Application</h1>
                <p class="text-gray-600 mt-2">Application ID: {{ $application->id ?? 'FR-2025-0123' }}</p>
            </div>
            <a href="{{ route('driver.application.show', $application->id ?? 1) }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </div>

    <!-- Warning Notice -->
    <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg mb-6">
        <div class="flex items-start space-x-3">
            <i class="fas fa-exclamation-triangle text-yellow-600 text-xl mt-0.5"></i>
            <div>
                <h3 class="font-bold text-yellow-800">Important Notice</h3>
                <p class="text-yellow-700 text-sm mt-1">Changes to your application may require re-verification. Make sure all information is accurate before saving.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2">

            <!-- Edit Form -->
            <form action="{{ route('driver.application.update', $application->id ?? 1) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-lg p-6">
                @csrf
                @method('PUT')

                <!-- Franchise Type -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Application Type</h2>
                    <div class="grid md:grid-cols-3 gap-4">
                        <label class="relative border-2 border-gray-300 rounded-lg p-4 cursor-pointer hover:border-blue-500 transition">
                            <input type="radio" name="franchise_type" value="new" class="peer sr-only" {{ ($application->franchise_type ?? 'new') == 'new' ? 'checked' : '' }} required>
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
                            <input type="radio" name="franchise_type" value="renewal" class="peer sr-only" {{ ($application->franchise_type ?? '') == 'renewal' ? 'checked' : '' }} required>
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
                            <input type="radio" name="franchise_type" value="amendment" class="peer sr-only" {{ ($application->franchise_type ?? '') == 'amendment' ? 'checked' : '' }} required>
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
                            <input type="text" name="first_name" value="{{ $application->first_name ?? old('first_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('first_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Middle Name <span class="text-gray-500 text-sm">(Optional)</span></label>
                            <input type="text" name="middle_name" value="{{ $application->middle_name ?? old('middle_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('middle_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name <span class="text-red-500">*</span></label>
                            <input type="text" name="last_name" value="{{ $application->last_name ?? old('last_name') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('last_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth <span class="text-red-500">*</span></label>
                            <input type="date" name="date_of_birth" value="{{ $application->date_of_birth ?? old('date_of_birth') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('date_of_birth')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Contact Number <span class="text-red-500">*</span></label>
                            <input type="tel" name="contact_number" value="{{ $application->contact_number ?? old('contact_number') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('contact_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ $application->email ?? old('email') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Complete Address <span class="text-red-500">*</span></label>
                            <input type="text" name="address" value="{{ $application->address ?? old('address') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
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
                            <input type="text" name="plate_number" value="ABC-1234" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Engine Number <span class="text-red-500">*</span></label>
                            <input type="text" name="engine_number" value="EN123456789" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Chassis Number <span class="text-red-500">*</span></label>
                            <input type="text" name="chassis_number" value="CH987654321" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Year Model <span class="text-red-500">*</span></label>
                            <input type="number" name="year_model" value="2020" min="1990" max="2025" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Make/Brand <span class="text-red-500">*</span></label>
                            <input type="text" name="make" value="Honda" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
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
                                <option value="line1" {{ $application->route === 'line1' ? 'selected' : '' }}>
                                    🔴 Line 1 - Red (Jurisdiction - Magapit Route)
                                </option>
                                <option value="line2" {{ $application->route === 'line2' ? 'selected' : '' }}>
                                    🟠 Line 2 - Orange (Public Market/Cagoran-Binag - Sta. Teresa & Cambong)
                                </option>
                                <option value="line3" {{ $application->route === 'line3' ? 'selected' : '' }}>
                                    🔵 Line 3 - Blue (Magapit-Dagupan)
                                </option>
                                <option value="line4" {{ $application->route === 'line4' ? 'selected' : '' }}>
                                    🟢 Line 4 - Green (Junction-Sta. Maria Route)
                                </option>
                                <option value="line5" {{ $application->route === 'line5' ? 'selected' : '' }}>
                                    🟡 Line 5 - Yellow (Junction San Lorenzo - Malanao)
                                </option>
                                <option value="line6" {{ $application->route === 'line6' ? 'selected' : '' }}>
                                    ⚪ Line 6 - White (Junction Magapit - Cabayabasan via Logac)
                                </option>
                                <option value="line7" {{ $application->route === 'line7' ? 'selected' : '' }}>
                                    🟤 Line 7 - Brown (Public Market - Dalaya & Paranum Route)
                                </option>
                                <option value="line8" {{ $application->route === 'line8' ? 'selected' : '' }}>
                                    🟣 Line 8 - Violet (Abagao-San Juan-Bical & Fusina Route)
                                </option>
                            </select>
                            @error('route')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Operating Hours <span class="text-red-500">*</span></label>
                            <input type="text" name="operating_hours" value="6:00 AM - 8:00 PM" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                        </div>
                    </div>
                </div>

                <!-- Purpose/Remarks -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Additional Information</h2>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Purpose / Remarks</label>
                        <textarea name="purpose" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Any additional information or special requests...">{{ $application->purpose ?? '' }}</textarea>
                    </div>
                </div>

                <!-- Document Status Section -->
                @if($application->documents->count() > 0)
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Uploaded Documents</h2>
                        <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                            @foreach($application->documents as $doc)
                                <div class="flex items-start justify-between bg-white p-3 rounded border border-gray-200">
                                    <div class="flex items-start space-x-3">
                                        <i class="fas {{ $doc->document_icon }} text-blue-500 text-lg mt-1"></i>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-sm">{{ $doc->document_label }}</p>
                                            <p class="text-xs text-gray-500">{{ $doc->file_name }} • {{ number_format($doc->file_size / 1024, 1) }} KB</p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $doc->status === 'approved' ? 'bg-green-100 text-green-800' : ($doc->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($doc->status) }}
                                    </span>
                                </div>
                                @if($doc->status === 'rejected' && $doc->rejection_reason)
                                    <div class="ml-12 bg-red-50 border border-red-200 p-3 rounded text-sm text-red-700">
                                        <strong>Reason:</strong> {{ $doc->rejection_reason }}
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Additional Documents Upload -->
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4 pb-2 border-b">Upload Additional Documents <span class="text-gray-600 text-sm font-normal">(Optional)</span></h2>
                    <p class="text-sm text-gray-600 mb-4">You can upload documents if rejected or to provide additional files.</p>

                    <!-- Personal Documents -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-3 flex items-center">
                            <i class="fas fa-id-card text-blue-500 mr-2"></i>
                            Personal Documents
                        </h3>
                        <div class="space-y-4 bg-gray-50 p-4 rounded-lg">
                            <!-- 2x2 ID Picture -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">2x2 ID Picture</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('id_picture').click()">
                                    <input type="file" id="id_picture" name="documents[id_picture]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'id_picture_name')">
                                    <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="id_picture_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Cedula -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cedula of Owner/Operator</label>
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">LTO Certificate of Registration</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('lto_certificate').click()">
                                    <input type="file" id="lto_certificate" name="documents[lto_certificate]" accept="image/jpeg,image/png,application/pdf" class="hidden" onchange="updateFileName(this, 'lto_certificate_name')">
                                    <i class="fas fa-file-pdf text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="lto_certificate_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG, PNG, or PDF, Max 10MB</p>
                                </div>
                            </div>

                            <!-- LTO Receipt -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">LTO Official Receipt</label>
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">Engine Number Stencil</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('engine_stencil').click()">
                                    <input type="file" id="engine_stencil" name="documents[engine_stencil]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'engine_stencil_name')">
                                    <i class="fas fa-stamp text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="engine_stencil_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Chassis Stencil -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Chassis Number Stencil</label>
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
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tricycle Photo (Front)</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('tricycle_front').click()">
                                    <input type="file" id="tricycle_front" name="documents[tricycle_front]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'tricycle_front_name')">
                                    <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="tricycle_front_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Tricycle Side -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tricycle Photo (Side)</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 text-center hover:border-blue-500 hover:bg-blue-50 transition cursor-pointer" onclick="document.getElementById('tricycle_side').click()">
                                    <input type="file" id="tricycle_side" name="documents[tricycle_side]" accept="image/jpeg,image/png" class="hidden" onchange="updateFileName(this, 'tricycle_side_name')">
                                    <i class="fas fa-image text-gray-400 text-2xl mb-2"></i>
                                    <p class="text-sm font-medium text-gray-600" id="tricycle_side_name">Click to upload or drag and drop</p>
                                    <p class="text-xs text-gray-500">JPG or PNG, Max 5MB</p>
                                </div>
                            </div>

                            <!-- Tricycle Back -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tricycle Photo (Back)</label>
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
                    <a href="{{ route('driver.application.show', $application->id ?? 1) }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                        <i class="fas fa-save mr-2"></i>Save Changes
                    </button>
                </div>
            </form>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">

            <!-- Application Info -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Application Info</h2>

                <div class="space-y-3">
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Application ID</span>
                        <span class="font-bold text-gray-800">{{ $application->id ?? 'FR-2025-0123' }}</span>
                    </div>
                    <div class="flex items-center justify-between pb-3 border-b">
                        <span class="text-gray-600">Status</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                            {{ $application->status ?? 'Draft' }}
                        </span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600">Last Modified</span>
                        <span class="font-bold text-gray-800">{{ $application->updated_at ?? 'Today' }}</span>
                    </div>
                </div>
            </div>

            <!-- Warning -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                <div class="flex items-start space-x-3">
                    <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                    <div>
                        <h3 class="font-bold text-blue-800 mb-2">Editing Guidelines</h3>
                        <ul class="text-blue-700 text-sm space-y-1">
                            <li>• Double-check all information</li>
                            <li>• Ensure documents match data</li>
                            <li>• Changes may delay approval</li>
                            <li>• Contact support if unsure</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Need Assistance?</h2>

                <div class="space-y-3">
                    <a href="{{ route('driver.help') }}" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                        <i class="fas fa-headset text-blue-600 text-xl"></i>
                        <div>
                            <p class="font-semibold text-gray-800 text-sm">Contact Support</p>
                            <p class="text-xs text-gray-500">We're here to help</p>
                        </div>
                    </a>

                    <div class="text-center pt-3 border-t">
                        <p class="text-xs text-gray-500">Office Hours</p>
                        <p class="text-sm font-semibold text-gray-700">Mon-Fri, 8AM-5PM</p>
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
