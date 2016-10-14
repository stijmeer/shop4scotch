<?php

namespace App\Http\Controllers\Backoffice;

use App\Models\Basket;
use App\Models\Distillery;
use App\Models\Price;
use App\Models\Suggestion;
use App\Models\Tax;
use App\Models\Region;
use App\Models\Inventory;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backoffice.products.index')->with('products', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $distillery = Distillery::pluck('name', 'id');
        $suggestion = Suggestion::pluck('title', 'id');
        $tax        = Tax::pluck('title', 'id');
        $region     = Region::pluck('title', 'id');
        $product    = new Product();

        $data = [
            'distillery' => $distillery,
            'suggestion' => $suggestion,
            'tax'        => $tax,
            'region'     => $region,
            'product'    => $product,
        ];
        return view('backoffice.products.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $rules = [
            // product validation rules
            'name'                     => 'required|unique:products|max:255',
            'description'              => 'required',
            'price'                    => 'required|digits_between:0,100000',
            'age'                      => 'required|int|digits_between:0,255',
            'volume'                   => 'required|int|digits_between:0,64000',
            'color'                    => 'required',
            'smell'                    => 'required',
            'taste'                    => 'required',
            'alcohol_percentage'       => 'required|digits_between:0,100',
            'packaging'                => 'required',
            'suggestion'               => '',
            'distilleries'             => 'required',
            'taxes'                    => 'required',
            'img_product'              => 'required',
            'img_packaging'            => '',
            // suggestion validation rules
            'suggestions_name'         => 'unique:suggestions|max:255',
            'suggestions_description'  => '',
            // distillery validation rules
            'distilleries_name'        => 'unique:distilleries|max:255',
            'distilleries_description' => '',
            'regions'                  => '',
            // tax validation rules
            'taxes_name'               => 'unique:taxes|max:255',
            'taxes_description'        => '',
        ];

        $validator = Validator::make(Input::all(), $rules);

        // Process new product
        if ($validator->fails()) {
            return Redirect::to('backoffice/products/create/')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {
            // Check if  product image is valid
            if (Input::file('img_product')->isValid()) {

                //image name
                $imagename = urlencode(Input::get('name'));

                //Check if package image is present
                if (!empty(Input::file('img_packaging'))) {
                    // check if the image is valid
                    if(Input::file('img_packaging')->isValid()) {
                        //Save packaging image
                        $destinationpath = public_path() . '/product_images';
                        $extension = Input::file('img_packaging')->getClientOriginalExtension();
                        $filename = $imagename . '_2' . '.' . $extension;
                        Input::file('img_packaging')->move($destinationpath, $filename);
                        Session::flash('succes', 'Upload successful');

                        //Save product image + data
                        // Save product image
                        $destinationpath = public_path() . '/product_images';
                        $extension = Input::file('img_product')->getClientOriginalExtension();
                        $filename = $imagename .  '.' . $extension;
                        Input::file('img_product')->move($destinationpath, $filename);
                        Session::flash('succes', 'Upload successfully');

                        // Store suggestion if filled in
                        if (!empty(Input::get('suggestions_name')) && !empty(Input::get('suggestions_description'))) {
                            $suggestion              = new Suggestion();
                            $suggestion->title       = Input::get('suggestions_name');
                            $suggestion->content     = Input::get('suggestions_description');
                            $suggestion->save();
                        }

                        // Store distillery if filled in
                        if (!empty(Input::get('distilleries_name')) && !empty(Input::get('distilleries_description'))) {
                            $distillery              = new Distillery();
                            $distillery->name        = Input::get('distilleries_name');
                            $distillery->description = Input::get('distilleries_description');
                            $distillery->region_id   = Input::get('regions')[0];
                            $distillery->save();
                        }

                        // Store tax if filled in
                        if (!empty(Input::get('taxes_name')) && !empty(Input::get('taxes_description'))) {
                            $tax                     = new Tax();
                            $tax->title              = Input::get('taxes_name');
                            $tax->description        = Input::get('taxes_description');
                            $tax->save();
                        }

                        // Store product
                        $product                     = new Product();
                        $product->name               = Input::get('name');
                        $product->description        = Input::get('description');
                        $product->price              = Input::get('price');
                        $product->age                = Input::get('age');
                        $product->volume             = Input::get('volume');
                        $product->color              = Input::get('color');
                        $product->smell              = Input::get('smell');
                        $product->taste              = Input::get('taste');
                        $product->alcohol_percentage = Input::get('alcohol_percentage');
                        $product->packaging          = Input::get('packaging');
                        $product->suggestion_id      = Input::get('suggestions')[0];
                        $product->distillery_id      = Input::get('distilleries')[0];
                        $product->tax_id             = Input::get('taxes')[0];
                        $product->image              = $imagename . '.' . Input::file('img_product')->getClientOriginalExtension();
                        //only store image_packaging name if image is present
                        if (!empty(Input::file('img_packaging'))) {
                            $product->image_packaging = $imagename . '_2.' . Input::file('img_packaging')->getClientOriginalExtension();
                        } else {
                            $product->image_packaging = 0;
                        }
                        $product->save();

                        // Store price in history table
                        $price                       = new Price();
                        $price->price                = Input::get('price');
                        $price->added_on             = Carbon::now();
                        $price->product()->associate($product);
                        $price->save();
                    }

                } else {
                    //if no package image is present: save product image and data
                    // Save product image
                    $destinationpath = public_path() . '/product_images';
                    $extension = Input::file('img_product')->getClientOriginalExtension();
                    $filename = $imagename .  '.' . $extension;
                    Input::file('img_product')->move($destinationpath, $filename);
                    Session::flash('succes', 'Upload successfully');

                    // Store suggestion if filled in
                    if (!empty(Input::get('suggestions_name')) && !empty(Input::get('suggestions_description'))) {
                        $suggestion              = new Suggestion();
                        $suggestion->title       = Input::get('suggestions_name');
                        $suggestion->content     = Input::get('suggestions_description');
                        $suggestion->save();
                    }

                    // Store distillery if filled in
                    if (!empty(Input::get('distilleries_name')) && !empty(Input::get('distilleries_description'))) {
                        $distillery              = new Distillery();
                        $distillery->name        = Input::get('distilleries_name');
                        $distillery->description = Input::get('distilleries_description');
                        $distillery->region_id   = Input::get('regions')[0];
                        $distillery->save();
                    }

                    // Store tax if filled in
                    if (!empty(Input::get('taxes_name')) && !empty(Input::get('taxes_description'))) {
                        $tax                     = new Tax();
                        $tax->title              = Input::get('taxes_name');
                        $tax->description        = Input::get('taxes_description');
                        $tax->save();
                    }

                    // Store product
                    $product                     = new Product();
                    $product->name               = Input::get('name');
                    $product->description        = Input::get('description');
                    $product->price              = Input::get('price');
                    $product->age                = Input::get('age');
                    $product->volume             = Input::get('volume');
                    $product->color              = Input::get('color');
                    $product->smell              = Input::get('smell');
                    $product->taste              = Input::get('taste');
                    $product->alcohol_percentage = Input::get('alcohol_percentage');
                    $product->packaging          = Input::get('packaging');
                    $product->suggestion_id      = Input::get('suggestions')[0];
                    $product->distillery_id      = Input::get('distilleries')[0];
                    $product->tax_id             = Input::get('taxes')[0];
                    $product->image              = $imagename . '.' . Input::file('img_product')->getClientOriginalExtension();
                    //only store image_packaging name if image is present
                    if (!empty(Input::file('img_packaging'))) {
                        $product->image_packaging = $imagename . '_2.' . Input::file('img_packaging')->getClientOriginalExtension();
                    } else {
                        $product->image_packaging = 0;
                    }
                    $product->save();

                    // Store price in history table
                    $price                       = new Price();
                    $price->price                = Input::get('price');
                    $price->added_on             = Carbon::now();
                    $price->product()->associate($product);
                    $price->save();
                }

                function saveImageAndData($imagename) {
                    // Save product image
                    $destinationpath = public_path() . '/product_images';
                    $extension = Input::file('img_product')->getClientOriginalExtension();
                    $filename = $imagename .  '.' . $extension;
                    Input::file('img_product')->move($destinationpath, $filename);
                    Session::flash('succes', 'Upload successfully');

                    // Store suggestion if filled in
                    if (!empty(Input::get('suggestions_name')) && !empty(Input::get('suggestions_description'))) {
                        $suggestion              = new Suggestion();
                        $suggestion->title       = Input::get('suggestions_name');
                        $suggestion->content     = Input::get('suggestions_description');
                        $suggestion->save();
                    }

                    // Store distillery if filled in
                    if (!empty(Input::get('distilleries_name')) && !empty(Input::get('distilleries_description'))) {
                        $distillery              = new Distillery();
                        $distillery->name        = Input::get('distilleries_name');
                        $distillery->description = Input::get('distilleries_description');
                        $distillery->region_id   = Input::get('regions')[0];
                        $distillery->save();
                    }

                    // Store tax if filled in
                    if (!empty(Input::get('taxes_name')) && !empty(Input::get('taxes_description'))) {
                        $tax                     = new Tax();
                        $tax->title              = Input::get('taxes_name');
                        $tax->description        = Input::get('taxes_description');
                        $tax->save();
                    }

                    // Store product
                    $product                     = new Product();
                    $product->name               = Input::get('name');
                    $product->description        = Input::get('description');
                    $product->price              = Input::get('price');
                    $product->age                = Input::get('age');
                    $product->volume             = Input::get('volume');
                    $product->color              = Input::get('color');
                    $product->smell              = Input::get('smell');
                    $product->taste              = Input::get('taste');
                    $product->alcohol_percentage = Input::get('alcohol_percentage');
                    $product->packaging          = Input::get('packaging');
                    $product->suggestion_id      = Input::get('suggestions')[0];
                    $product->distillery_id      = Input::get('distilleries')[0];
                    $product->tax_id             = Input::get('taxes')[0];
                    $product->image              = $imagename . '.' . Input::file('img_product')->getClientOriginalExtension();
                    //only store image_packaging name if image is present
                    if (!empty(Input::file('img_packaging'))) {
                       $product->image_packaging = $imagename . '_2.' . Input::file('img_packaging')->getClientOriginalExtension();
                    } else {
                       $product->image_packaging = null;
                    }
                    $product->save();

                    // Store price in history table
                    $price                       = new Price();
                    $price->price                = Input::get('price');
                    $price->added_on             = Carbon::now();
                    $price->product()->associate($product);
                    $price->save();
                };


                // Show message
                Session::flash('message', 'Successfully created new Product: ' . Input::get('name') . ' !');

                // Redirect
                return redirect()->route('backoffice.products.index'); // $ artisan route:list
            } else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('backoffice/products/create');
            }
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
        $product       = Product::find($id);
        $suggestion    = $product->suggestion;
        $distillery    = $product->distillery;
        $tax           = $product->tax;
        $inventoryData = Inventory::select([
            DB::raw('MONTH(created_at) AS date'),
            DB::raw('AVG(stock) AS stock')
        ])
            ->whereYear('created_at', '=', date('Y'))
            ->where('product_id', '=', $id)
            ->groupby('date')
            ->orderby('date', 'ASC')
            ->get();
        $priceData = Price::select([
            DB::raw('MONTH(created_at) AS date'),
            DB::raw('AVG(price) AS price')
        ])
            ->whereYear('created_at', '=', date('Y'))
            ->where('product_id', '=', $id)
            ->groupby('date')
            ->orderby('date', 'ASC')
            ->get();
        $inventory = array();
        for ($i = 0; $i < 12; ++$i) {
            if(!isset($inventoryData[$i])) {
                $inventoryData[$i] = null;
            }
            array_push($inventory, $inventoryData[$i]['stock'] );
        }

        $price = array();
        for ($i = 0; $i < 12; ++$i) {
            if(!isset($priceData[$i])) {
                $priceData[$i] = null;
            }
            array_push($price, $priceData[$i]['price'] );
        }

        $labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

        $data = [
            'product'    => $product,
            'suggestion' => $suggestion,
            'distillery' => $distillery,
            'tax'        => $tax,
            'inventory'  => $inventory,
            'price'      => $price,
            'labels'     => $labels
        ];

        return view('backoffice.products.show', $data);

//        return view('backoffice.products.show')->with('product', Product::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $distillery = Distillery::pluck('name', 'id');
        $suggestion = Suggestion::pluck('title', 'id');
        $tax        = Tax::pluck('title', 'id');
        $region     = Region::pluck('title', 'id');
        $product    = Product::find($id);

        $data = [
            'distillery' => $distillery,
            'suggestion' => $suggestion,
            'tax'        => $tax,
            'region'     => $region,
            'product'    => $product,
        ];
        
        return view('backoffice.products.edit', $data);
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
        $rules = [
            // product validation rules
            'name'                     => 'required|unique:products|max:255',
            'description'              => 'required',
            'price'                    => 'required|digits_between:0,100000',
            'age'                      => 'required|int|digits_between:0,255',
            'volume'                   => 'required|int|digits_between:0,64000',
            'color'                    => 'required',
            'smell'                    => 'required',
            'taste'                    => 'required',
            'alcohol_percentage'       => 'required|digits_between:0,100',
            'packaging'                => 'required',
            'suggestion'               => '',
            'distilleries'             => 'required',
            'taxes'                    => 'required',
            // suggestion validation rules
            'suggestions_name'         => 'unique:suggestions|max:255',
            'suggestions_description'  => '',
            // distillery validation rules
            'distilleries_name'        => 'unique:distilleries|max:255',
            'distilleries_description' => '',
            'regions'                  => '',
            // tax validation rules
            'taxes_name'               => 'unique:taxes|max:255',
            'taxes_description'        => '',
        ];

        $validator = Validator::make(Input::all(), $rules);

        // Process edited product
        if ($validator->fails()) {
            return Redirect::to('backoffice/products/create/')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            // Store suggestion if filled in
            if (!empty(Input::get('suggestions_name')) && !empty(Input::get('suggestions_description'))) {
                $suggestion              = new Suggestion();
                $suggestion->title       = Input::get('suggestions_name');
                $suggestion->content     = Input::get('suggestions_description');
                $suggestion->save();
            }

            // Store distillery if filled in
            if (!empty(Input::get('distilleries_name')) && !empty(Input::get('distilleries_description'))) {
                $distillery              = new Distillery();
                $distillery->name        = Input::get('distilleries_name');
                $distillery->description = Input::get('distilleries_description');
                $distillery->region_id   = Input::get('regions')[0];
                $distillery->save();
            }

            // Store tax if filled in
            if (!empty(Input::get('taxes_name')) && !empty(Input::get('taxes_description'))) {
                $tax                     = new Tax();
                $tax->title              = Input::get('taxes_name');
                $tax->description        = Input::get('taxes_description');
                $tax->save();
            }

            // Store product
            $product                     = Product::find($id);
            $product->name               = Input::get('name');
            $product->description        = Input::get('description');
            $product->price              = Input::get('price');
            $product->age                = Input::get('age');
            $product->volume             = Input::get('volume');
            $product->color              = Input::get('color');
            $product->smell              = Input::get('smell');
            $product->taste              = Input::get('taste');
            $product->alcohol_percentage = Input::get('alcohol_percentage');
            $product->packaging          = Input::get('packaging');
            $product->suggestion_id      = Input::get('suggestions')[0];
            $product->distillery_id      = Input::get('distilleries')[0];
            $product->tax_id             = Input::get('taxes')[0];
            $product->save();

            // Store price in history table
            $price                       = new Price();
            $price->price                = Input::get('price');
            $price->added_on             = Carbon::now();
            $price->product()->associate($product);
            $price->save();

            // Show message
            Session::flash('message', 'Successfully edited product: ' . Input::get('name') . ' !');

            // Redirect
            return redirect()->route('backoffice.products.index'); // $ artisan route:list
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::destroy($id);
        return view('backoffice.products.index')->with('products', Product::all());
    }
}
