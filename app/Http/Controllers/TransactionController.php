<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(){
        return view('admin.transactions.index')
            ->with('transactions', $this->allTransactions());
    }

    public function allTransactions(){
        return Transaction::all();
    }
}
