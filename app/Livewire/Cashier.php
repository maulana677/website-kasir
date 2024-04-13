<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cashier extends Component
{
    public $menus;
    public $transaction;

    public function addToCart($id)
    {
        $menu = Menu::find($id);
        $transaction = Transaction::where('status', 'Cart')->first();

        if ($transaction == null) {
            Transaction::create([
                'customer_name' => 'No Name',
                'user_id' => Auth::user()->id,
                'total' => $menu->price,
                'status' => 'Cart'
            ]);

            $last_transaction = Transaction::where('status', 'Cart')->orderBy('id', 'DESC')->first();
            TransactionDetail::create([
                'transaction_id' => $last_transaction->id,
                'menu_id' => $menu->id,
                'quantity' => 1,
                'price' => $menu->price
            ]);
        } else {
            if ($transaction->details->where('menu_id', $id)->count() > 0) {
                $transaction_detail = TransactionDetail::where('transaction_id', $transaction->id)->where('menu_id', $id)->first();
                $transaction_detail->update([
                    'quantity' => $transaction_detail->quantity + 1,
                ]);
            } else {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'menu_id' => $id,
                    'quantity' => 1,
                    'price' => $menu->price
                ]);
            }
        }

        $this->transaction = Transaction::where('status', 'Cart')->first();
    }

    public function decrement($id)
    {
        $transaction_detail = TransactionDetail::find($id);
        if ($transaction_detail->quantity == 1) {
            $transaction_detail->delete();
        } else {
            $transaction_detail->update([
                'quantity' => $transaction_detail->quantity - 1,
            ]);
        }

        $this->transaction = Transaction::where('status', 'Cart')->first();
    }

    public function delete($id)
    {
        $transaction_detail = TransactionDetail::find($id);
        if ($transaction_detail->transaction->details->count() == 1) {
            $transaction_detail->transaction->delete();
        } else {
            $transaction_detail->delete();
        }

        $this->transaction = Transaction::where('status', 'Cart')->first();
    }

    public function mount()
    {
        $this->menus = Menu::all();
        $this->transaction = Transaction::where('status', 'Cart')->first();
    }

    public function render()
    {
        return view('livewire.cashier');
    }
}
