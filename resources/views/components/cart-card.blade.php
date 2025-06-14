@props([
    'name' => '',
    'description' => '',
    'price' => 0,  
])

<div class="cart-card flex flex-col w-full p-2.5 border border-gray-500 rounded-md gap-1.5"
    x-data="{
        quantity: 0,
        price: {{ $price }},
        updateTotal() {
            $name = '{{ $name }}'.toLowerCase().replace(/\s+/g, '_');
            $dispatch('update-summary', { name: $name, price: this.price, quantity: this.quantity })
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
    <a href="#" class="text-sm text-secondary hover:underline">
        Lihat detail produk
    </a>
    <div class="flex items-center justify-between">
        <span class="text-lg font-bold text-gray-900 dark:text-white">
            Rp{{ number_format($price, 0, '.', ',') }}
        </span>
        <div class="flex items-center gap-1">
            <button type="button" class="decrement w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white"
                @click="if (quantity > 0) quantity--; updateTotal()"
            > - </button>
            <span x-text="quantity" class="w-8 text-center text-base font-medium text-gray-900 dark:text-white">
                0
            </span>
            <button type="button" class="increment w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white"
                @click="quantity++; updateTotal()"
            > + </button>
        </div>
    </div>
</div>