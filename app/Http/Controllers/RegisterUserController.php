<?php

namespace App\Http\Controllers;

use App\Order;
use App\Profile;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;
use DB;

class RegisterUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all roles
        $roles = Role::all();

        // Get all the users
        $users = User::all();

        return view('admin.users.index')->with('roles', $roles)->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'admin' => 'required|boolean',
            'references' => 'numeric|digits_between:10,11',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'admin' => $request->admin,
        ]);

        Profile::create([
            'user_id' => $user->id,
            'references' => $request->references != '' ? $request->references : 'NO REFERRAL',
            'picture' => 'upload\profile\48.jpg',
        ]);

        $user->role()->attach($request->role);

        Session::flash('status', 'User '. $user->name .' added successfully');
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::where('user_id', $id)->first();
        return view('general.profile.show')->with('profile', $profile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $profile = Profile::where('user_id', $id)->first();

        $this->validate($request, [
            'ic' => 'required|numeric|digits:12',
            'hp' => 'required|numeric|digits_between:10,11',
            'address' => 'required|string',
            'city' => 'required|string',
            'postcode' => 'required|numeric|digits:5',
            'state' => 'required|string',
            'picture' => 'image'
        ]);

        if($request->hasFile('picture')){

            $time = \Carbon\Carbon::now()->format('His');
            $filename = $request->picture->getClientOriginalName();

            $filename = $time.'-'.$filename;
            $dirname = 'public/upload\\profile';
            $dirnames = 'upload\\profile';
            $full_path = $dirnames.'\\'.$filename;

            $request->picture->storeAs($dirname, $filename);

            $profile->ic = $request->ic;
            $profile->hp = $request->hp;
            $profile->address = $request->address;
            $profile->city = $request->city;
            $profile->postcode = $request->postcode;
            $profile->state = $request->state;
            $profile->picture = $full_path;

            $profile->save();
        }else {
            $profile->ic = $request->ic;
            $profile->hp = $request->hp;
            $profile->address = $request->address;
            $profile->city = $request->city;
            $profile->postcode = $request->postcode;
            $profile->state = $request->state;
        }

        Session::flash('status', 'Profile updated successfully');
        return redirect()->back()->with('profile', $profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //View change password form
    public function changePassword($id){
        if(Auth::user()->id == $id){
            return view('general.profile.changePassword');
        }else{
            return redirect()->back();
        }
    }

    // Updating password
    public function updatePassword(Request $request, $id){
        $this->validate($request, [
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed|different:current_password',
        ]);

        $user = DB::table('users')->select('password')->where('id', $id)->get()->first();

        if(Hash::check($request->current_password, $user->password)){

            $update_password = User::find($id);
            $update_password->password = Hash::make($request->password);
            $update_password->save();

            Auth::logout();
            Session::flash('status', 'Password has been changed. Please login to continue');
            return redirect()->route('login');
        }else{
            Session::flash('status', 'Current password does not match');
            return redirect()->back();
        }
    }

    // Get user sales  / order data
    public function userOrders($id){

        $user = User::find($id);
        $orders = Order::where('order_by', $id)->where('status', 'DONE')->get();

        return view('admin.users.orders')
            ->with('monthly', $this->expensesMonthly($id))
            ->with('annually', $this->expensesYearly($id))
            ->with('minPurchase', $this->minPurchase($id))
            ->with('user', $user)
            ->with('orders', $orders);
    }

    // Getting expenses for current month
    public function expensesMonthly($id){
        return Order::where('order_by', Auth::user()->id)
            ->where('status', 'DONE')
            ->whereRaw('MONTH(created_at) = ?',[date('m')])
            ->whereRaw('YEAR(created_at) = ?',[date('Y')])
            ->sum('total');
    }

    // Getting expenses for current year
    public function expensesYearly($id){
        return Order::where('order_by', Auth::user()->id)
            ->where('status', 'DONE')
            ->whereRaw('YEAR(created_at) = ?',[date('Y')])
            ->sum('total');
    }

    // Getting user min purchase
    public function minPurchase($id){
        $user = User::find(Auth::user()->id);

        foreach($user->role as $role){
            return $role->min_purchase;
        }
    }
}
