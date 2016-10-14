<?php

namespace App\Http\Controllers\Api;

use App\Models\Distillery;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::with('distillery', 'distillery.region', 'distillery.region.country', 'suggestion', 'tax')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('distillery', 'distillery.region', 'distillery.region.country', 'suggestion', 'tax')->find($id);

        return $product ?: response()
            ->json([
                'error' => "Product '$id' not found",
            ])
            ->setStatusCode(Response::HTTP_NOT_FOUND);
        

    }
}
