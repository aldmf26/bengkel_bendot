<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{
    protected $model = Supplier::class;
    protected $view = 'master.suplier';
    protected $viewRedirect = 'suplier.index';

    public function index()
    {
        $suplier = $this->model::orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Suplier',
            'suplier' => $suplier
        ];
        return view("{$this->view}.index", $data);
    }

    public function store(Request $r)
    {
        $this->model::create($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Suplier Added');
    }

    public function update(Request $r, $id)
    {
        $this->model::find($id)->update($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Suplier Updated');
    }
    public function destroy($id)
    {
        $this->model::find($id)->delete();
        return redirect()->route($this->viewRedirect)->with('sukses', 'Suplier Deleted');
    }

    public function laporan()
    {
        $suplier = $this->model::orderBy('id', 'desc')->get();

        $data = [
            'title' => 'Laporan Suplier',
            'suplier' => $suplier
        ];

        return view("laporan.suplier.index", $data);
    }

    public function print()
    {
        $suplier = $this->model::with('sparepart')->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Laporan Suplier',
            'suplier' => $suplier,
        ];

        return view("laporan.suplier.print", $data);
    }
}
