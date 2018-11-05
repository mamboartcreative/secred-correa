<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // { "name":"John", "age":30, "car":null }

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'min_purchase' => 'required|numeric',
            'losyen' => 'required|numeric',
            'kopi' => 'required|numeric',
            'trim' => 'required|numeric',
            'detox' => 'required|numeric'
        ]);

        $price = [
            "LOSYEN" => $request->losyen,
            "KOPI" => $request->kopi,
            "TRIM" => $request->trim,
            "DETOX" => $request->detox
        ];

        $jprice = json_encode($price);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'min_purchase' => $request->min_purchase,
            'price' => $jprice
        ]);

        Session::flash('status', 'Role '. $role->name .' added successfully');
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
        //
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
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
