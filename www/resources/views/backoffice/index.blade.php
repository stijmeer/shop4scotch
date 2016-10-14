@extends('layouts.app')

@section('header')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Shop4Scotch.local Backoffice</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Most wanted products</h4>
                </div>
                <div class="panel-body">
                    @foreach ($mostWanted as $product)
                        <div class="col-md-4 text-center">
                            <h4>
                                <a href="{{ URL::to('backoffice/products/' . $product->product_id) }}">{{ ucwords($product->name) }}</a>, &euro;{{ number_format($product->price, 2) }}
                            </h4>
                            <div class="col-md-6 col-md-offset-3">
                                <img src="{{ URL::to('/product_images/' . $product->image) }}"
                                     alt="image of {{ $product->name }}" style="width:100%;">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Best selling products.</h4>
                </div>
                <div class="panel-body">
                    @foreach ($mostBought as $product)
                        <div class="col-md-4 text-center">
                            <h4>
                                <a href="{{ URL::to('backoffice/products/' . $product->product_id) }}">{{ ucwords($product->name) }}</a>, &euro;{{ number_format($product->price, 2) }}
                            </h4>
                            <div class="col-md-6 col-md-offset-3">
                                <img src="{{ URL::to('/product_images/' . $product->image) }}"
                                     alt="image of {{ $product->name }}" style="width:100%;">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Most valuable costumers.</h4>
                    {{--<ul>--}}
                    {{--@foreach ($bestCustomer as $customer)--}}
                    {{--<li>{{ $customer->name_first }}</li>--}}
                    {{--@endforeach--}}
                    {{--</ul>--}}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <td>id</td>
                                <td>Full Name</td>
                                <td>Total Value</td>
                            </thead>
                            <tbody>
                            @foreach ( $bestCustomer as $customer )
                                <tr>
                                    <th>{{ $customer->user_id }}</th>
                                    <td>{{ $customer->name_first }} {{ $customer->name_second }} {{ $customer->name_last }}</td>
                                    <td><em>{{  number_format($customer->saldo, 2)}}</em></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
