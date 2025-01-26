<div x-data="{
    addKategori: false,
    addLayanan: false,
    menus: [],
    customerAll: [],
    cartItems: [],
    customerName: '',
    paymentMethod: 'tunai',
    amountPaid: '',
    init() {

        this.customerAll = $wire.customerAll;
        this.menus = $wire.menus;
        console.log(this.customerAll)
        console.log(this.menus)
        window.addEventListener('layananChanged', () => {
            this.menus = $wire.menus;
        });
        window.addEventListener('kategoriChanged', () => {
            this.menus = $wire.menus;
        });

        window.addEventListener('searchChanged', () => {
            this.menus = $wire.menus;
        });

        window.addEventListener('closeModal', () => {
            this.customerAll = $wire.customerAll;
        });

        window.addEventListener('destroyCart', () => {
            this.destroyCart()
        });
    },
    destroyCart() {
        this.cartItems = [];
        this.paymentMethod = 'tunai';
        this.amountPaid = '';
    },
    addToCart(menu) {
        const existingItem = this.cartItems.find(item => item.id === menu.id);

        if (existingItem && existingItem.quantity < menu.stok) {
            existingItem.quantity++;
        } else if (!existingItem) {
            this.cartItems.push({
                ...menu,
                quantity: 1,
                cart_id: Date.now()
            });
        }
    },
    removeFromCart(cartId) {
        this.cartItems = this.cartItems.filter(item => item.cart_id !== cartId);
    },
    updateQuantity(id, newQty) {
        const item = this.cartItems.find(item => item.id_menu === id);
        if (item) {
            item.quantity = Math.max(1, Math.min(newQty, item.stok));
        }
    },
    get subtotal() {
        return this.cartItems.reduce((sum, item) => sum + (item.harga * item.quantity), 0);
    },
    get grandTotal() {
        return this.subtotal;
    }
}">

    <style>
        .category-card {
            border: none;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s;
            cursor: pointer;
        }

        .category-card:hover {
            background: var(--bs-primary);
            color: #dee2e6;
        }

        .menu-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
        }

        .search-bar {
            border-radius: 20px;
            border: 1px solid #dee2e6;
            padding: 10px 20px;
        }

        .cart-item-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>

    <div class="dontPrint">

        <!-- Menu List -->
        <div wire:loading wire:target="pilihLayanan">
            <div class="spinner-border text-primary mt-1" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <h6 class="">Layanan

        </h6>
        <div class="row">
            @foreach ($this->layanan as $d)
                <div class="col-lg-3">
                    <div class="card pointer" wire:click="pilihLayanan('{{ $d['id'] }}')">
                        <div class="card-body">
                            <nav class="nav-pills nav-fill">
                                <span
                                    class="{{ $d['id'] == $this->selectedLayanan ? 'nav-active' : '' }} fw-bold  nav-item nav-link ">{{ $d['kategori'] }}</span>
                            </nav>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($this->selectedLayanan == 2)
            <h6 class="">Categories
            </h6>
            <div class="row mb-2 overflow-auto"
                style="max-height: 120px;scrollbar-width: thin;scrollbar-color: #dee2e6 #f8f9fa;">
                <div style="padding: 0 10px;" class="d-flex gap-2 flex-nowrap">
                    <div wire:click="pilihKategori(0)"
                        class="category-card p-3 {{ $this->selectedKategori == 0 ? 'bg-primary text-white' : '' }}">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-screwdriver-wrench"></i>
                            <div>
                                <div class="text-nowrap">All</div>
                                <small class="text-nowrap">{{ $this->produks_count }} items</small>
                            </div>
                        </div>
                    </div>
                    @foreach ($this->kategoris as $d)
                        <div wire:click="pilihKategori('{{ $d->id }}')"
                            class="category-card p-3 {{ $d->id == $this->selectedKategori ? 'bg-primary text-white' : '' }}">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-screwdriver-wrench"></i>
                                <div>
                                    <div class="text-nowrap">{{ $d->nama }}</div>
                                    <small class="text-nowrap">{{ $d->sparepart_count }} items</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div wire:loading wire:target='pilihKategori,search'>
            <div class="spinner-border text-primary mt-1" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <input type="text" class="form-control mt-3" placeholder="Search menu" wire:model.live="search">

                <div class="row mt-4">

                    <template x-transition x-for="menu in menus" :key="menu.id">
                        <div class="col-lg-4">
                            <div :class="menu.stok === 0 ? 'card d-flex flex-row align-items-center p-2 disabled' :
                                'pointer card d-flex flex-row align-items-center p-2'"
                                :style="menu.stok === 0 ? 'max-width: 300px; cursor: not-allowed;' : 'max-width: 300px;'"
                                @click="(menu.stok === undefined || menu.stok > 0) && addToCart(menu)">
                                <img :src="`{{ Storage::url('${menu.foto}') }}`" class="menu-img rounded me-3"
                                    :alt="menu.nama"
                                    :style="menu.stok === 0 ? 'filter: grayscale(1) opacity(0.5);' : ''">
                                <div class="flex-grow-1 d-flex flex-column">
                                    <h6 style="font-size: 15px" x-text="menu.nama"></h6>
                                    <p class="mb-1 fw-bold me-2"
                                        x-text="new Intl.NumberFormat('id-ID').format(menu.harga)">
                                    </p>
                                    <p style="font-size: 11px" class="mb-1 fw-bold me-2"
                                        x-text="menu.stok === 0 ? '(Stok Habis)' : `(${menu.stok})`"></p>

                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="col-lg-4">
                <h6>Order Details</h6>
                <div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#addCustomer">+
                                        Customer</a>

                                    <div wire:ignore>
                                        <select x-model="customerName" class="form-select">
                                            <option value="">Pilih Customer</option>
                                            <template x-for="customer in customerAll" :key="customer.id">
                                                <option :value="customer.id" x-text="customer.nama"></option>
                                            </template>
                                        </select>
                                    </div>


                                    <form wire:submit.prevent="addCustomer">
                                        <x-modal idModal="addCustomer" title="Tambah Customer">
                                            <div class="mb-3">
                                                <label for="nama" class="form-label">Nama</label>
                                                <input type="text" class="form-control" id="nama"
                                                    name="customer[nama]" wire:model="customerAdd.nama" required />
                                                @error('customerAdd.nama')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    name="customer[email]" wire:model="customerAdd.email" required />
                                                @error('customerAdd.email')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="telepon" class="form-label">No HP</label>
                                                <input type="text" class="form-control" id="telepon"
                                                    name="customer[telepon]" wire:model="customerAdd.telepon"
                                                    required />
                                                @error('customerAdd.telepon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea class="form-control" id="alamat" name="customer[alamat]" wire:model="customerAdd.alamat" required></textarea>
                                                @error('customerAdd.alamat')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </x-modal>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <template x-for="item in cartItems" :key="item.cart_id">
                        <div class="d-flex align-items-center mb-3">
                            <img :src="`{{ Storage::url('${item.foto}') }}`" class="cart-item-img me-3">
                            <div class="flex-grow-1">
                                <h6 x-text="item.nama"></h6>
                                <div class="d-flex align-i  tems-center">
                                    <input type="number" x-model="item.quantity"
                                        class="form-control form-control-sm me-2" style="width: 60px" min="1"
                                        :max="item.stok === undefined ? 0 : item.stok"
                                        :disabled="item.stok === undefined">
                                    <span x-text="new Intl.NumberFormat('id-ID').format(item.harga)"></span>
                                    <button @click="removeFromCart(item.cart_id)"
                                        class="btn btn-danger btn-sm ms-2"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </template>

                </div>
                {{-- <div class="d-flex justify-content-between mt-3">
                <span><strong>Sub Total</strong></span>
                <span x-text="new Intl.NumberFormat('id-ID').format(subtotal)"></span>
            </div> --}}
                <div class="d-flex justify-content-between">
                    <span><strong>Grand Total</strong></span>
                    <span x-text="new Intl.NumberFormat('id-ID').format(grandTotal)"></span>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span><strong>Pembayaran</strong></span>
                    <select x-model="paymentMethod" class="form-select w-auto">
                        <option value="tunai">Tunai</option>
                        <option value="qris">Qris</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span><strong>Nominal Bayar</strong></span>
                    <div class="input-group">
                        <input type="number" x-model="amountPaid" class="form-control text-end" min="0">
                        <button class="btn btn-sm btn-outline-secondary" type="button"
                            @click="amountPaid = grandTotal">
                            <i class="fas fa-copy"></i>
                        </button>
                    </div>
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <span><strong>Kembalian</strong></span>
                    <span x-text="new Intl.NumberFormat('id-ID').format(amountPaid - grandTotal)"></span>
                </div>
                <button
                    @click.once="$wire.processOrder({ items: cartItems, customerName: customerName, grandTotal: grandTotal, paymentMethod: paymentMethod, amountPaid: amountPaid })"
                    class="text-white btn btn-primary w-100 mt-3"
                    :disabled="cartItems.length === 0 || (amountPaid - grandTotal) < 0 || customerName === ''">Process
                    Order</button>
                <div wire:loading wire:target='processOrder'>
                    <div class="spinner-border text-primary mt-1" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@section('scripts')
    <script>
        

        $(document).ready(function() {
            $('#select2').select2();
            $('#select2').on('change', function(e) {
                var data = $('#select2').select2("val");
                @this.set('customer', data);
            });
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('closeModal', () => {
                $("#addCustomer").modal('hide');
            });

        
        });
    </script>
@endsection
