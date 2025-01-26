<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mechanic;
use Illuminate\Http\Request;

class MekanikController extends Controller
{
    protected $model = Mechanic::class;
    protected $view = 'master.mekanik';
    protected $viewRedirect = 'mekanik.index';

    public function index()
    {
        $mekanik = $this->model::orderBy('id', 'desc')->get();
        $data = [
            'title' => 'Mekanik',
            'mekanik' => $mekanik
        ];
        return view("{$this->view}.index", $data);
    }

    public function store(Request $r)
    {
        $this->model::create($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Mekanik Added');
    }

    public function update(Request $r, $id)
    {
        $this->model::find($id)->update($r->input());
        return redirect()->route($this->viewRedirect)->with('sukses', 'Mekanik Updated');
    }
    public function destroy($id)
    {
        $this->model::find($id)->delete();
        return redirect()->route($this->viewRedirect)->with('sukses', 'Mekanik Deleted');
    }
}
