@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="breadcrumb">
            <a href="#">Informasi Reservasi</a> <span>></span>
            <a href="#">Detail Pembelian</a> <span>></span>
            <a href="#">Pembayaran</a>
        </div>

        <div class="booking-container">
            <div class="reservation-info">
                <h2>Informasi Reservasi</h2>
                <div class="form-group">
                    <label for="visit-date">Tanggal Kunjungan</label>
                    <input type="date" id="visit-date" class="form-control" value="2025-05-29">
                </div>

                <h2>Tiket Masuk</h2>

                <x-ticket-item title="DAIRYLAND" price="15.000" />
                <x-ticket-item title="MINIMANIA" price="25.000" />
                <x-ticket-item title="TIKET COMBO 2 WAHANA A" subtitle="DAIRYLAND + MINIMANIA" price="35.000" />
                <x-ticket-item title="TIKET COMBO 2 WAHANA B" subtitle="DAIRYLAND + SAKURA PARK" price="35.000" />
            </div>

            <div class="visitor-info">
                <h2>Informasi Pengunjung</h2>
                <div class="form-group">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" id="name" class="form-control" placeholder="Nama Lengkap">
                </div>
                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="tel" id="phone" class="form-control" placeholder="Telepon">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" class="form-control" placeholder="Email">
                </div>

                <div class="subtotal">
                    <span>SubTotal</span>
                    <span>Rp 0</span>
                </div>
                <div class="total">
                    <span>Total</span>
                    <span>Rp 0</span>
                </div>

                <div class="terms">
                    <input type="checkbox" id="agree">
                    <label for="agree">Saya menyetujui syarat & ketentuan yang berlaku</label>
                </div>

                <button class="btn-booking">
                    🎫 Beli Tiket Sekarang
                </button>
            </div>
        </div>
    </div>
@endsection