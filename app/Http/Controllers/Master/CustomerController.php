<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

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
}
