<!-- Sidebar modals and scripts -->

<!-- Toast Notification Container -->
<div id="toastContainer" class="fixed top-4 right-4 z-[9999] space-y-2"></div>

<!-- Document View Modal -->
<div id="documentViewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="sticky top-0 bg-white border-b p-6 flex items-center justify-between">
            <h3 class="text-xl font-bold text-gray-800" id="documentTitle">View Document</h3>
            <button onclick="closeDocumentViewModal()" class="text-gray-500 hover:text-gray-700 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="p-6">
            <!-- Document Preview or Link -->
            <div id="documentPreviewContainer" class="mb-6">
                <iframe id="documentPreview" class="w-full h-96 border border-gray-300 rounded-lg" style="display: none;"></iframe>
                <div id="documentPreviewPlaceholder" class="flex flex-col items-center justify-center h-96 bg-gray-50 border border-gray-300 rounded-lg">
                    <i class="fas fa-file-pdf text-gray-400 text-6xl mb-4"></i>
                    <p class="text-gray-600 text-center mb-4">Document preview not available</p>
                    <a id="documentDownloadLink" href="#" class="text-purple-600 hover:text-purple-700 font-semibold">
                        <i class="fas fa-download mr-2"></i>Download Document
                    </a>
                </div>
            </div>

            <!-- Document Info -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Document Type</p>
                        <p id="documentType" class="font-semibold text-gray-800"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Current Status</p>
                        <span id="documentStatus" class="px-3 py-1 rounded-full text-xs font-semibold inline-block"></span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Uploaded On</p>
                        <p id="documentUploadDate" class="font-semibold text-gray-800"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">File Size</p>
                        <p id="documentFileSize" class="font-semibold text-gray-800">-</p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex space-x-3">
                <div id="documentActionButtons" class="flex space-x-3 flex-1">
                    <button id="approveDocumentBtn" onclick="approveDocumentFromModal(this)" class="flex-1 px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">
                        <i class="fas fa-check mr-2"></i>Approve Document
                    </button>
                    <button onclick="rejectDocumentFromModal()" class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                        <i class="fas fa-times mr-2"></i>Reject Document
                    </button>
                </div>
                <button onclick="closeDocumentViewModal()" class="flex-1 px-4 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-semibold">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Document Reject Modal -->
<div id="documentRejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Document</h3>
        <form id="documentRejectForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection <span class="text-red-500">*</span></label>
                <textarea name="reason" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Explain why this document is being rejected..." required></textarea>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeDocumentRejectModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold" onclick="submitDocumentRejectForm(event)">
                    Reject Document
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Reject Application Modal -->
<div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Reject Application</h3>
        <form action="{{ route('sb.applications.reject', $application) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Reason for Rejection <span class="text-red-500">*</span></label>
                <textarea name="remarks" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="Please provide a clear reason for rejection..." required></textarea>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeRejectModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                    Reject
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Review Modal -->
<div id="reviewModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4 p-6">
        <h3 class="text-xl font-bold text-gray-800 mb-4">Review Application</h3>
        <form action="{{ route('sb.applications.review', $application) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-3">Document Completeness <span class="text-red-500">*</span></label>
                <div class="space-y-2">
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="is_complete" value="1" required class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300">
                        <span class="ml-3">
                            <span class="block font-semibold text-gray-800">Complete</span>
                            <span class="text-sm text-gray-600">All documents submitted and acceptable</span>
                        </span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                        <input type="radio" name="is_complete" value="0" required class="h-4 w-4 text-orange-600 focus:ring-orange-500 border-gray-300">
                        <span class="ml-3">
                            <span class="block font-semibold text-gray-800">Incomplete</span>
                            <span class="text-sm text-gray-600">Missing or incorrect documents</span>
                        </span>
                    </label>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Review Notes</label>
                <textarea name="remarks" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Add notes about missing documents or review details..."></textarea>
                <p class="text-xs text-gray-500 mt-1">If marking as incomplete, specify which documents are missing or invalid</p>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="closeReviewModal()" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition font-semibold">
                    Cancel
                </button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                    Submit Review
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    let documentToReject = null;
    let currentDocument = null;

    // Document View Modal Functions
    function openDocumentViewModal(documentId, documentType, documentStatus, uploadedDate, fileSize) {
        currentDocument = {
            id: documentId,
            type: documentType,
            status: documentStatus,
            uploadedDate: uploadedDate,
            fileSize: fileSize
        };

        // Set document title
        document.getElementById('documentTitle').textContent = 'View ' + documentType.replace(/_/g, ' ');

        // Set document info
        document.getElementById('documentType').textContent = documentType.replace(/_/g, ' ');
        document.getElementById('documentUploadDate').textContent = uploadedDate;
        document.getElementById('documentFileSize').textContent = fileSize || '-';

        // Set status badge
        const statusBadge = document.getElementById('documentStatus');
        const statusColors = {
            'pending': 'bg-yellow-100 text-yellow-800',
            'approved': 'bg-green-100 text-green-800',
            'rejected': 'bg-red-100 text-red-800',
        };
        statusBadge.className = 'px-3 py-1 rounded-full text-xs font-semibold inline-block ' + (statusColors[documentStatus] || 'bg-gray-100 text-gray-800');
        statusBadge.textContent = documentStatus.charAt(0).toUpperCase() + documentStatus.slice(1);

        // Set download link
        const appId = '{{ $application->id }}';
        document.getElementById('documentDownloadLink').href = `/sb/applications/${appId}/documents/${documentId}/download`;

        // Try to load document preview
        const previewUrl = `/sb/applications/${appId}/documents/${documentId}/view`;
        const iframe = document.getElementById('documentPreview');
        const placeholder = document.getElementById('documentPreviewPlaceholder');

        iframe.src = previewUrl;
        iframe.style.display = 'block';
        placeholder.style.display = 'none';

        // Show/hide action buttons based on document status
        const actionButtons = document.getElementById('documentActionButtons');
        if (documentStatus === 'pending') {
            actionButtons.style.display = 'flex';
            // Reset approve button to original state
            const approveBtn = document.getElementById('approveDocumentBtn');
            approveBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Approve Document';
            approveBtn.disabled = false;
        } else {
            actionButtons.style.display = 'none';
        }

        // Show modal
        document.getElementById('documentViewModal').classList.remove('hidden');
        document.getElementById('documentViewModal').classList.add('flex');
    }

    function closeDocumentViewModal() {
        document.getElementById('documentViewModal').classList.add('hidden');
        document.getElementById('documentViewModal').classList.remove('flex');

        // Reset iframe
        const iframe = document.getElementById('documentPreview');
        const placeholder = document.getElementById('documentPreviewPlaceholder');
        iframe.src = '';
        iframe.style.display = 'none';
        placeholder.style.display = 'flex';

        currentDocument = null;
    }

    function approveDocumentFromModal(btn) {
        if (!currentDocument) return;

        const appId = '{{ $application->id }}';

        // Store original state
        const originalText = btn.innerHTML;
        const originalDisabled = btn.disabled;

        // Show loading state
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Approving...';
        btn.disabled = true;

        // Submit form via fetch for AJAX
        fetch(`/sb/applications/${appId}/documents/${currentDocument.id}/approve`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
        .then(response => {
            if (response.ok) {
                // Update the document card in the list
                updateDocumentStatusInList(currentDocument.id, 'approved');
                closeDocumentViewModal();
                showNotification('Document approved successfully!', 'success');
            } else {
                throw new Error('Failed to approve document');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Restore button state on error
            btn.innerHTML = originalText;
            btn.disabled = originalDisabled;
            showNotification('Error approving document', 'error');
        });
    }

    function rejectDocumentFromModal() {
        if (!currentDocument) return;
        openRejectModal(currentDocument.id);
    }

    function updateDocumentStatusInList(documentId, newStatus) {
        const documentCard = document.querySelector(`[data-document-id="${documentId}"]`);
        if (documentCard) {
            // Update status badge
            const badge = documentCard.querySelector('span[class*="rounded-full"]');
            if (badge) {
                const statusColors = {
                    'pending': 'bg-yellow-100 text-yellow-800',
                    'approved': 'bg-green-100 text-green-800',
                    'rejected': 'bg-red-100 text-red-800',
                };
                badge.className = 'px-3 py-1 rounded-full text-xs font-semibold ' + (statusColors[newStatus] || 'bg-gray-100 text-gray-800');
                badge.textContent = newStatus.charAt(0).toUpperCase() + newStatus.slice(1);
            }

            // Update background color based on status
            const statusColors = {
                'pending': 'bg-yellow-50 border-yellow-200',
                'approved': 'bg-green-50 border-green-200',
                'rejected': 'bg-red-50 border-red-200',
            };
            documentCard.className = 'flex items-start justify-between p-4 border rounded-lg ' + (statusColors[newStatus] || 'bg-gray-50 border-gray-200');
        }

        // Check if all documents are now approved
        checkAndHideWarningBanner();
    }

    function checkAndHideWarningBanner() {
        const allDocuments = document.querySelectorAll('[data-document-id]');

        // Check if all documents are approved
        const allApproved = Array.from(allDocuments).every(doc => {
            const badge = doc.querySelector('span[class*="rounded-full"]');
            return badge && badge.textContent.trim() === 'Approved';
        });

        if (allApproved && allDocuments.length > 0) {
            // Hide the warning banner by looking for the red banner with exclamation icon
            const warningBanners = document.querySelectorAll('.bg-red-50');
            warningBanners.forEach(banner => {
                if (banner.querySelector('.fa-exclamation-circle')) {
                    banner.style.display = 'none';
                }
            });
        }
    }

    function showNotification(message, type = 'info') {
        const container = document.getElementById('toastContainer');
        const toast = document.createElement('div');

        const bgColors = {
            'success': 'bg-green-500',
            'error': 'bg-red-500',
            'info': 'bg-blue-500',
            'warning': 'bg-yellow-500',
        };

        const icons = {
            'success': 'fa-check-circle',
            'error': 'fa-exclamation-circle',
            'info': 'fa-info-circle',
            'warning': 'fa-exclamation-triangle',
        };

        const bgColor = bgColors[type] || bgColors['info'];
        const icon = icons[type] || icons['info'];

        toast.className = `${bgColor} text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2 animate-slideIn`;
        toast.innerHTML = `
            <i class="fas ${icon}"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.remove()" class="ml-2 text-white hover:opacity-75">
                <i class="fas fa-times"></i>
            </button>
        `;

        container.appendChild(toast);

        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (toast.parentElement) {
                toast.remove();
            }
        }, 5000);
    }

    function openRejectModal(documentId) {
        if (documentId) {
            documentToReject = documentId;
            const form = document.getElementById('documentRejectForm');
            const appId = '{{ $application->id }}';
            form.action = `/sb/applications/${appId}/documents/${documentId}/reject`;
            document.getElementById('documentRejectModal').classList.remove('hidden');
            document.getElementById('documentRejectModal').classList.add('flex');
        } else {
            document.getElementById('rejectModal').classList.remove('hidden');
            document.getElementById('rejectModal').classList.add('flex');
        }
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('flex');
    }

    function closeDocumentRejectModal() {
        document.getElementById('documentRejectModal').classList.add('hidden');
        document.getElementById('documentRejectModal').classList.remove('flex');
        documentToReject = null;
        closeDocumentViewModal();
    }

    function submitDocumentRejectForm(e) {
        e.preventDefault();

        const form = document.getElementById('documentRejectForm');
        const reason = form.querySelector('textarea[name="reason"]').value;
        const submitBtn = e.target;

        if (!reason.trim()) {
            showNotification('Please provide a reason for rejection', 'warning');
            return;
        }        // Show loading state
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Rejecting...';
        submitBtn.disabled = true;

        // Submit via fetch
        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'Accept': 'application/json',
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                reason: reason,
                _token: document.querySelector('input[name="_token"]').value
            })
        })
        .then(response => {
            if (response.ok) {
                // Update the document card in the list
                updateDocumentStatusInList(documentToReject, 'rejected');
                closeDocumentRejectModal();
                showNotification('Document rejected successfully!', 'success');
            } else {
                throw new Error('Failed to reject document');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
            showNotification('Error rejecting document', 'error');
        });
    }

    function openReviewModal() {
        document.getElementById('reviewModal').classList.remove('hidden');
        document.getElementById('reviewModal').classList.add('flex');
    }

    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        document.getElementById('reviewModal').classList.remove('flex');
    }
</script>

<style>
    @keyframes slideIn {
        from {
            transform: translateX(400px);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    .animate-slideIn {
        animation: slideIn 0.3s ease-out;
    }
</style>
