<div class="bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:shadow-xl hover:-translate-y-1">
    <img src="{{ Storage::url($package->image) }}" alt="{{ $package->name }}" class="w-full h-48 object-cover">
    <div class="p-6">
        <h3 class="text-xl font-bold mb-2 text-gray-800">{{ $package->name }}</h3>
        <p class="text-gray-600 mb-4">{{ Str::limit($package->description, 100) }}</p>

        @if($showPricing)
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-lg font-bold text-green-600">Rp {{ number_format($package->getDiscountedPrice(), 0, ',', '.') }}</span>
                    @if($package->discount_percentage > 0)
                        <span class="block text-xs text-gray-500 line-through">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                    @endif
                </div>
                <a href="{{ route('packages.show', $package) }}" class="inline-block text-green-600 hover:text-green-700 font-semibold">
                    Lihat Detail
                </a>
            </div>
        @else
            <div class="text-right">
                <a href="{{ route('packages.show', $package) }}" class="inline-block text-green-600 hover:text-green-700 font-semibold">
                    Lihat Detail
                </a>
            </div>
        @endif
    </div>
</div>
