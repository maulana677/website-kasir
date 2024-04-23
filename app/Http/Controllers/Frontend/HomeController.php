<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.home');
    }

    public function success($id)
    {
        $transaction = Transaction::find($id);
        return view('frontend.success', [
            'title' => 'Transaksi Sukses',
            'transaction' => $transaction
        ]);
    }

    public function print($id)
    {
        $transactionPrint = Transaction::find($id);
        return view('frontend.print', [
            'title' => 'Transaksi Sukses',
            'transactionPrint' => $transactionPrint
        ]);
    }

    public function order_list()
    {
        $orders = Transaction::orderBy('id', 'DESC')->where('status', '!=', 'Cart')->get();
        return view('frontend.order-list', [
            'title' => 'Order List',
            'orders' => $orders
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
