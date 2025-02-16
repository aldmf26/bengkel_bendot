<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    protected $model = Customer::class;
    protected $view = 'master.customer';
    protected $viewRedirect = 'customer.index';

    public function index()
    {
        $datas = $this->model::orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Customer',
            'datas' => $datas
        ];
        return view("{$this->view}.index", $data);
    }

    public function store(Request $r)
    {
        $this->model::create($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Customer Added');
    }

    public function update(Request $r, $id)
    {
        $this->model::find($id)->update($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Customer Updated');
    }
    public function destroy($id)
    {
        $this->model::find($id)->delete();
        return redirect()->route($this->viewRedirect)->with('sukses', 'Customer Deleted');
    }

    public function laporanPenjualan()
    {

        $data = [
            'title' => 'Laporan Penjualan Customer',
        ];
        return view('laporan.penjualan_customer.index', $data);
    }
    public function printPenjualan(Request $r)
    {
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;

        $datas = DB::table('transactions as t')
            ->join('transaction_details as dt', 't.id', '=', 'dt.id_transaksi')
            ->join('customers as p', 't.id_pelanggan', '=', 'p.id')
            ->select(
                'p.nama as nama_pelanggan',
                DB::raw('SUM(CASE WHEN dt.id_sparepart != 0 THEN dt.jumlah ELSE 0 END) as total_sparepart'),
                DB::raw('SUM(CASE WHEN dt.id_service != 0 THEN dt.jumlah ELSE 0 END) as total_service'),
                DB::raw('SUM(dt.harga * dt.jumlah) as total_harga')
            )
            ->groupBy('p.id', 'p.nama')
            ->whereBetween('t.created_at', [$tgl1, $tgl2])
            ->get();
        $data = [
            'title' => 'Laporan Penjualan Customer',
            'datas' => $datas
        ];
        return view('laporan.penjualan_customer.print', $data);
    }
}
