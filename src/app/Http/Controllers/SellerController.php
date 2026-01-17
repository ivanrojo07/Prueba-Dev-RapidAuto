<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportSellerRequest;
use App\Http\Requests\UpdateSellerRequest;
use App\Models\Lote;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SellerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sellers = Seller::with('lote')->paginate(10);

        return Inertia::render('Seller/Index',compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $lotes = Lote::all(['id','name']);
        return Inertia::render('Seller/Import',compact('lotes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImportSellerRequest $request)
    {
        //
        $request_all = $request->all();
        $data = collect($request_all['sellers'])->toArray();

        DB::table('sellers')->insert($data);
        return redirect()->route('seller.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Seller $seller)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Seller $seller)
    {
        //
        $lotes = Lote::all(['id','name']);
        return Inertia::render('Seller/Form',compact('seller','lotes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSellerRequest $request, Seller $seller)
    {
        //
        $seller->update($request->all());
        return redirect()->route('seller.index');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Seller $seller)
    {
        //
        $seller->delete();
        return redirect()->route('seller.index');
    }
}
