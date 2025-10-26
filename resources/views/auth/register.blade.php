@extends('shell')

@section('title', 'Register')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo and Header -->
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-block">
                    <img src="{{ asset('images/municipality-logo.jpg') }}" alt="Municipality Logo" class="h-20 w-20 mx-auto rounded-full object-cover shadow-lg">
                </a>
                <h2 class="mt-6 text-4xl font-bold text-gray-800">Create Account</h2>
                <p class="mt-2 text-gray-600">Join CTRIKE - Municipality of Lal-lo</p>
            </div>

            <!-- Register Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input id="first_name"
                               type="text"
                               name="first_name"
                               value="{{ old('first_name') }}"
                               required
                               autofocus
                               autocomplete="given-name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition @error('first_name') border-red-500 @enderror"
                               placeholder="Juan">
                        @error('first_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Middle Name (Optional) -->
                    <div>
                        <label for="middle_name" class="block text-sm font-medium text-gray-700 mb-2">Middle Name <span class="text-gray-500 font-normal">(Optional)</span></label>
                        <input id="middle_name"
                               type="text"
                               name="middle_name"
                               value="{{ old('middle_name') }}"
                               autocomplete="additional-name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition @error('middle_name') border-red-500 @enderror"
                               placeholder="Santos">
                        @error('middle_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input id="last_name"
                               type="text"
                               name="last_name"
                               value="{{ old('last_name') }}"
                               required
                               autocomplete="family-name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition @error('last_name') border-red-500 @enderror"
                               placeholder="Dela Cruz">
                        @error('last_name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Preferred Route -->
                    <div>
                        <label for="preferred_route" class="block text-sm font-medium text-gray-700 mb-2">Preferred Route <span class="text-red-500">*</span></label>
                        <select id="preferred_route"
                                name="preferred_route"
                                required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition @error('preferred_route') border-red-500 @enderror">
                            <option value="">Select a route</option>
                            <option value="line1" {{ old('preferred_route') === 'line1' ? 'selected' : '' }}>
                                🔴 Line 1 - Red (Jurisdiction - Magapit Route)
                            </option>
                            <option value="line2" {{ old('preferred_route') === 'line2' ? 'selected' : '' }}>
                                🟠 Line 2 - Orange (Public Market/Cagoran-Binag - Sta. Teresa & Cambong)
                            </option>
                            <option value="line3" {{ old('preferred_route') === 'line3' ? 'selected' : '' }}>
                                🔵 Line 3 - Blue (Magapit-Dagupan)
                            </option>
                            <option value="line4" {{ old('preferred_route') === 'line4' ? 'selected' : '' }}>
                                🟢 Line 4 - Green (Junction-Sta. Maria Route)
                            </option>
                            <option value="line5" {{ old('preferred_route') === 'line5' ? 'selected' : '' }}>
                                🟡 Line 5 - Yellow (Junction San Lorenzo - Malanao)
                            </option>
                            <option value="line6" {{ old('preferred_route') === 'line6' ? 'selected' : '' }}>
                                ⚪ Line 6 - White (Junction Magapit - Cabayabasan via Logac)
                            </option>
                            <option value="line7" {{ old('preferred_route') === 'line7' ? 'selected' : '' }}>
                                🟤 Line 7 - Brown (Public Market - Dalaya & Paranum Route)
                            </option>
                            <option value="line8" {{ old('preferred_route') === 'line8' ? 'selected' : '' }}>
                                🟣 Line 8 - Violet (Abagao-San Juan-Bical & Fusina Route)
                            </option>
                        </select>
                        @error('preferred_route')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input id="email"
                               type="email"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="username"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition @error('email') border-red-500 @enderror"
                               placeholder="user@mail.com">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password"
                               type="password"
                               name="password"
                               required
                               autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition @error('password') border-red-500 @enderror"
                               placeholder="••••••••">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <input id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent transition @error('password_confirmation') border-red-500 @enderror"
                               placeholder="••••••••">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition transform hover:scale-105">
                        Create Account
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-6 relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">Already have an account?</span>
                    </div>
                </div>

                <!-- Login Link -->
                <div class="mt-6">
                    <a href="{{ route('login') }}"
                       class="w-full flex items-center justify-center gap-2 bg-gray-100 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-200 transition">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In Instead
                    </a>
                </div>
            </div>

            <!-- Footer Note -->
            <p class="mt-8 text-center text-sm text-gray-600">
                CTRIKE - Municipality of Lal-lo
            </p>
        </div>
    </div>

@endsection
