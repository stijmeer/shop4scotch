@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="panel panel-default">

                    <div class="panel-heading">Create a New Product</div>

                    <div class="panel-body">
                        @include('backoffice.suggestions.create_form')
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection