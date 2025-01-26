<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Mechanic;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceController extends Controller
{
    protected $model = Service::class;
    protected $view = 'master.service';
    protected $viewRedirect = 'service.index';

    public function index()
    {
        $service = $this->model::with('mekanik')->orderBy('id', 'desc')->get();
        $mekaniks = Mechanic::all();
        $data = [
            'title' => 'Service',
            'service' => $service,
            'mekaniks' => $mekaniks
        ];
        return view("{$this->view}.index", $data);
    }

    public function store(Request $r)
    {
        try {
            DB::beginTransaction();
            if ($r->hasFile('foto')) {
                $fotoPath = $r->file('foto')->store('service', 'public');
                $data = $r->input();
                $data['foto'] = $fotoPath;
                $this->model::create($data);
            } else {
                $this->model::create($r->input());
            }
            DB::commit();
            return redirect()->route($this->viewRedirect)->with('sukses', 'Service Added');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($this->viewRedirect)->with('error', $e->getMessage());
        }
    }

    public function update(Request $r, $id)
    {
        try {
            DB::beginTransaction();
            $service = $this->model::find($id);
            if ($r->hasFile('foto')) {
                if (file_exists(storage_path('app/public/' . $service->foto))) {
                    unlink(storage_path('app/public/' . $service->foto));
                }
                $fotoPath = $r->file('foto')->store('service', 'public');
                $data = $r->input();
                $data['foto'] = $fotoPath;
            } else {
                $data = $r->input();
            }
            $this->model::find($id)->update($data);
            DB::commit();
            return redirect()->route($this->viewRedirect)->with('sukses', 'Service Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route($this->viewRedirect)->with('error', $e->getMessage());
        }
    }
    public function destroy($id)
    {
        $service = $this->model::find($id);
        if (file_exists(storage_path('app/public/' . $service->foto))) {
            unlink(storage_path('app/public/' . $service->foto));
        }
        $service->delete();
        return redirect()->route($this->viewRedirect)->with('sukses', 'Service Deleted');
    }
}
