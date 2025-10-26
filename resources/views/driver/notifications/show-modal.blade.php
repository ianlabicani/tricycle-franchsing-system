<!-- Notification Detail Modal -->
<div id="notificationModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 items-center justify-center p-4" style="display: none;">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <!-- Modal Header -->
        <div class="sticky top-0 bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex items-center justify-between border-b border-blue-800">
            <h2 class="text-xl font-bold text-white flex items-center">
                <i class="fas fa-bell mr-3"></i>
                <span id="modalTitle">Notification Details</span>
            </h2>
            <button onclick="closeNotificationModal()" class="text-white hover:bg-blue-800 rounded-full p-2 transition">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="p-6">
            <!-- Notification Type Badge -->
            <div class="mb-4">
                <span id="modalBadge" class="inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">
                    Renewal Notice
                </span>
            </div>

            <!-- Notification Title -->
            <h3 id="modalNotifTitle" class="text-2xl font-bold text-gray-800 mb-2">
                Notification Title
            </h3>

            <!-- Notification Timestamp -->
            <p id="modalTimestamp" class="text-sm text-gray-500 mb-4">
                October 26, 2025 at 11:08 PM
            </p>

            <!-- Notification Message -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6 border border-gray-200">
                <p id="modalMessage" class="text-gray-700 leading-relaxed">
                    Notification message content will appear here.
                </p>
            </div>

            <!-- Additional Details -->
            <div id="modalDetails" class="space-y-4 mb-6">
                <!-- Dynamic content will be inserted here -->
            </div>

            <!-- Actions -->
            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                <a id="modalActionButton" href="#" class="block w-full px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition text-center font-semibold">
                    <i class="fas fa-arrow-right mr-2"></i>View Application
                </a>
                <button onclick="closeNotificationModal()" class="w-full px-4 py-3 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition font-semibold">
                    Close
                </button>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-100 px-6 py-3 flex justify-end items-center border-t">
            <span id="modalReadStatus" class="text-sm text-gray-600 flex items-center">
                <i class="fas fa-check-double text-green-500 mr-2"></i>
                Marked as read
            </span>
        </div>
    </div>
</div>

<script>
function openNotificationModal(notificationId) {
    const notification = document.querySelector(`[data-notification-id="${notificationId}"]`);
    if (!notification) return;

    // Extract data from the notification element
    const title = notification.querySelector('[data-title]').textContent;
    const message = notification.querySelector('[data-message]').textContent;
    const timestamp = notification.querySelector('[data-timestamp]').textContent;
    const badge = notification.querySelector('[data-badge]').textContent;
    const applicationId = notification.dataset.applicationId;
    const isRead = notification.dataset.isRead === 'true';

    // Populate modal
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalNotifTitle').textContent = title;
    document.getElementById('modalMessage').textContent = message;
    document.getElementById('modalTimestamp').textContent = timestamp;
    document.getElementById('modalBadge').textContent = badge;

    // Update badge styling based on type
    const badgeEl = document.getElementById('modalBadge');
    if (badge.includes('Renewal')) {
        badgeEl.className = 'inline-block px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold';
    } else {
        badgeEl.className = 'inline-block px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold';
    }

    // Update read status display
    const readStatusEl = document.getElementById('modalReadStatus');
    if (isRead) {
        readStatusEl.innerHTML = '<i class="fas fa-check-double text-green-500 mr-2"></i>Already read';
    } else {
        readStatusEl.innerHTML = '<i class="fas fa-eye text-blue-500 mr-2"></i>Marking as read...';
    }

    // Clear and populate details
    const detailsContainer = document.getElementById('modalDetails');
    detailsContainer.innerHTML = '';

    if (applicationId) {
        detailsContainer.innerHTML += `
            <div class="flex items-center space-x-2 text-sm">
                <i class="fas fa-document text-blue-600"></i>
                <span class="text-gray-700"><strong>Application ID:</strong> #${applicationId}</span>
            </div>
        `;
        document.getElementById('modalActionButton').href = `/driver/application/${applicationId}`;
        document.getElementById('modalActionButton').classList.remove('hidden');
    } else {
        document.getElementById('modalActionButton').classList.add('hidden');
    }

    // Show modal
    const modal = document.getElementById('notificationModal');
    modal.classList.remove('hidden');
    modal.style.display = 'flex';

    // Mark as read if not already read
    if (!isRead) {
        markNotificationAsRead(notificationId);
    }
}

function closeNotificationModal() {
    const modal = document.getElementById('notificationModal');
    modal.classList.add('hidden');
    modal.style.display = 'none';
}

function markNotificationAsRead(notificationId) {
    fetch(`/driver/notifications/${notificationId}/mark-read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        // Update read status in modal
        const readStatusEl = document.getElementById('modalReadStatus');
        if (data.success) {
            readStatusEl.innerHTML = '<i class="fas fa-check-double text-green-500 mr-2"></i>Marked as read';

            // Update notification element styling
            const notification = document.querySelector(`[data-notification-id="${notificationId}"]`);
            if (notification) {
                notification.classList.remove('border-blue-600', 'bg-blue-50');
                notification.classList.add('border-gray-300', 'bg-gray-50');
                notification.dataset.isRead = 'true';
            }
        }
    })
    .catch(error => console.error('Error:', error));
}

// Close modal when clicking outside
document.getElementById('notificationModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeNotificationModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeNotificationModal();
    }
});
</script>
