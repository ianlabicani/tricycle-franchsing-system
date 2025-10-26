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

    // Print payment breakdown
    function printPaymentBreakdown() {
        const paymentNo = document.querySelector('[data-payment-no]')?.textContent || 'Payment';
        const printWindow = window.open('', '', 'height=600,width=800');

        const paymentItems = document.querySelectorAll('[data-payment-item]');
        let itemsHtml = '';
        paymentItems.forEach(item => {
            const name = item.dataset.itemName;
            const amount = item.dataset.itemAmount;
            itemsHtml += `<tr><td style="padding: 8px; border-bottom: 1px solid #e5e7eb;">${name}</td><td style="padding: 8px; text-align: right; border-bottom: 1px solid #e5e7eb;">₱${amount}</td></tr>`;
        });

        const totalAmount = document.querySelector('[data-total-amount]')?.textContent || '0.00';

        const printContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>Payment Breakdown - ${paymentNo}</title>
                <style>
                    * {
                        margin: 0;
                        padding: 0;
                        box-sizing: border-box;
                    }
                    body {
                        font-family: 'Arial', sans-serif;
                        color: #333;
                        background: white;
                        padding: 20px;
                    }
                    .container {
                        max-width: 600px;
                        margin: 0 auto;
                        background: white;
                        padding: 30px;
                        border: 2px solid #000;
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 30px;
                        border-bottom: 2px solid #000;
                        padding-bottom: 15px;
                    }
                    .header h1 {
                        font-size: 24px;
                        margin-bottom: 5px;
                    }
                    .header p {
                        font-size: 14px;
                        color: #666;
                    }
                    .payment-info {
                        margin-bottom: 30px;
                        background: #f9fafb;
                        padding: 15px;
                        border-radius: 5px;
                    }
                    .payment-info p {
                        margin: 8px 0;
                        font-size: 14px;
                    }
                    .payment-info strong {
                        color: #374151;
                    }
                    .breakdown {
                        margin-bottom: 20px;
                    }
                    .breakdown h2 {
                        font-size: 16px;
                        margin-bottom: 15px;
                        border-bottom: 2px solid #d1d5db;
                        padding-bottom: 10px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    table th {
                        text-align: left;
                        padding: 10px 0;
                        border-bottom: 2px solid #000;
                        font-weight: bold;
                        background: #f3f4f6;
                    }
                    table td {
                        padding: 10px 0;
                    }
                    .total-row {
                        background: #ecfdf5 !important;
                        font-weight: bold;
                        font-size: 16px;
                    }
                    .total-row td {
                        padding: 12px 0;
                        border-top: 2px solid #000;
                        border-bottom: 2px solid #000;
                    }
                    .footer {
                        margin-top: 30px;
                        text-align: center;
                        font-size: 12px;
                        color: #666;
                        border-top: 1px solid #e5e7eb;
                        padding-top: 15px;
                    }
                    .amount-column {
                        text-align: right;
                    }
                    @media print {
                        body {
                            padding: 0;
                        }
                        .container {
                            border: none;
                            max-width: 100%;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="container">
                    <div class="header">
                        <h1>📋 Payment Breakdown</h1>
                        <p>Tricycle Franchising System</p>
                    </div>

                    <div class="payment-info">
                        <p><strong>Payment Number:</strong> ${paymentNo}</p>
                        <p><strong>Printed on:</strong> ${new Date().toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</p>
                        <p><strong>Time:</strong> ${new Date().toLocaleTimeString('en-US')}</p>
                    </div>

                    <div class="breakdown">
                        <h2>Payment Items</h2>
                        <table>
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th class="amount-column">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${itemsHtml}
                                <tr class="total-row">
                                    <td>TOTAL AMOUNT</td>
                                    <td class="amount-column">₱${totalAmount}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="footer">
                        <p>Please keep this document for your records.</p>
                        <p>For inquiries, please contact the SB Treasury Office.</p>
                    </div>
                </div>

                <scr` + `ipt>
                    setTimeout(function() { window.print(); }, 250);
                </scr` + `ipt>
            </body>
            </html>
        `;

        printWindow.document.write(printContent);
        printWindow.document.close();
    }
</script>
