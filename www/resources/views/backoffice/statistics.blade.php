@extends('layouts.app')

@section('header')

    {{--bootstrap select--}}
    {{ Html::style('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css') }}

    {{-- Chartist --}}
    {{ Html::style('http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css') }}

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Annual Statistics {{ date("Y") }}</h1><br>
        </div>
    </div>
    <div class="row">
        <form>
            <fieldset>
                <div class="form-group col-md-12">
                    <label for="product">Choose a product to view price and stock history</label><br>
                    <select name="product" id="product" class="selectpicker col-md-12" data-live-search="true">
                        <option value="0" selected disabled>Please maka a selection.</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
            </fieldset>
        </form>
        <div class="col-md-12">
            <div class="ct-chart ct-golden-section"></div>
        </div>
    </div>

@endsection

@section('footer')

    {{--bootstrap select--}}
    {{ Html::script('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js') }}

    {{-- Chartist --}}
    {{ Html::script('http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js') }}

    {{-- Custom scripts --}}
    <script type="text/javascript">

        $(document).on('ready', function () {

            $('#product').change(function () {
                $.ajax({
                    url: "/backoffice/statistics/" + $(this).val(),
                    data: {_token: "{!!csrf_token()!!}"},
                    dataType: 'json',
                    method: "get"
                }).done(function (data) {
                    var chartData = {
                        labels: data[0].labels,
                        series: [{
                            name: "inventory",
                            data: data[0].series[0].data
                        }, {
                            name: "price",
                            data: data[0].series[1].data
                        }]
                    };

                    var chartOptions = {
                        low: 0,
                        showArea: true,
                        lineSmooth: Chartist.Interpolation.cardinal({
                            fillHoles:true
                        })
                    };

                    new Chartist.Line('.ct-chart', chartData, chartOptions);
                })
            });
        });

    </script>

@endsection
