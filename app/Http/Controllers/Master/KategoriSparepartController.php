<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class KategoriSparepartController extends Controller
{
    protected $model = Category::class;
    protected $view = 'master.kategori';
    protected $viewRedirect = 'kategori.index';

    public function index()
    {
        $kategori = $this->model::orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Kategori Sparepart',
            'kategori' => $kategori
        ];
        return view("{$this->view}.index", $data);
    }

    public function store(Request $r)
    {
        $this->model::create($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Kategori Added');
    }

    public function update(Request $r, $id)
    {
        $this->model::find($id)->update($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Kategori Updated');
    }
    public function destroy($id)
    {
        $this->model::find($id)->delete();
        return redirect()->route($this->viewRedirect)->with('sukses', 'Kategori Deleted');
    }

    public function laporan()
    {
        $kategori = $this->model::orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Kategori Sparepart',
            'kategori' => $kategori
        ];

        return view("laporan.kategori_sparepart.index", $data);
    }

    public function print()
    {
        $kategori = $this->model::with('sparepart')->orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Laporan Sparepart',
            'kategori' => $kategori,
        ];

        return view("laporan.kategori_sparepart.print", $data);
    }
}
