@extends('shell')

@section('title', 'Verify Email')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Logo and Header -->
            <div class="text-center mb-8">
                <a href="{{ url('/') }}" class="inline-block">
                    <img src="{{ asset('images/municipality-logo.jpg') }}" alt="Municipality Logo" class="h-20 w-20 mx-auto rounded-full object-cover shadow-lg">
                </a>
                <h2 class="mt-6 text-4xl font-bold text-gray-800">Verify Email</h2>
                <p class="mt-2 text-gray-600">Confirm your email address</p>
            </div>

            <!-- Verify Email Card -->
            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700">
                    <i class="fas fa-info-circle mr-2"></i>
                    {{ __('Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just sent you. If you didn\'t receive the email, we will gladly send you another.') }}
                </div>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="font-medium text-green-700 text-sm flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ __('A new verification link has been sent to the email address you provided.') }}
                        </p>
                    </div>
                @endif

                <!-- Resend Verification -->
                <form method="POST" action="{{ route('verification.send') }}" class="mb-6">
                    @csrf
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition transform hover:scale-105">
                        <i class="fas fa-redo mr-2"></i>
                        Resend Verification Email
                    </button>
                </form>

                <!-- Divider -->
                <div class="mt-6 relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">or</span>
                    </div>
                </div>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}" class="mt-6">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center justify-center gap-2 bg-red-100 text-red-700 py-3 px-4 rounded-lg font-medium hover:bg-red-200 transition">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>

            <!-- Footer Note -->
            <p class="mt-8 text-center text-sm text-gray-600">
                CTRIKE - Municipality of Lal-lo
            </p>
        </div>
    </div>

@endsection
