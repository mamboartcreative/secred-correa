<?php

namespace App\Http\Controllers;
use App\Item;
use Session;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return view('admin.items.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'required|string',
            'cost_price' => 'required|numeric',
            'selling_price' => 'required|numeric|gt:cost_price',
            'quantity' => 'required|numeric',
            'picture' => 'required|image',
        ]);

        if($request->hasFile('picture')){

            $time = \Carbon\Carbon::now()->format('His');
            $filename = $request->picture->getClientOriginalName();

            $filename = $time.'-'.$filename;
            $dirname = 'public/upload\\products';
            $dirnames = 'upload\\products';
            $full_path = $dirnames.'\\'.$filename;

            $request->picture->storeAs($dirname, $filename);

            Item::create([
                'name' => $request->name,
                'description' => $request->description,
                'cost_price' => $request->cost_price,
                'selling_price' => $request->selling_price,
                'quantity' => $request->quantity,
                'picture' => $full_path
            ]);

            Session::flash('status', 'Item added successfully');
            return redirect()->route('item.index');
        }else{
            return redirect()->back();
        }
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
