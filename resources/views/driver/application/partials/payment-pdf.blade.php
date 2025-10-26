<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Breakdown - {{ $payment->payment_no }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #059669;
            padding-bottom: 30px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 28px;
            color: #059669;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .info-item {
            padding: 15px;
            background-color: #f9fafb;
            border-radius: 8px;
            border-left: 4px solid #059669;
        }

        .info-label {
            font-size: 12px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-size: 18px;
            font-weight: bold;
            color: #111;
        }

        .info-value.amount {
            color: #059669;
        }

        .breakdown-section {
            margin-bottom: 30px;
        }

        .breakdown-section h2 {
            font-size: 16px;
            color: #111;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e5e7eb;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .breakdown-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .breakdown-table thead {
            background-color: #f3f4f6;
            border-top: 2px solid #d1d5db;
            border-bottom: 2px solid #d1d5db;
        }

        .breakdown-table th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #374151;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .breakdown-table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .breakdown-table tbody tr:hover {
            background-color: #fafafa;
        }

        .amount-col {
            text-align: right;
            font-weight: 500;
            color: #059669;
        }

        .total-row {
            background-color: #ecfdf5;
            font-weight: bold;
            font-size: 16px;
            border-top: 2px solid #10b981;
            border-bottom: 2px solid #10b981;
        }

        .total-row td {
            padding: 15px 12px;
            color: #059669;
        }

        .instructions-section {
            background-color: #eff6ff;
            border: 2px solid #3b82f6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .instructions-section h3 {
            color: #1e40af;
            margin-bottom: 15px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .instructions-section ol {
            margin-left: 20px;
            color: #1e40af;
        }

        .instructions-section li {
            margin-bottom: 8px;
            font-size: 13px;
            line-height: 1.5;
        }

        .payment-number-box {
            display: inline-block;
            background-color: #f3f4f6;
            border: 2px dashed #9ca3af;
            padding: 8px 12px;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            color: #111;
        }

        .important-notice {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 30px;
        }

        .important-notice h4 {
            color: #92400e;
            margin-bottom: 8px;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .important-notice p {
            color: #78350f;
            font-size: 13px;
            line-height: 1.5;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #666;
            font-size: 12px;
        }

        .generated-date {
            color: #999;
            font-size: 11px;
        }

        @media print {
            body {
                background-color: white;
            }

            .container {
                box-shadow: none;
                padding: 0;
            }

            .info-section {
                page-break-inside: avoid;
            }

            .breakdown-section {
                page-break-inside: avoid;
            }
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .info-section {
                grid-template-columns: 1fr;
            }

            .breakdown-table {
                font-size: 12px;
            }

            .breakdown-table th,
            .breakdown-table td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📋 Payment Breakdown</h1>
            <p>Tricycle Franchise Application System</p>
        </div>

        <!-- Application & Payment Info -->
        <div class="info-section">
            <div class="info-item">
                <div class="info-label">Application Number</div>
                <div class="info-value">{{ $application->application_no }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Payment Number</div>
                <div class="info-value">{{ $payment->payment_no }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Applicant Name</div>
                <div class="info-value">{{ $application->full_name }}</div>
            </div>
            <div class="info-item">
                <div class="info-label">Generated Date</div>
                <div class="info-value">{{ now()->format('M d, Y') }}</div>
            </div>
        </div>

        <!-- Payment Breakdown Table -->
        <div class="breakdown-section">
            <h2>Payment Breakdown</h2>
            <table class="breakdown-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th class="amount-col">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payment->payment_items as $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td class="amount-col">₱{{ number_format($item['amount'], 2) }}</td>
                    </tr>
                    @endforeach
                    <tr class="total-row">
                        <td>TOTAL AMOUNT DUE</td>
                        <td class="amount-col">₱{{ number_format($payment->total_amount, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Payment Instructions -->
        <div class="instructions-section">
            <h3>💳 Payment Instructions</h3>
            <ol>
                <li><strong>Go to Treasury Office:</strong> Proceed to the SB Treasury Office during business hours</li>
                <li><strong>Present Payment Number:</strong> Provide the payment number: <span class="payment-number-box">{{ $payment->payment_no }}</span></li>
                <li><strong>Pay Amount:</strong> Pay the total amount of <strong>₱{{ number_format($payment->total_amount, 2) }}</strong></li>
                <li><strong>Keep Receipt:</strong> Save your official receipt for your records</li>
                <li><strong>Await Verification:</strong> After payment verification, your application will proceed to final approval</li>
            </ol>
        </div>

        <!-- Important Notice -->
        <div class="important-notice">
            <h4>⚠️ Important Notice</h4>
            <p><strong>Payment Deadline:</strong> Payment must be made within 30 days from the date of this breakdown. Failure to pay may result in application cancellation.</p>
            <p style="margin-top: 8px;"><strong>Processing Time:</strong> After payment verification, please allow 1-2 business days for your application to proceed to final approval.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>This is an official payment breakdown document from the Tricycle Franchise Application System.</p>
            <p class="generated-date">Generated on {{ now()->format('F d, Y \a\t g:i A') }}</p>
        </div>
    </div>
</body>
</html>
