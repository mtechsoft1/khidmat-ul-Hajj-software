<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="utf-8">
    <title>Hotel Reservation Invoice</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; padding: 20px; }
        .heading { font-size: 24px; font-weight: 700; color: #0f9d58; text-align: center; margin: 8px 0 0; }
        .sub-heading { font-size: 16px; font-weight: 700; color: #8b0000; text-align: center; margin: 0 0 18px; }
        .line { border-top: 3px solid #4b1248; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #2d2d2d; padding: 6px; vertical-align: top; }
        th { background: #4b1248; color: #fff; font-size: 11px; }
        .no-border td { border: none; padding: 1px 0; }
        .label { font-weight: 700; width: 170px; }
        .summary td { font-weight: 700; }
        .right { text-align: right; }
    </style>
</head>
<body>
    <table class="no-border">
        <tr>
            <td style="width: 60%;">
                <img src="{{ getLogoUrl($invoice->tenant_id) }}" alt="logo" style="width: 120px;">
            </td>
            <td style="width: 40%;">
                <table class="no-border">
                    <tr><td class="label">Reservation #</td><td>{{ $invoice->reservation_number ?? 'N/A' }}</td></tr>
                    <tr><td class="label">Reservation Date</td><td>{{ $invoice->reservation_date ?? 'N/A' }}</td></tr>
                    <tr><td class="label">Reservation ID</td><td>{{ $invoice->reservation_reference ?? 'N/A' }}</td></tr>
                    <tr><td class="label">User ID</td><td>{{ $invoice->reservation_user_id ?? 'N/A' }}</td></tr>
                    <tr><td class="label">Email</td><td>{{ $invoice->reservation_email ?? ($client->user->email ?? 'N/A') }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="heading">DEFINITIVE</div>
    <div class="sub-heading">NON-REFUNDABLE</div>
    <div class="line"></div>

    <p><strong>To:</strong> {{ $client->user->full_name ?? 'N/A' }}</p>
    <p>
        <strong>LEAD PAX:</strong> {{ $invoice->lead_pax ?? 'N/A' }}<br>
        <strong>NATIONALITY:</strong> {{ $invoice->nationality ?? 'N/A' }}<br>
        <strong>HOTEL:</strong> {{ $invoice->hotel_name ?? 'N/A' }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Hotel Conf #</th>
                <th>#Rooms</th>
                <th>Room Details</th>
                <th>Check In</th>
                <th>Check Out</th>
                <th>No. of Nights</th>
                <th>Meal Type</th>
                <th>SPL Remarks</th>
                <th>Price Per Room</th>
                <th>Meal Per Pax</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoice->invoiceItems as $item)
                <tr>
                    <td>Allotment</td>
                    <td>{{ number_format($item->quantity, 0) }}</td>
                    <td>{{ $item->product->name ?? $item->product_name ?? 'Room' }}</td>
                    <td>{{ $invoice->hotel_check_in ?? 'N/A' }}</td>
                    <td>{{ $invoice->hotel_check_out ?? 'N/A' }}</td>
                    <td>{{ $invoice->no_of_nights ?? 'N/A' }}</td>
                    <td>{{ $invoice->meal_type ?? 'N/A' }}</td>
                    <td>{{ $invoice->special_remarks ?? 'N/A' }}</td>
                    <td class="right">{{ number_format($item->price, 2) }}</td>
                    <td class="right">{{ number_format((float) ($invoice->meal_per_pax ?? 0), 2) }}</td>
                    <td class="right">{{ number_format($item->total, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="summary" style="margin-top: 6px;">
        <tr><td class="right">Total Price [SAR]</td><td class="right" style="width: 180px;">{{ number_format($invoice->amount ?? 0, 2) }}</td></tr>
        <tr><td class="right">VAT</td><td class="right">0.00</td></tr>
        <tr><td class="right">Municipality Tax</td><td class="right">{{ number_format((float) ($invoice->municipality_tax ?? 0), 2) }}</td></tr>
        <tr><td class="right">Net Total [SAR]</td><td class="right">{{ number_format($invoice->final_amount ?? 0, 2) }}</td></tr>
    </table>

    <p style="margin-top: 18px;">
        <strong>Standard Timings for all Hotels in Saudi Arabia:</strong><br>
        Check-in Time: 16:00 &amp; Check-out Time: 13:00
    </p>
    
    <p style="margin-top: 18px;">
        We assure you of our best services and attentions at all times and look forward to a lasting relationship with you.<br>
        Thanks &amp; Regards<br>
        <strong>TEAM KHIDMAT UL HUJJAJ</strong>
    </p>
    
    <p style="margin-top: 18px;">
        <u style="font-weight: 700;">SPECIAL REMARKS:</u><br>
        &bull; We hope that we have covered all your request waiting for your reply by the option date otherwise the reservation will be released automatically without prior notice.<br>
        &bull; No Bank Transfers will be Accepted Except From the Company's Bank Account<br>
        &bull; Above rates are net and non-commissionable quoted in Saudi Riyals<br>
        &bull; Check in after 16:00 hour and check out at 12:00 hour<br>
        &bull; Above Rates are including Municipality Fees 5% and 15%VAT Taxes.<br>
        &bull; Above Rates are excluding 10% Maqam Fees.<br>
        &bull; Weekdays (WD) are Saturday until Wednesday and Weekend (WE) are Thursday and Friday.
    </p>
    
    <p style="margin-top: 18px;">
        <strong>Cancelation &amp; Amendment Policy:</strong><br>
        &bull; Individual Bookings (less than 5 Rooms):<br>
        &bull; <strong>No Cancellation Non Refundable</strong><br>
        &bull; Contract with special terms &amp; Conditions.
    </p>
    
    <p style="margin-top: 18px;">
        <strong>Payment Policy:</strong><br>
        &bull; Individual booking has to be paid in full upon option date mentioned in confirmation letter.<br>
        &bull; <strong>Groups booking payment will be as follows:</strong><br>
        &bull; 20% of total amount upon confirmation<br>
        &bull; 50% of total amount has to be paid 21 days before each group arrival<br>
        &bull; 80% of total amount has to be paid 14 days before each group arrival<br>
        &bull; 100% of total amount has to be paid 07 days before each group arrival<br>
        In case of not meet above mentioned installment dates booking will be automatically released and will be subject to cancelation policy fees
    </p>
</body>
</html>
