<x-page-layout>
    <h1 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
        Informasi Reservasi
    </h1>
    <div class="flex w-full gap-8">
        <div class="flex flex-col w-2/3 bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-md gap-4">
            <form action="{{ route('ticket') }}" class="flex gap-4 items-end">
                <x-input-form
                    name="date" type="date"
                    label="Tanggal Kunjungan"
                    value="{{ isset($date) ? $date : '' }}"
                    required
                />
                <button type="submit" class="h-fit text-nowrap px-3 py-2 bg-primary text-white border border-primary rounded-md">
                    Cari Tiket
                </button>
            </form>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Pilihan Kegiatan
            </h2>
            <div class="flex flex-col gap-2"
                x-data="summaryHandler()" @update-summary.window="handleUpdate($event)"
            >
                <x-cart-card 
                    name="Berkuda"
                    description="Nikmati pengalaman berkuda mengelilingi padang rumput yang indah."
                    price="75000"
                />  
                <x-cart-card 
                    name="Memetik Buah"
                    description="Pengalaman memetik buah segar langsung dari kebun."
                    price="50000"
                />
                <x-cart-card 
                    name="Feeding Ternak"
                    description="Berinteraksi dan memberi makan ternak dengan pendampingan."
                    price="45000"
                />
            </div>
        </div>

        <div class="flex flex-col w-1/3 h-fit bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-md gap-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Pengunjung</h2>
            <form action="{{ route('payment.create') }}" method="POST" class="flex flex-col gap-2"
                x-data="summaryHandler()" @update-summary.window="handleUpdate($event)"
            >
                @csrf
                <x-input-form
                    name="name" type="text"
                    label="Nama Lengkap"
                    required
                />
                <x-input-form
                    name="phone" type="tel"
                    label="Nomor Telepon"
                    required
                />
                <x-input-form
                    name="email" type="email"
                    label="Email"
                    required
                />
                <hr>
                <div class="flex items-center justify-between">
                    <h2 class="text-sm text-gray-900 dark:text-white">Subtotal</h2>
                    <span x-text="format(subtotal)" class="text-sm text-gray-900 dark:text-white"></span>
                </div>
                <div class="flex items-center justify-between">
                    <h2 class="text-sm text-gray-900 dark:text-white">Diskon</h2>
                    <span x-text="format(discount)" class="text-sm text-gray-900 dark:text-white"></span>
                </div>
                <hr>
                <div class="flex items-center justify-between">
                    <input type="hidden" name="amount" :value="total">
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Total</h2>
                    <span x-text="format(total)" class="text-lg font-bold text-gray-900 dark:text-white"></span>
                </div>
                <div class="flex items-center gap-2 mt-2">
                    <input type="checkbox" name="terms" id="terms" class="rounded-sm border-0 outline-none focus:ring-0 focus:ring-offset-0" required>
                    <label for="terms" class="text-sm text-gray-600 dark:text-gray-400">
                        Saya setuju dengan <a href="#" class="text-primary hover:underline">syarat dan ketentuan</a>
                    </label>
                </div>
                <x-button type="submit" class="w-full h-12 bg-primary text-white rounded-lg mt-2">
                    Pesan Tiket
                </x-button>
            </form>
        </div>
    </div>
    <script>
        function summaryHandler() {
            return {
                subtotal: 0,
                discount: 0,
                total: 0,
                items: [],

                handleUpdate(e) {
                    console.log('Update received:', e.detail);
                    const { name, price, quantity } = e.detail;

                    // Update or add item
                    console.log(this.items);
                    const index = this.items.findIndex(i => i.name === name);
                    if (index >= 0) {
                        this.items[index].quantity = quantity;
                    } else {
                        this.items.push({ name, price, quantity });
                    }

                    this.calculateTotal();
                },

                calculateTotal() {
                    this.subtotal = this.items.reduce((acc, item) => acc + (item.price * item.quantity), 0);
                    console.log('Subtotal:', this.subtotal);
                    this.discount = 0; // Add logic if needed
                    this.total = this.subtotal - this.discount;
                },

                format(num) { return 'Rp' + new Intl.NumberFormat('id-ID').format(num); }
            }
        }
    </script>
</x-page-layout>