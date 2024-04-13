<?php

namespace App\Livewire;

use App\Models\Menu;
use App\Models\Transaction;
use Livewire\Component;

class Cashier extends Component
{
    public $menus;
    public $transaction;

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
