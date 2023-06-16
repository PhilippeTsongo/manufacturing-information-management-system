<?php

namespace App\Http\Controllers;

use App\Models\Production;
use Illuminate\Http\Request;

class CodeController extends Controller
{
    
    public function index()
    {
        //ALL PRODUCT WITH THEIR PRICES
        $products = Production::all();

        return view('qrcode.qrcode', compact('products'));
    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
