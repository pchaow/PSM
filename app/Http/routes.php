<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//web apps.

Route::get('/', function () {
    $suppliers = \App\Models\Supplier::all();
    return view('menu');
});

Route::get('/product', function () {
    $products = \App\Models\Product::all();
    return view('product')
        ->with('products', $products);
});

Route::post('/product', function (\Illuminate\Http\Request $request) {
    \App\Models\Product::create($request->all());
    return redirect('/product');
});

Route::get('/product/{id}', function (\Illuminate\Http\Request $request, $id) {
    $product = \App\Models\Product::find($id);
    $suppliers = \App\Models\Supplier::all();
    return view('productView')
        ->with('product', $product)
        ->with('suppliers', $suppliers);
});

Route::post('/product/{id}', function (\Illuminate\Http\Request $request, $id) {

    $value = new \App\Models\Value();
    $value->price = $request->get('price');
    $value->product()->associate(\App\Models\Product::find($request->get('product_id')));
    $value->supplier()->associate(\App\Models\Supplier::find($request->get('supplier_id')));
    $value->save();

    return redirect("/product/$id");
});


Route::get('/supplier', function () {
    $suppliers = \App\Models\Supplier::all();
    return view('supplier')
        ->with('suppliers', $suppliers);
});

Route::post('/supplier', function (\Illuminate\Http\Request $request) {
    \App\Models\Supplier::create($request->all());
    return redirect('/supplier');
});


// api and webservice.
header('Access-Control-Allow-Origin', '*');
header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');

Route::get('/api/supplier', function () {
    return \App\Models\Supplier::all();
});

Route::post('/api/supplier', function (\Illuminate\Http\Request $request) {
    return \App\Models\Supplier::create($request->all());
});

Route::get('/api/product', function () {
    return \App\Models\Product::with(['values', 'values.supplier'])->get();
});

Route::get('/api/product/{id}', function ($id) {
    return \App\Models\Product::with(['values', 'values.supplier'])->find($id);
});

Route::post('/api/product', function (\Illuminate\Http\Request $request) {
    return \App\Models\Product::create($request->all());
});

Route::post('/api/product/{id}/value', function (\Illuminate\Http\Request $request, $id) {
    $value = new \App\Models\Value();
    $value->price = $request->get('price');
    $value->product()->associate(\App\Models\Product::find($request->get('product_id')));
    $value->supplier()->associate(\App\Models\Supplier::find($request->get('supplier_id')));
    $value->save();
    return $value;
});