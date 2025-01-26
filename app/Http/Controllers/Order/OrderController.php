<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Order'
        ];
        return view('cashier.order.index',$data);
    }

    public function print($nota)
    {
        $getTransaksi = Transaction::with(['customer','detail'])->where('no_nota', $nota)->first();
        $data = [
            'title' => 'Print Order',
            'getTransaksi' => $getTransaksi
        ];
        return view('cashier.order.print', $data);
    }
}
