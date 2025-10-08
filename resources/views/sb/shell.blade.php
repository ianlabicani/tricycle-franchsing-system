@extends('shell')

@section('content')

<!-- Navigation Bar for SB Staff -->
<nav class="bg-gradient-to-r from-purple-600 to-purple-700 shadow-lg sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Left Side - Logo and Brand -->
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/municipality-logo.jpg') }}" alt="Municipality of Lal-lo Logo" class="h-10 w-10 object-cover rounded-full ring-2 ring-white">
                    <div class="hidden md:block">
                        <h1 class="text-white font-bold text-lg">CTRIKE - Lal-lo</h1>
                        <p class="text-purple-200 text-xs">SB Staff Portal</p>
                    </div>
                </div>
            </div>

            <!-- Center - Navigation Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('sb.dashboard') }}" class="text-white hover:bg-purple-500 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.dashboard') ? 'bg-purple-500' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('sb.applications.index') }}" class="text-white hover:bg-purple-500 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.applications.*') ? 'bg-purple-500' : '' }}">
                    <i class="fas fa-file-alt"></i>
                    <span>Applications</span>
                </a>
                <a href="{{ route('sb.inspections.index') }}" class="text-white hover:bg-purple-500 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.inspections.*') ? 'bg-purple-500' : '' }}">
                    <i class="fas fa-clipboard-check"></i>
                    <span>Inspections</span>
                </a>
                <a href="{{ route('sb.payments.index') }}" class="text-white hover:bg-purple-500 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.payments.*') ? 'bg-purple-500' : '' }}">
                    <i class="fas fa-money-bill-wave"></i>
                    <span>Payments</span>
                </a>
                <a href="{{ route('sb.dashboard') }}" class="text-white hover:bg-purple-500 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2">
                    <i class="fas fa-users"></i>
                    <span>Drivers</span>
                </a>
                <a href="{{ route('sb.dashboard') }}" class="text-white hover:bg-purple-500 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2">
                    <i class="fas fa-chart-bar"></i>
                    <span>Reports</span>
                </a>
            </div>

            <!-- Right Side - User Menu -->
            <div class="flex items-center space-x-4">

                <!-- Notifications -->
                <div class="relative">
                    <button class="text-white hover:bg-purple-500 p-2 rounded-lg transition relative">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">5</span>
                    </button>
                </div>

                <!-- User Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center space-x-3 text-white hover:bg-purple-500 px-3 py-2 rounded-lg transition">
                        <div class="hidden md:block text-right">
                            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-purple-200">SB Staff</p>
                        </div>
                        <img src="{{ asset('images/municipality-logo.jpg') }}" alt="User Avatar" class="h-10 w-10 rounded-full object-cover ring-2 ring-white">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div x-show="open"
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 z-50"
                         style="display: none;">

                        <a href="{{ route('profile.edit') }}" class="px-4 py-2 text-gray-800 hover:bg-purple-50 transition flex items-center space-x-2">
                            <i class="fas fa-user text-purple-600"></i>
                            <span>My Profile</span>
                        </a>
                        <a href="{{ route('sb.dashboard') }}" class="px-4 py-2 text-gray-800 hover:bg-purple-50 transition flex items-center space-x-2">
                            <i class="fas fa-cog text-purple-600"></i>
                            <span>Settings</span>
                        </a>

                        <div class="border-t border-gray-200 my-2"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition flex items-center space-x-2">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Mobile Menu Toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-white hover:bg-purple-500 p-2 rounded-lg transition">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen"
         x-data="{ mobileMenuOpen: false }"
         @click.away="mobileMenuOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden bg-purple-700 border-t border-purple-500"
         style="display: none;">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('sb.dashboard') }}" class="block text-white hover:bg-purple-600 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.dashboard') ? 'bg-purple-600' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('sb.applications.index') }}" class="block text-white hover:bg-purple-600 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.applications.*') ? 'bg-purple-600' : '' }}">
                <i class="fas fa-file-alt"></i>
                <span>Applications</span>
            </a>
            <a href="{{ route('sb.inspections.index') }}" class="block text-white hover:bg-purple-600 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.inspections.*') ? 'bg-purple-600' : '' }}">
                <i class="fas fa-clipboard-check"></i>
                <span>Inspections</span>
            </a>
            <a href="{{ route('sb.payments.index') }}" class="block text-white hover:bg-purple-600 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2 {{ request()->routeIs('sb.payments.*') ? 'bg-purple-600' : '' }}">
                <i class="fas fa-money-bill-wave"></i>
                <span>Payments</span>
            </a>
            <a href="{{ route('sb.dashboard') }}" class="block text-white hover:bg-purple-600 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2">
                <i class="fas fa-users"></i>
                <span>Drivers</span>
            </a>
            <a href="{{ route('sb.dashboard') }}" class="block text-white hover:bg-purple-600 px-4 py-2 rounded-lg transition font-medium flex items-center space-x-2">
                <i class="fas fa-chart-bar"></i>
                <span>Reports</span>
            </a>
        </div>
    </div>
</nav>

<!-- Main Content Area -->
<main class="bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('sb-content')
    </div>
</main>

<!-- Alpine.js for Dropdown Functionality -->
@push('scripts')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush

@endsection
