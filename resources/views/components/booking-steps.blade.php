<div class="flex flex-col md:flex-row items-center justify-center gap-2 md:gap-4 mb-6">
    <div class="flex items-center {{ $currentStep >= 1 ? 'text-green-600' : 'text-gray-400' }}">
        <div class="w-8 h-8 rounded-full {{ $currentStep >= 1 ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600' }} flex items-center justify-center font-bold mr-2">1</div>
        <span class="font-semibold">Isi Data</span>
    </div>
    <div class="hidden md:block text-gray-300">→</div>
    <div class="flex items-center {{ $currentStep >= 2 ? 'text-green-600' : 'text-gray-400' }}">
        <div class="w-8 h-8 rounded-full {{ $currentStep >= 2 ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600' }} flex items-center justify-center font-bold mr-2">2</div>
        <span class="font-semibold">Pembayaran</span>
    </div>
    <div class="hidden md:block text-gray-300">→</div>
    <div class="flex items-center {{ $currentStep >= 3 ? 'text-green-600' : 'text-gray-400' }}">
        <div class="w-8 h-8 rounded-full {{ $currentStep >= 3 ? 'bg-green-600 text-white' : 'bg-gray-200 text-gray-600' }} flex items-center justify-center font-bold mr-2">3</div>
        <span class="font-semibold">Konfirmasi</span>
    </div>
</div>
