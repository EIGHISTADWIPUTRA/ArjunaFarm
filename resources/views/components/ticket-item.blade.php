@props(['title', 'subtitle' => null, 'price'])

<div class="ticket-item">
    <div class="ticket-title">{{ $title }}</div>
    @if ($subtitle)
        <div class="ticket-subtitle">{{ $subtitle }}</div>
    @endif
    <div class="ticket-price">Rp {{ $price }}</div>
    <div class="ticket-notes">
        <div>✓ Syarat & Ketentuan Tiket Online</div>
        <div>? Apa Yang anda Dapatkan?</div>
    </div>
    <div class="quantity-control">
        <div class="quantity-btn" onclick="decreaseQuantity(this)">-</div>
        <input type="text" class="quantity-input" value="0" readonly>
        <div class="quantity-btn" onclick="increaseQuantity(this)">+</div>
    </div>
</div>
