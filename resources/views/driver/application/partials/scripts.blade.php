<!-- Modal Scripts -->
<script>
    // Re-upload modal functions
    function openReuploadModal(documentId, documentType) {
        document.getElementById('documentId').value = documentId;
        document.getElementById('documentType').value = documentType;
        document.getElementById('fileName').textContent = 'Click to select or drag and drop';
        document.getElementById('fileInput').value = '';
        const modal = document.getElementById('reuploadModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeReuploadModal() {
        const modal = document.getElementById('reuploadModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function updateFileName(input) {
        if (input.files && input.files[0]) {
            document.getElementById('fileName').textContent = input.files[0].name;
        }
    }

    function showValidationModal(message) {
        document.getElementById('validationMessage').textContent = message;
        document.getElementById('validationModal').style.display = 'flex';
    }

    function closeValidationModal() {
        document.getElementById('validationModal').style.display = 'none';
    }

    function showErrorModal(message) {
        document.getElementById('errorMessage').textContent = message;
        document.getElementById('errorModal').style.display = 'flex';
    }

    function closeErrorModal() {
        document.getElementById('errorModal').style.display = 'none';
    }

    function showSuccessModal() {
        document.getElementById('successModal').style.display = 'flex';
    }

    function confirmSuccess() {
        document.getElementById('successModal').style.display = 'none';
        location.reload();
    }

    function submitReupload() {
        const fileInput = document.getElementById('fileInput');
        const documentId = document.getElementById('documentId').value;
        const documentType = document.getElementById('documentType').value;

        if (!fileInput.files || !fileInput.files[0]) {
            showValidationModal('Please select a file to upload');
            return;
        }

        const formData = new FormData();
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);
        formData.append('document_id', documentId);
        formData.append('document_type', documentType);
        formData.append('file', fileInput.files[0]);

        const appId = {{ $application->id }};

        fetch(`/driver/applications/${appId}/documents/reupload`, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Upload failed');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                closeReuploadModal();
                showSuccessModal();
            } else {
                showErrorModal(data.message || 'Upload failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorModal('Error uploading file: ' + error.message);
        });
    }

    // Close modals when clicking outside
    document.getElementById('reuploadModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReuploadModal();
        }
    });

    document.getElementById('successModal').addEventListener('click', function(e) {
        if (e.target === this) {
            confirmSuccess();
        }
    });

    document.getElementById('errorModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeErrorModal();
        }
    });

    document.getElementById('validationModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeValidationModal();
        }
    });

    // Drag and drop support
    const fileInput = document.getElementById('fileInput');
    const dropZone = fileInput.parentElement;

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('border-orange-500', 'bg-orange-50');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('border-orange-500', 'bg-orange-50');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-orange-500', 'bg-orange-50');
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            updateFileName(fileInput);
        }
    });
</script>
