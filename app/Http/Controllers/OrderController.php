<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Item;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    public function index(){
        return view('admin.orders.index')
            ->with('alls', $this->allOrders())
            ->with('news', $this->newOrder())
            ->with('inProgresss', $this->inProgress())
            ->with('canceleds', $this->canceledOrder())
            ->with('unpaidOrders', $this->unpaidOrder());
    }

    public function allOrders(){
        return Order::all();
    }

    public function newOrder(){
        return Order::where('status', 'NEW')->get();
    }

    public function inProgress(){
        return Order::where('status', 'IN PROGRESS')->get();
    }

    public function canceledOrder(){
        return Order::where('status', 'CANCELED')->get();
    }

    public function unpaidOrder(){
        return Order::where('status', 'UNPAID')->get();
    }

    // Show order
    public function show ($id){
        $order = Order::find($id);

        $user = User::find($order->order_by);

        $carts = Cart::where('order_id', $order->id)->get();

        $cartsTotals = Cart::where('order_id', $order->id)->get();

        $total = 0;

        foreach($cartsTotals as $cartsTotal){
            $total += ($cartsTotal->price * $cartsTotal->quantity);
        }

        return view('admin.orders.details')->with('lists', $order)
            ->with('user', $user)
            ->with('i', 1)
            ->with('carts', $carts)
            ->with('total', $total);
    }

    // Show order user
    public function showUser ($id){
        $order = Order::find($id);

        $user = User::find($order->order_by);

        $carts = Cart::where('order_id', $order->id)->get();

        $cartsTotals = Cart::where('order_id', $order->id)->get();

        $total = 0;

        foreach($cartsTotals as $cartsTotal){
            $total += ($cartsTotal->price * $cartsTotal->quantity);
        }

        return view('general.orders.show')->with('lists', $order)
            ->with('user', $user)
            ->with('i', 1)
            ->with('carts', $carts)
            ->with('total', $total);
    }

    // update status
    public function updateStatus(Request $request){
        $this->validate($request, [
            'tracking_id' => 'required',
            'status' => 'required'
        ]);

//        dd($request->id);
//
        $order = Order::find($request->id);

        $order->tracking_id = $request->tracking_id;
        $order->status = $request->status;
        $order->save();

        Session::flash('status', 'Order status updated');
        return redirect()->back();
    }
}
