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
                    <input type="date" id="visit-date" class="form-control" value="{{ date('Y-m-d', strtotime('+1 day')) }}">
                </div>

                <h2>Tiket Masuk</h2>

                @forelse($tickets as $ticket)
                    <x-ticket-item
                        title="{{ $ticket->name }}"
                        subtitle="{{ $ticket->description }}"
                        price="{{ number_format($ticket->price, 0, ',', '.') }}"
                        :id="$ticket->id"
                    />
                @empty
                    <p>Tidak ada tiket yang tersedia.</p>
                @endforelse
            </div>

            <div class="visitor-info">
                <h2>Informasi Pengunjung</h2>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ticket_ids" id="ticket-ids" value="">
                    <input type="hidden" name="ticket_quantities" id="ticket-quantities" value="">
                    <input type="hidden" name="visit_date" id="visit-date-hidden">

                    <div class="form-group">
                        <label for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Nomor Telepon</label>
                        <input type="tel" id="phone" name="phone" class="form-control" placeholder="Telepon" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div class="subtotal">
                        <span>SubTotal</span>
                        <span id="subtotal-amount">Rp 0</span>
                    </div>
                    <div class="total">
                        <span>Total</span>
                        <span id="total-amount">Rp 0</span>
                    </div>

                    <div class="terms">
                        <input type="checkbox" id="agree" name="agree" required>
                        <label for="agree">Saya menyetujui syarat & ketentuan yang berlaku</label>
                    </div>

                    <button type="submit" class="btn-booking">
                        🎫 Beli Tiket Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sync the visit date with hidden field
            const visitDateInput = document.getElementById('visit-date');
            const visitDateHidden = document.getElementById('visit-date-hidden');

            // Set initial value
            visitDateHidden.value = visitDateInput.value;

            // Update on change
            visitDateInput.addEventListener('change', function() {
                visitDateHidden.value = this.value;
            });

            // Calculate total when quantity changes
            const quantityInputs = document.querySelectorAll('.quantity-input');
            quantityInputs.forEach(input => {
                input.addEventListener('change', calculateTotal);
            });

            // Form submission handling
            document.querySelector('form').addEventListener('submit', function(e) {
                e.preventDefault();

                // Collect ticket IDs and quantities
                const ticketItems = document.querySelectorAll('.ticket-item');
                const ticketIds = [];
                const ticketQuantities = [];

                let hasTickets = false;

                ticketItems.forEach(item => {
                    const id = item.getAttribute('data-id');
                    const quantity = parseInt(item.querySelector('.quantity-input').value);

                    if (quantity > 0) {
                        ticketIds.push(id);
                        ticketQuantities.push(quantity);
                        hasTickets = true;
                    }
                });

                if (!hasTickets) {
                    alert('Silakan pilih minimal satu tiket.');
                    return;
                }

                document.getElementById('ticket-ids').value = ticketIds.join(',');
                document.getElementById('ticket-quantities').value = ticketQuantities.join(',');

                this.submit();
            });

            function calculateTotal() {
                let subtotal = 0;

                const ticketItems = document.querySelectorAll('.ticket-item');
                ticketItems.forEach(item => {
                    const priceText = item.querySelector('.ticket-price').textContent;
                    const price = parseInt(priceText.replace('Rp ', '').replace('.', ''));
                    const quantity = parseInt(item.querySelector('.quantity-input').value);

                    subtotal += price * quantity;
                });

                // Format and display the total
                const formattedSubtotal = new Intl.NumberFormat('id-ID').format(subtotal);
                document.getElementById('subtotal-amount').textContent = `Rp ${formattedSubtotal}`;
                document.getElementById('total-amount').textContent = `Rp ${formattedSubtotal}`;
            }
        });

        // Increase quantity
        function increaseQuantity(btn) {
            const input = btn.previousElementSibling;
            input.value = parseInt(input.value) + 1;
            input.dispatchEvent(new Event('change'));
        }

        // Decrease quantity
        function decreaseQuantity(btn) {
            const input = btn.nextElementSibling;
            if (parseInt(input.value) > 0) {
                input.value = parseInt(input.value) - 1;
                input.dispatchEvent(new Event('change'));
            }
        }
    </script>
@endsection