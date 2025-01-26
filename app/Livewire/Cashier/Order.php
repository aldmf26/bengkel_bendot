<?php

namespace App\Livewire\Cashier;

use App\Models\Category;
use App\Models\Customer;
use App\Models\LogTransaksiStok;
use App\Models\Service;
use App\Models\Sparepart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Order extends Component
{
    public
        $menus = [],
        $search = '',
        $kategoriBaru = '',
        $layananBaru = '',
        $customer = '',
        $customerAdd = [],
        $customerAll = [],
        $produks_count = '',
        $selectedLayanan = '2',
        $selectedKategori = 'Makanan';

    public function mount()
    {
        $this->selectedKategori = 0;
        $this->getMenus();
        $this->produks_count = Sparepart::count();
        $this->getCustomerAll();
    }

    public function updatedCustomer($value)
    {
        return $this->dispatch('customerChanged');
    }
    public function getCustomerAll()
    {
        $this->customerAll = Customer::orderBy('nama')->get()->toArray();
    }

    public function addCustomer()
    {

        // Simpan customer baru ke database
        Customer::create($this->customerAdd);

        // Reset form
        $this->reset('customerAdd');
        $this->dispatch('closeModal');
        $this->getCustomerAll();
    }

    #[Computed]
    public function layanan()
    {
        return collect([
            [
                'id' => '1',
                'kategori' => 'service',
            ],
            [
                'id' => '2',
                'kategori' => 'sparepart',
            ]
        ]);
    }
    #[Computed]
    public function kategoris()
    {
        return Category::withCount('sparepart')->get();
    }

    public function pilihLayanan($id)
    {
        $this->selectedLayanan = $id;

        $this->getMenus();
        $this->dispatch('layananChanged');
    }
    public function pilihKategori($value)
    {
        $this->selectedKategori = $value;
        $this->getMenus();
        $this->dispatch('kategoriChanged');
    }
    public function updatedSearch()
    {
        $this->getMenus();
        $this->dispatch('searchChanged');
    }
    public function getMenus()
    {
        $sparepart = Sparepart::selectRaw('nama,harga,stok,id,foto')
            ->when($this->search, function ($query) {
                $query->where('nama', 'LIKE', "%{$this->search}%");
            })
            ->when($this->selectedKategori, function ($query) {
                $query->where('id_kategori', $this->selectedKategori);
            })
            ->get()
            ->toArray();

        $service = Service::selectRaw('nama,harga,foto,id')
            ->when($this->search, function ($query) {
                $query->where('nama', 'LIKE', "%{$this->search}%");
            })
            ->get()
            ->toArray();

        $query = $this->selectedLayanan == '1' ? $service : $sparepart;

        $this->menus = collect($query)->map(function ($item) {
            $item['id'] = $this->selectedLayanan . '-' . $item['id'];
            return $item;
        })->toArray();
    }

    public function processOrder($data)
    {
        try {
            DB::beginTransaction();
            $nota = now()->format('ymd') . substr(uniqid(), -4);

            $existingTransaction = Transaction::where([
                ['id_pelanggan', $data['customerName']],
                ['no_nota', $nota],
            ])->first();

            if ($existingTransaction) {
                throw new \Exception('Transaksi dengan nota ini sudah ada.');
            }
            $admin = auth()->user()->name;
            $kembalian = $data['amountPaid'] - $data['grandTotal'];
            $transaction = Transaction::create([
                'id_pelanggan' => $data['customerName'],
                'no_nota' => $nota,
                'tanggal' => now(),
                'total_harga' => $data['grandTotal'],
                'metode_pembayaran' => $data['paymentMethod'],
                'jumlah_dibayar' => $data['amountPaid'],
                'kembalian' => $kembalian,
                'admin' => $admin
            ]);

            foreach ($data['items'] as $item) {
                list($layanan, $id) = explode('-', $item['id']);
                if ($layanan == 2) {
                    $sparepart = Sparepart::find($id);
                    $stok_sebelum = $sparepart->stok;
                    $sparepart->decrement('stok', $item['quantity']);
                    $stok_sesudah = $sparepart->stok;
                    LogTransaksiStok::create([
                        'id_transaksi' => $transaction->id,
                        'id_sparepart' => $id,
                        'tanggal' => now(),
                        'jenis_transaksi' => 'PENJUALAN',
                        'jumlah' => $item['quantity'],
                        'stok_sebelum' => $stok_sebelum,
                        'stok_sesudah' => $stok_sesudah,
                        'keterangan' => "PENJUALAN Sparepart $sparepart->nama",
                        'admin' => $admin
                    ]);
                }
                TransactionDetail::create([
                    'id_transaksi' => $transaction->id,
                    'id_sparepart' => $layanan == 2 ? $id : '',
                    'id_service' => $layanan == 1 ? $id : '',
                    'jumlah' => $item['quantity'],
                    'harga' => $item['harga'],
                    'admin' => $admin
                ]);
            }


            DB::commit();
            $this->alert('sukses', 'Transaksi berhasil');
            return redirect()->route('order.print', $nota);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->alert('error', $e->getMessage());
        }
    }


    public function render()
    {
        return view('livewire.cashier.order');
    }
}
