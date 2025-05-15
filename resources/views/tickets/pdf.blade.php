<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket Arjuna Farm</title>
    <style>
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .ticket {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }
        .ticket-header {
            background-color: #166534;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .ticket-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .ticket-body {
            padding: 20px;
        }
        .ticket-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .ticket-info-group {
            width: 48%;
        }
        .ticket-qr {
            text-align: center;
            margin: 20px 0;
        }
        .ticket-qr img {
            max-width: 200px;
            height: auto;
        }
        .ticket-details {
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .package-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .total {
            font-weight: bold;
            margin-top: 10px;
            text-align: right;
            font-size: 18px;
        }
        .instructions {
            background-color: #f9fafb;
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .instructions h3 {
            margin-top: 0;
        }
        .instructions ul {
            padding-left: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f1f5f9;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="ticket-header">
            <h1>Arjuna Farm E-Tiket</h1>
        </div>

        <div class="ticket-body">
            <div class="ticket-info">
                <div class="ticket-info-group">
                    <h3>Informasi Kunjungan</h3>
                    <table>
                        <tr>
                            <th>Nomor Tiket</th>
                            <td>{{ $order->order_number }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Kunjungan</th>
                            <td>{{ $order->visit_date->format('l, d F Y') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>Confirmed</td>
                        </tr>
                    </table>
                </div>

                <div class="ticket-info-group">
                    <h3>Informasi Pemesan</h3>
                    <table>
                        <tr>
                            <th>Nama</th>
                            <td>{{ $order->customer_name }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $order->customer_email }}</td>
                        </tr>
                        <tr>
                            <th>Telepon</th>
                            <td>{{ $order->customer_phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($order->qr_code)
                <div class="ticket-qr">
                    <img src="{{ public_path('storage/' . $order->qr_code) }}" alt="Ticket QR Code">
                    <p>Tunjukkan QR code ini saat memasuki area Arjuna Farm</p>
                </div>
            @endif

            <div class="ticket-details">
                <h3>Detail Paket</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Paket</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                            <tr>
                                <td>{{ $item->package->name }}</td>
                                <td>{{ $item->quantity }} peserta</td>
                                <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="total">
                    Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}
                </div>
            </div>

            <div class="instructions">
                <h3>Petunjuk Kunjungan</h3>
                <ul>
                    <li>Harap tiba 15 menit sebelum tur terjadwal Anda dimulai.</li>
                    <li>Kenakan pakaian dan alas kaki yang nyaman untuk kegiatan pertanian.</li>
                    <li>Jangan lupa membawa topi dan tabir surya untuk kegiatan di luar ruangan.</li>
                    <li>Anak-anak harus selalu diawasi oleh orang dewasa.</li>
                    <li>Perkebunan kami terletak di Jl. Raya Cibeuti KM 4, Kota Tasikmalaya.</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
