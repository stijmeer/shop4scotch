@extends('layouts.app')

@section('header')
    {{--DataTables for jQuery--}}
    {{ Html::style('http://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css') }}
    
    {{--font awesome--}}
    {{ Html::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css') }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Products Overview</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="productsTable" class="table table-hover" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>&euro; {{ $product->price }}</td>
                            <td class="text-right">
                                <a href="{{ route('backoffice.products.show', $product->id) }}" class="btn btn-link">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                <a href="products/{{ $product->id }}/edit" class="btn btn-link">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['backoffice.products.destroy', $product->id],
                                    'style' => 'display:inline-block;'
                                ]) !!}
                                {{Form::button('<i class="fa fa-trash" aria-hidden="true"></i>', array('type' => 'submit', 'class' => 'btn btn-link', 'style' => 'color:red; display:inline;'))}}
                                {{--{!! Form::submit('Delete?', ['class' => 'btn btn-danger']) !!}--}}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    {{--DataTables for jQuery--}}
    {{ Html::script('http://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js') }}
    {{ Html::script('https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js') }}

    {{--custom script--}}
    <script>
        $(document).ready(function(){
            $('#productsTable').DataTable();
        });
    </script>
@endsection
