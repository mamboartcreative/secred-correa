<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Role;
use App\Transaction;
use Illuminate\Http\Request;
use App\Item;
use App\Order;
use Session;
use Cart;
use Auth;
use App\User;

class PurchaseController extends Controller
{

    protected $price = 0;

    public function index(){
        $items = Item::all();
        return view('general.purchase.index')->with('items', $items)->with('cartCount', $this->cartCount())->with('prices', $this->userPrice());
    }

    public function userPrice(){
        $prices = '';

        foreach(Auth::user()->role as $role){
            $prices = $role->price;
        }

        return json_decode($prices);
    }

    public function addToCart($id){

        $item = Item::find($id);

        foreach($this->userPrice() as $key => $jprice){
            if($item->type == $key){
                $this->price = $jprice;
            }
        }

        if(Cart::has($id)){
            $item = Cart::get($id);
            Cart::updateQty($id, $item->quantity + 1);
        }else{
            Cart::add([
                'id' => $item->id,
                'name' => $item->name,
                'quantity' => 1,
                'price' => $this->price,
            ]);
        }

        Session::flash('status', 'Product '. $id .' added to cart');
        return redirect()->back();
    }

    public function listItemsInCart(){

        if(Cart::getTotal() == 0){
            return redirect()->route('products');
        }

        $items = Cart::getItems();
        return view('general.purchase.cartList')->with('items', $items)->with('total', Cart::getTotal());
    }


    public function cartCount(){
        return Cart::count();
    }

    public function clearCart(){
        Cart::clear();
        Session::flash('status', 'Cart list cleared');
        return redirect()->back();
    }

    public function removeItem($id){
        Cart::remove($id);
        Session::flash('status', 'Item removed');
        return redirect()->back();
    }

    public function addQuantity(Request $request){

        $this->validate($request, [
            'add_quantity' => 'numeric',
            'id' => 'required|numeric'
        ]);

        if(Cart::has($request->id)){
            $item = Cart::get($request->id);
            Cart::updateQty($request->id, $item->quantity + $request->add_quantity);
        }

        return redirect()->back();
    }

    // Purchase history
    public function getPurchaseHistory(){
        $orders = Order::where('order_by', Auth::user()->id)->get();
        return view('general.purchase.history')
            ->with('histories', $orders);
    }

    // Check out purchase
    public function checkout(){
        if(Cart::getTotal() == 0){
            return redirect()->route('products');
        }

        return view('general.purchase.checkout')->with('total', Cart::getTotal());
    }

    // Do checkout
    public function doCheckout(Request $request){
        $this->validate($request, [
            'hp' => 'required|numeric|digits_between:10,11',
            'address' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|numeric|digits:5',
            'state' => 'required|string'
        ]);

        $order = Order::create([
            //'order_by', 'total', 'tracking_id', 'remark', 'status', 'hp', 'address', 'city', 'postcode', 'state',
            'order_by' => Auth::user()->id,
            'total' => Cart::getTotal(),
            'tracking_id' => 'NA',
            'remark' => $request->remark,
            'status' => 'UNPAID',
            'hp' => $request->hp,
            'address' => $request->address,
            'city' => $request->city,
            'postcode' => $request->postcode,
            'state' => $request->state
        ]);

        foreach(Cart::getItems() as $item){
            \App\Cart::create([
                'item_id' => $item->id,
                'order_id' => $order->id,
                'price' => $item->price,
                'quantity' => $item->quantity,
                'name' => $item->name
            ]);
        }

        Cart::clear();

        Session::flash('status', 'New order added. Please do payment');
        return redirect()->route('dashboard');
    }

    public function createPayment($id){

        $order = Order::find($id);

        $user = User::find($order->order_by);

        $carts = \App\Cart::where('order_id', $order->id)->get();

        $cartsTotals = \App\Cart::where('order_id', $order->id)->get();

        $total = 0;

        foreach($cartsTotals as $cartsTotal){
            $total += ($cartsTotal->price * $cartsTotal->quantity);
        }

        return view('general.purchase.payment')->with('lists', $order)
            ->with('user', $user)
            ->with('i', 1)
            ->with('carts', $carts)
            ->with('total', $total);
    }

    public function makePayment(Request $request){
        $this->validate($request, [
            'picture' => 'required|image',
        ]);

        if($request->hasFile('picture')){

            $time = \Carbon\Carbon::now()->format('His');
            $filename = $request->picture->getClientOriginalName();

            $filename = $time.'-'.$filename;
            $dirname = 'public/upload\\payment';
            $dirnames = 'upload\\payment';
            $full_path = $dirnames.'\\'.$filename;

            $request->picture->storeAs($dirname, $filename);

            $order = Order::find($request->id);

            Transaction::create([
                'references' => $full_path,
                'order_id' => $request->id,
                'amount' => $order->total,
                'status' => 'OK',
                'remarks' => 'File path: '.$full_path
            ]);

            $order->status = 'NEW';
            $order->save();

            Session::flash('status', 'References added successfully');
            return redirect()->route('dashboard');
        }else{
            return redirect()->back();
        }
    }
}
