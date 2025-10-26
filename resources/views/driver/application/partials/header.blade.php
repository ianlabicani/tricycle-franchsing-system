<!-- Breadcrumb -->
<nav class="mb-4">
    <ol class="flex items-center space-x-2 text-sm text-gray-600">
        <li><a href="{{ route('driver.dashboard') }}" class="hover:text-blue-600">Dashboard</a></li>
        <li><i class="fas fa-chevron-right text-xs"></i></li>
        <li><a href="{{ route('driver.application') }}" class="hover:text-blue-600">Applications</a></li>
        <li><i class="fas fa-chevron-right text-xs"></i></li>
        <li class="text-gray-800 font-semibold">Application Details</li>
    </ol>
</nav>

<!-- Page Header -->
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Application Details</h1>
            <p class="text-gray-600 mt-2">{{ $application->application_no }}</p>
        </div>
        <a href="{{ route('driver.application') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
            <i class="fas fa-arrow-left mr-2"></i>Back to Applications
        </a>
    </div>
</div>
