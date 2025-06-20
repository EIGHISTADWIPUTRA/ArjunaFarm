<x-page-layout>
    <h1 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">
        Informasi Reservasi
    </h1>
    <div class="flex w-full gap-8"
        x-data="{
            showModal: false,
            ...summaryHandler(),

            validateForm() {
                const form = document.getElementById('userform');

                if (!form.reportValidity()) return;

                this.showModal = true;
            }
        }"
        @update-summary.window="handleUpdate($event)"
    >
        <div class="flex flex-col w-2/3 bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-md gap-4">
            <form action="{{ route('ticket') }}" class="flex gap-4 items-end">
                <x-input-form
                    name="date" type="date"
                    label="Tanggal Kunjungan"
                    value="{{ $date? $date : '' }}"
                    required
                />
                <button type="submit" class="h-fit text-nowrap px-3 py-2 bg-primary text-white border border-primary rounded-md">
                    Cari Tiket
                </button>
            </form>
            
            <div class="flex flex-col gap-2">
                <label for="type" class="text-sm font-medium text-gray-900 dark:text-white">Tipe</label>
                <form action="{{ route('ticket') }}" method="GET" class="w-fit">
                    <select name="type" id="type" onchange="this.form.submit()" class="border border-gray-300 dark:border-gray-700 rounded-md px-3 py-2 text-sm bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-primary focus:border-primary outline-none">
                        <option value="" {{ request('type') == '' ? 'selected' : '' }}>Semua</option>
                        <option value="perorangan" {{ request('type') == 'perorangan' ? 'selected' : '' }}>Perorangan</option>
                        <option value="rombongan" {{ request('type') == 'rombongan' ? 'selected' : '' }}>Rombongan</option>
                    </select>
                </form>
            </div>
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                Pilihan Kegiatan
            </h2>
            <div class="flex flex-col gap-2">
                @php $type = request('type'); @endphp
                @forelse ($products as $product)
                    @if (!$type || $product->type === $type)
                        <x-cart-card 
                            :id="$product->id"
                            :name="$product->name"
                            :description="$product->description"
                            :price="$product->price"
                            :type="$product->type"
                            :min="$product->min"
                        />
                    @endif
                @empty
                    <div class="text-gray-500 text-sm">Tidak ada produk untuk tipe ini.</div>
                @endforelse
            </div>
        </div>

        <div class="flex flex-col w-1/3 h-fit bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-md gap-4">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Pengunjung</h2>
            <form id="userform" action="{{ route('payment.create') }}" method="POST" class="flex flex-col gap-2">
                @csrf
                <input type="hidden" name="date" value="{{ $date }}">
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
                    <input type="hidden" name="items" :value="JSON.stringify(items)">
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
                <button 
                    type="button" 
                    :class="['flex items-center justify-center w-full h-12 bg-primary font-bold text-white rounded-lg mt-2', total === 0 ? 'opacity-50' : '']"
                    :disabled="total === 0"
                    @click="validateForm()"
                >
                    Pesan Tiket
                </button>
            </form>
        </div>
    
        <!-- Confirmation Modal -->
        <div 
            x-show="showModal"
            x-cloak
            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40"
        >
            <x-product-card class="max-w-md">
                <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Konfirmasi Pemesanan</h3>
                <p class="mb-4 text-gray-700 dark:text-gray-300">
                    Setelah mengirimkan pesanan, data tidak dapat diubah. Apakah Anda yakin ingin melanjutkan?
                </p>
                <div class="flex justify-end gap-2">
                    <button 
                        type="button"
                        class="px-4 py-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200"
                        @click="showModal = false"
                    >Batal</button>
                    <button 
                        type="button"
                        class="px-4 py-2 rounded bg-primary text-white"
                        @click="
                            showModal = false;
                            document.getElementById('userform').submit();
                        "
                    >Ya, Pesan Tiket</button>
                </div>
            </x-product-card>
        </div>
        <input type="hidden" x-model="showModal" />
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
                    const { id, price, quantity } = e.detail;

                    // Update or add item
                    console.log(this.items);
                    const index = this.items.findIndex(i => i.id === id);
                    if (index >= 0) {
                        this.items[index].quantity = quantity;
                    } else {
                        this.items.push({ id, price, quantity });
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