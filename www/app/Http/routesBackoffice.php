<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Price;
use App\User;

Route::group([
    //
], function () {
    Route::group([
        'namespace' => 'Backoffice',
        'prefix' => 'backoffice'
    ], function () {
        // Backoffice routes
        Route::get('/', function () {
            // Product that's present most in unordered baskets
            $mostWanted = Product::select('products.id AS product_id', 'products.name', 'products.price', 'products.image', DB::raw('SUM(basket_product.amount) AS total'))
                ->join('basket_product', 'products.id', '=', 'basket_product.product_id')
                ->groupBy('products.id')
                ->join('baskets', 'baskets.id', '=', 'basket_product.basket_id')
                ->join('basket_statuses', 'basket_statuses.id', '=', 'basket_status_id')
                ->where('basket_statuses.id', '=', 2)
                ->orderBy('total', 'DESC')
                ->limit(3)
                ->get();

            // Product that's present most in the orders
            $mostBought = Product::select('products.id AS product_id', 'products.name', 'products.price', 'products.image', DB::raw('SUM(order_product.quantity) AS total'))
                ->join('order_product', 'products.id', '=', 'order_product.product_id')
                ->groupBy('products.id')
                ->orderBy('total', 'DESC')
                ->limit(3)
                ->get();

            // Customer with the highest spending
            $bestCustomer = User::select(
                    'users.id AS user_id',
                    'users.name_first',
                    'users.name_second',
                    'users.name_last',
                    'order_product.quantity AS n_products',
                    'products.price AS price', 'taxes.rate AS tax',
                    DB::raw('SUM(products.price * order_product.quantity * taxes.rate) AS saldo'))
                ->join('orders', 'orders.user_id', '=', 'users.id')
                ->join('order_product', 'order_product.order_id', '=', 'orders.id')
                ->join('products', 'order_product.product_id', '=', 'products.id')
                ->join('taxes', 'products.tax_id', '=', 'taxes.id')
                ->groupBy('user_id')
                ->orderBy('saldo', 'DESC')
                ->whereNull('users.deleted_at')
                ->limit(10)
                ->get();

            $data = [
                'mostWanted' => $mostWanted,
                'mostBought' => $mostBought,
                'bestCustomer' => $bestCustomer,
            ];

            return view('backoffice.index', $data);
        });
        Route::get('/statistics', function() {
            $products = Product::select('name', 'id')->get();
            $data = [
                'products' => $products
            ];
            return view('backoffice.statistics', $data);
        });
        Route::get('statistics/{id}', function($id){
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

            $inventories = (object)array(
                "name" => "inventories",
                "data" => $inventory,
            );
            $prices = (object)array(
                "name" => "prices",
                "data" => $price
            );

            $labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            $series = [$inventories, $prices];

            $statistics = (object)array(
                "labels" => $labels,
                "series" => $series
            );

            $result = [$statistics];

            return (json_encode($result));
        });

        // Product routes
        Route::resource('products', 'ProductsController');

        // Suggestion routes
        Route::resource('suggestions', 'SuggestionsController');

        // Distilleries routes
        Route::resource('distilleries', 'DistilleriesController');

        // Taxes routes
        Route::resource('taxes', 'TaxesController');

        // presentations routes
        Route::get('/presentations', function ()
        {
            return view('backoffice.presentations.index');
        });
        Route::get('/presentations/presentation_{id}', function ($id)
        {
            return view('backoffice.presentations/presentation_' . $id . '.index');
        });
    });
});