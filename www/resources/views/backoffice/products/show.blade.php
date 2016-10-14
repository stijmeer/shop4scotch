@extends('layouts.app')

@section('header')

    {{-- Chartist --}}
    {{ Html::style('http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css') }}

@endsection

@section('content')
    {{--show product with id  {{ $product->id }}--}}
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 style="display: inline-block;">{{ $product->name }}</h3>
            <div class="pull-right">
                <a href="{{ $product->id }}/edit" class="btn btn-link">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['backoffice.products.destroy', $product->id],
                    'style' => 'display:inline-block;'
                ]) !!}
                {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type' => 'submit', 'class' => 'btn btn-link', 'style' => 'color:red; display:inline;'))}}
                {!! Form::close() !!}
            </div>
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <div class="col-md-4">
                    <img src="{{ URL::to('/product_images/' . $product->image) }}" alt="image of {{ $product->name }}" style="width:100%;">
                </div>
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th colspan="2"><br>Data</th>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td>{{ $product->stock }}</td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td>€ {{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>volume</th>
                                <td>{{ $product->volume }} cl</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td>{{ $product->age }} years old</td>
                            </tr>
                            <tr>
                                <th>Color</th>
                                <td>{{ $product->color }}</td>
                            </tr>
                            <tr>
                                <th>Smell</th>
                                <td>{{ $product->smell }}</td>
                            </tr>
                            <tr>
                                <th>Taste</th>
                                <td>{{ $product->taste }}</td>
                            </tr>
                            <tr>
                                <th>Alcohol Percentage</th>
                                <td>{{ $product->alcohol_percentage }} &percnt;vol</td>
                            </tr>
                            <tr>
                                <th>Packaging</th>
                                <td>{{ $product->packaging }}</td>
                            </tr>
                            <tr>
                                <th colspan="2"><br>Meta Data</th>
                            </tr>
                            <tr>
                                <th>Suggestion</th>
                                <td>{{ $suggestion->title }}</td>
                            </tr>
                            <tr>
                                <th>Distillery</th>
                                <td>{{ $distillery->name }}</td>
                            </tr>
                            <tr>
                                <th>Tax</th>
                                <td>{{ $tax->title }} ({{ $tax->rate*100 }}&percnt;)</td>
                            </tr>
                            <tr>
                                <th>Created at</th>
                                <td>{{ date('F d, Y', strtotime($product->created_at)) }}</td>
                            </tr>
                            <tr>
                                <th>Last Updated</th>
                                <td>{{ date('F d, Y', strtotime($product->updated_at)) }}</td>
                            </tr>
                            <tr>
                                <th colspan="2"><br>Statistics</th>
                            </tr>
                            <tr>
                                <th>Inventory history {{ date("Y") }}</th>
                                <td><div class="ct-chart ct-golden-section" id="chartInventory"></div></td>
                            </tr>
                            <tr>
                                <th>Price history {{ date("Y") }}</th>
                                <td><div class="ct-chart ct-golden-section" id="chartPrice"></div></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <a href="{{ $product->id }}/edit" class="btn btn-link">
                <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            {!! Form::open([
                'method' => 'DELETE',
                'route' => ['backoffice.products.destroy', $product->id],
                'style' => 'display:inline-block;'
            ]) !!}
            {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type' => 'submit', 'class' => 'btn btn-link', 'style' => 'color:red; display:inline;'))}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('footer')

    {{-- Chartist --}}
    {{ Html::script('http://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js') }}

    {{-- Custom scripts --}}
    <script type="text/javascript">
        $labels = <?php echo json_encode($labels) ?>;
        $inventory = <?php echo json_encode($inventory) ?>;
        $price = <?php echo json_encode($price) ?>;

        $(document).on('ready', function () {
            var chartInventoryData = {
                labels: $labels,
                series: [$inventory]
            };

            var chartPriceData = {
                labels: $labels,
                series: [$price]
            };

            var chartOptions = {
                low: 0,
                showArea: true,
                lineSmooth: Chartist.Interpolation.cardinal({
                    fillHoles:true
                })
            };

            new Chartist.Line('#chartInventory', chartInventoryData, chartOptions);
            new Chartist.Line('#chartPrice', chartPriceData, chartOptions);
        });
    </script>
@endsection
