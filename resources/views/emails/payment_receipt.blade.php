<!DOCTYPE html>
<html>
<head>
    <title>Bukti Pembayaran - Arjuna Farm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #4CAF50;
            margin: 0;
        }
        .order-details {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 14px;
            color: #666;
        }
        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Arjuna Farm</h1>
            <p>Bukti Pembayaran Anda</p>
        </div>

        <div class="order-details">
            <p>Halo <strong>{{ $transaction->name }}</strong>,</p>
            <p>Terima kasih telah melakukan pembayaran. Berikut adalah rincian transaksi Anda:</p>

            <table>
                <tr>
                    <th>ID Pesanan</th>
                    <td>AR{{ $transaction->order_id }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($transaction->payment_time)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $transaction->name }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $transaction->email }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        @if($transaction->status == 'success')
                            <span style="color: green; font-weight: bold;">LUNAS</span>
                        @else
                            {{ strtoupper($transaction->status) }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ $transaction->payment_type }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                </tr>
            </table>

            <p>Bukti pembayaran lengkap dapat Anda lihat pada lampiran email ini.</p>
            
            <p>Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email atau nomor telepon yang tersedia.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Arjuna Farm. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
