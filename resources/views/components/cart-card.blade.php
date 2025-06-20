@props([
    'id' => 0,
    'name' => '',
    'description' => '',
    'price' => 0,
    'type' => '',
    'min' => null,
])

@php
    $minQty = ($type === 'rombongan' && $min) ? (int)$min : 0;
@endphp

<div class="cart-card flex flex-col w-full p-2.5 border border-gray-500 rounded-md gap-1.5"
    x-data="{
        id: {{ $id }},
        quantity: 0,
        price: {{ $price }},
        min: {{ $minQty }},
        type: '{{ $type }}',
        increment() {
            if (this.type === 'rombongan' && this.quantity === 0 && this.min > 0) {
                this.quantity = this.min;
            } else {
                this.quantity++;
            }
            this.updateTotal();
        },
        decrement() {
            if (this.type === 'rombongan') {
                if (this.quantity > this.min) {
                    this.quantity--;
                } else if (this.quantity === this.min && this.quantity > 0) {
                    this.quantity = 0;
                }
            } else if (this.quantity > 0) {
                this.quantity--;
            }
            this.updateTotal();
        },
        updateTotal() {
            $name = '{{ $name }}'.toLowerCase().replace(/\s+/g, '_');
            $dispatch('update-summary', { id: this.id, price: this.price, quantity: this.quantity })
        }
    }"
    x-init="updateTotal()"
>
    <h3 class="text-md font-semibold text-gray-900 dark:text-white">
        {{ $name }}
    </h3>
    <p class="text-sm text-gray-600 dark:text-gray-400">
        {{ $description }}
    </p>
    <span class="inline-block px-2 py-1 text-xs font-semibold rounded bg-gray-200 text-gray-700 mb-1 w-fit bg-primary text-gray-900 dark:text-white">
        {{ ucfirst($type) }}
    </span>
    <a href="#" class="text-sm text-secondary hover:underline">
        Lihat detail produk
    </a>
    <div class="flex items-center justify-between">
        <span class="text-lg font-bold text-gray-900 dark:text-white">
            Rp{{ number_format($price, 0, '.', ',') }}
        </span>
        <div class="flex items-center gap-1">
            <button type="button" class="decrement w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white"
                @click="decrement()"
            > - </button>
            <span x-text="quantity" class="w-8 text-center text-base font-medium text-gray-900 dark:text-white">
                0
            </span>
            <button type="button" class="increment w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white"
                @click="increment()"
            > + </button>
        </div>
    </div>
</div>