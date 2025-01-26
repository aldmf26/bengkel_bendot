<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\LogTransaksiStok;
use App\Models\Sparepart;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    public function index(Request $r)
    {
        if ($r->ajax()) {

            $data = Transaction::query();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $voidBtn = '<a href="' . route('transaksi.void', $row->no_nota) . '" class="edit btn btn-danger btn-sm" style="display: inline-block; margin-right: 5px;" onclick="return confirm(\'Apakah Anda yakin ingin menghapus transaksi ini?\')" ' . (auth()->user()->hasRole('presiden') ? '' : 'disabled') . '>Void</a>';
                        $printBtn = '<a href="' . route('order.print', $row->no_nota) . '" class="edit btn btn-success btn-sm" style="display: inline-block;">Print</a>';
                        return $voidBtn . $printBtn;
                    })
                    ->editColumn('tanggal', function($row) {
                        return tanggal(date('Y-m-d', strtotime($row->tanggal)));
                    })
                    ->editColumn('total_harga', function($row) {
                        return 'Rp. ' . number_format($row->total_harga, 0);
                    })
                    ->editColumn('jumlah_dibayar', function($row) {
                        return 'Rp. ' . number_format($row->jumlah_dibayar, 0);
                    })
                    ->editColumn('dibayar', function($row) {
                        return 'Rp. ' . number_format($row->dibayar, 0);
                    })
                    ->editColumn('kembalian', function($row) {
                        return 'Rp. ' . number_format($row->kembalian, 0);
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('cashier.transaksi.index',);
    }

    public function stokMasuk()
    {
        $datas = LogTransaksiStok::with(['sparepart', 'transaksi'])->where('jenis_transaksi', 'stock_in')->get();
        $data = [
            'title' => 'Stok Keluar',
            'datas' => $datas
        ];

        return view('cashier.transaksi.stok_masuk.index', $data);
    }

    public function stokKeluar()
    {
        $datas = LogTransaksiStok::with(['sparepart', 'transaksi'])->where('jenis_transaksi', 'penjualan')->get();
        $data = [
            'title' => 'Stok Keluar',
            'datas' => $datas
        ];

        return view('cashier.transaksi.stok_keluar.index', $data);
    }

    public function void($no_nota)
    {

        try {
            DB::beginTransaction();

            $transaksi = Transaction::where('no_nota', $no_nota)->first();
            $logTransaksiStok = LogTransaksiStok::where('id_transaksi', $transaksi->id)->get();

            foreach ($logTransaksiStok as $log) {
                $sparepart = Sparepart::find($log->id_sparepart);
                if ($sparepart) {
                    $sparepart->stok += $log->jumlah; // Kembalikan stok
                    $sparepart->save();
                }
            }

            LogTransaksiStok::where('id_transaksi', $transaksi->id)->delete();
            TransactionDetail::where('id_transaksi', $transaksi->id)->delete();
            $transaksi->delete();

            DB::commit();

            return redirect()->route('transaksi.index')->with('sukses', 'berhasil void');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('transaksi.index')->with('error', $e->getMessage());
        }
    }
}
