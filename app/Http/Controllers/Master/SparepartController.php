<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Sparepart;
use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartController extends Controller
{
    protected $model = Sparepart::class;
    protected $view = 'master.sparepart';
    protected $viewRedirect = 'sparepart.index';

    public function index()
    {
        $sparepart = $this->model::with(['kategori', 'suplier'])->orderBy('id', 'desc')->get();
        $kategoris = Category::all();
        $supliers = Supplier::all();
        
        $data = [
            'title' => 'Sparepart',
            'sparepart' => $sparepart,
            'kategoris' => $kategoris,
            'supliers' => $supliers,
        ];
        return view("{$this->view}.index", $data);
    }

    public function store(Request $r)
    {
        try {
            DB::beginTransaction();
            if ($r->hasFile('foto')) {
                $fotoPath = $r->file('foto')->store('sparepart', 'public');
                $data = $r->input();
                $data['foto'] = $fotoPath;
                $this->model::create($data);
            } else {
                $this->model::create($r->input());
            }
            DB::commit();
            return redirect()->route($this->viewRedirect)->with('sukses', 'Sparepart Added');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($this->viewRedirect)->with('error', $e->getMessage());
        }
    }

    public function update(Request $r, $id)
    {
        try {
            DB::beginTransaction();
            $sparepart = $this->model::find($id);
            if ($r->hasFile('foto')) {
                if (file_exists(storage_path('app/public/' . $sparepart->foto))) {
                    unlink(storage_path('app/public/' . $sparepart->foto));
                }
                $fotoPath = $r->file('foto')->store('sparepart', 'public');
                $data = $r->input();
                $data['foto'] = $fotoPath;
            } else {
                $data = $r->input();
            }
            $this->model::find($id)->update($data);
            DB::commit();
            return redirect()->route($this->viewRedirect)->with('sukses', 'Sparepart Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($this->viewRedirect)->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $sparepart = $this->model::find($id);
        if (file_exists(storage_path('app/public/' . $sparepart->foto))) {
            unlink(storage_path('app/public/' . $sparepart->foto));
        }
        $sparepart->delete();
        return redirect()->route($this->viewRedirect)->with('sukses', 'Sparepart Deleted');
    }

    public function laporan()
    {
        $sparepart = $this->model::with(['kategori', 'suplier'])->orderBy('id', 'desc')->get();
        $kategoris = Category::all();
        $supliers = Supplier::all();
        
        $data = [
            'title' => 'Laporan Sparepart',
            'sparepart' => $sparepart,
            'kategoris' => $kategoris,
            'supliers' => $supliers,
        ];

        return view("laporan.sparepart.index", $data);
    }

    public function print()
    {
        $sparepart = $this->model::with(['kategori', 'suplier'])->orderBy('id', 'desc')->get();
        $kategoris = Category::all();
        $supliers = Supplier::all();
        
        $data = [
            'title' => 'Laporan Sparepart',
            'sparepart' => $sparepart,
            'kategoris' => $kategoris,
            'supliers' => $supliers,
        ];

        return view("laporan.sparepart.print", $data);
    }

    public function laporanPenjualan()
    {

        $data = [
            'title' => 'Laporan Penjualan Sparepart',
        ];
        return view('laporan.penjualan_sparepart.index', $data);
    }
    public function printPenjualan(Request $r)
    {
        $tgl1 = $r->tgl1;
        $tgl2 = $r->tgl2;
        $datas = TransactionDetail::with(['sparepart'])
                    ->where('id_sparepart', '!=', 0)
                    ->whereBetween('created_at', [$tgl1, $tgl2])
                    ->get();
        $data = [
            'title' => 'Laporan Penjualan Sparepart',
            'datas' => $datas
        ];
        return view('laporan.penjualan_sparepart.print', $data);
    }
}
