<?php

namespace App\Http\Controllers;

use App\Order;
use App\Profile;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){

        return view('general.dashboard.index')
            ->with('teamMember', $this->teamMember())
            ->with('minPurchase', $this->minPurchase())
            ->with('pendingOrders', $this->getPendingOrder())
            ->with('expenses', $this->expenses())
            ->with('canceledOrders', $this->getCanceledOrder())
            ->with('getUnpaidOrders', $this->getUnpaidOrders());
    }

    // Team member count for logged in user
    public function teamMember(){
        return Profile::where('references', Auth::user()->profile->hp)->get()->count();
    }

    // Getting user min purchase
    public function minPurchase(){
        $user = User::find(Auth::user()->id);

        foreach($user->role as $role){
            return $role->min_purchase;
        }
    }

    // Getting pending orders
    public function getPendingOrder(){
        return Order::where('order_by', Auth::user()->id)->where('status', 'IN PROGRESS')->get();
    }

    // Getting canceled orders
    public function getCanceledOrder(){
        return Order::where('order_by', Auth::user()->id)->where('status', 'CANCELED')->get();
    }

    public function getUnpaidOrders(){
        return Order::where('order_by', Auth::user()->id)->where('status', 'UNPAID')->get();
    }

    // Getting expenses for current month
    public function expenses(){

        $now = Carbon::now();

        return Order::where('order_by', Auth::user()->id)
            ->where('status', 'DONE')
            ->whereRaw('MONTH(created_at) = ?',[date('m')])
            ->whereRaw('YEAR(created_at) = ?',[date('Y')])
            ->sum('total');
    }

}
