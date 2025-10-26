<!-- Application Status Card -->
<div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-xl shadow-lg p-8 mb-8 text-white">
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold mb-2">Application Status</h2>
            <p class="text-purple-100 mb-4">{{ ucfirst($application->status ?? 'Pending') }}</p>
            <div class="flex items-center space-x-4">
                <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                    <p class="text-purple-100 text-sm">Applicant</p>
                    <p class="text-xl font-bold">{{ $application->user->name }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                    <p class="text-purple-100 text-sm">Submitted On</p>
                    <p class="text-xl font-bold">{{ $application->date_submitted ? $application->date_submitted->format('M d, Y') : 'N/A' }}</p>
                </div>
                <div class="bg-white bg-opacity-20 rounded-lg px-4 py-2">
                    <p class="text-purple-100 text-sm">Type</p>
                    <p class="text-xl font-bold">{{ ucfirst($application->franchise_type ?? 'New') }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white bg-opacity-20 rounded-full p-6">
            <i class="fas fa-file-alt text-6xl"></i>
        </div>
    </div>
</div>
