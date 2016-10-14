@extends('layouts.app')

@section('header')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Pick a presentation.</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Presentation Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>NMDAD II presentation</td>
                        <td>
                            <a href="presentations/presentation_01" target="_blank">
                                Start Presentation!
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer')
@endsection
