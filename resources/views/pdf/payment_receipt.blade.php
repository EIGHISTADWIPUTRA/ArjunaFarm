<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pembayaran - AR{{ $transaction->order_id }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #4CAF50;
            margin: 0;
        }
        .order-info {
            margin-bottom: 20px;
        }
        .order-info table {
            width: 100%;
        }
        .customer-info {
            width: 60%;
        }
        .order-id {
            width: 40%;
            text-align: right;
        }
        .order-details {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.items th, table.items td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        table.items th {
            background-color: #f5f5f5;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .total-section {
            margin-top: 20px;
            text-align: right;
        }
        .payment-info {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .status-success {
            color: green;
            font-weight: bold;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Arjuna Farm</h1>
        <p>Bukti Pembayaran</p>
    </div>

    <div class="order-info">
        <table>
            <tr>
                <td class="customer-info">
                    <h3>Informasi Pelanggan</h3>
                    <p>
                        <strong>{{ $transaction->name }}</strong><br>
                        {{ $transaction->email }}<br>
                        {{ $transaction->phone }}
                    </p>
                </td>
                <td class="order-id">
                    <h3>ID Pesanan: AR{{ $transaction->order_id }}</h3>
                    <p>
                        Tanggal: {{ \Carbon\Carbon::parse($transaction->payment_time)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}<br>
                        Status: 
                        @if($transaction->status == 'success')
                            <span class="status-success">LUNAS</span>
                        @else
                            {{ strtoupper($transaction->status) }}
                        @endif
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="order-details">
        <h3>Detail Pesanan</h3>
        <p>Tanggal Kegiatan: 20 Juni 2025</p>
        <table class="items">
            <thead>
                <tr>
                    <th>Kegiatan</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach($details as $detail)
                    @php $itemTotal = $detail->price * $detail->quantity; @endphp
                    @php $subtotal += $itemTotal; @endphp
                    <tr>
                        <td>{{ $detail->name }}</td>
                        <td>{{ $detail->description }}</td>
                        <td>{{ $detail->quantity }}x</td>
                        <td>Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($itemTotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="total-section">
        <table>
            <tr>
                <td style="text-align:right; width:80%;">Subtotal:</td>
                <td style="text-align:right;">Rp {{ number_format($subtotal, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td style="text-align:right;">Diskon:</td>
                <td style="text-align:right;">Rp 0</td>
            </tr>
            <tr>
                <td style="text-align:right; font-weight:bold;">Total:</td>
                <td style="text-align:right; font-weight:bold;">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="payment-info">
        <h3>Informasi Pembayaran</h3>
        <p>
            Metode Pembayaran: {{ $transaction->payment_type ?? '-' }}<br>
            Waktu Pembayaran: {{ \Carbon\Carbon::parse($transaction->payment_time)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}<br>
            Status: 
            @if($transaction->status == 'success')
                <span class="status-success">LUNAS</span>
            @else
                {{ strtoupper($transaction->status) }}
            @endif
        </p>
    </div>

    <div class="footer">
        <p>Terima kasih telah memilih Arjuna Farm!</p>
        <p>&copy; {{ date('Y') }} Arjuna Farm. All rights reserved.</p>
    </div>
</body>
</html>
