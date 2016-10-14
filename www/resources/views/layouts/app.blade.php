<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shop4Scotch</title>

    <!-- Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        @media (min-width: 768px) {
            .navbar-collapse {
                height: auto;
                border-top: 0;
                box-shadow: none;
                max-height: none;
                padding-left:0;
                padding-right:0;
            }
            .navbar-collapse.collapse {
                display: block !important;
                width: auto !important;
                padding-bottom: 0;
                overflow: visible !important;
            }
            .navbar-collapse.in {
                overflow-x: visible;
            }

            .navbar {
                max-width: 300px;
                margin-right: 0;
                margin-left: 0;
                height: 100vh;

                position: fixed;
                top: 0;
                left: 0;
                overflow-y: auto;

                -ms-overflow-style: -ms-autohiding-scrollbar;
            }

            .navbar::-webkit-scrollbar {
                 background: transparent;
                 width: 0.5rem;
                padding-right: 0.25rem;
            }

            .navbar::-webkit-scrollbar-thumb {
                 background: #e7e7e7;
                 border-radius: 0.5rem;
             }

            .navbar-nav,
            .navbar-nav > li,
            .navbar-left,
            .navbar-right,
            .navbar-header
            {float:none !important;}

            .navbar-right .dropdown-menu {left:0;right:auto;}
            .navbar-collapse .navbar-nav.navbar-right:last-child {
                margin-right: 0;
            }

            nav li:hover {
                background-color: #e7e7e7;
                -webkit-transition: background-color 250ms linear;
                -moz-transition: background-color 250ms linear;
                -o-transition: background-color 250ms linear;
                -ms-transition: background-color 250ms linear;
                transition: background-color 250ms linear;
            }

            nav ul.panel {
                background-color: #f8f8f8;
            }

            nav ul.panel ul li a {
                padding-left: 2.5rem;
            }
        }
    </style>

    @yield('header')

</head>

<body id="app-layout" class="">

    <div class="container">
        <div class="row">
            <nav class="navbar navbar-default col-md-3" role="navigation">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('backoffice/') }}">Shop4Scotch</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse list-group">
                    <h4 class="text-center">Administrative</h4>
                    <ul class="nav navbar-nav list-group-item">
                            <li>
                                <a href="{{ URL::to('backoffice/') }}">home</a>
                            </li>
                        <?php $single = ['statistics', 'inventories', 'prices', 'presentations']; ?>
                        @foreach ($single as $item)
                            <li>
                                <a href="{{ URL::to('backoffice/' . $item ) }}">{{ $item }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <h4 class="text-center">Product Management</h4>
                    <ul class="nav navbar-nav list-group-item">
                        <?php $product = ['products', 'categories', 'countries', 'regions', 'distilleries', 'suggestions'];?>
                        @foreach ($product as $item)
                            <li>
                                <a href="{{ "#submenu_" . $item }}" data-toggle="collapse">{{ $item }}<span class="caret"></span></a>
                                <ul class="collapse panel nav navbar-nav" id="{{ "submenu_" . $item }}">
                                    <li><a href="{{ URL::to('backoffice/' . $item . '/' ) }}">Overview</a></li> {{-- Overview --}}
                                    <li><a href="{{ URL::to('backoffice/' . $item . '/create') }}">Add {{ $item }}</a></li> {{-- Create --}}
                                    {{--<li><a href="{{ URL::to('backoffice/' . $item . '/update') }}">Update {{ $item }}</a></li> --}}{{-- Update --}}
                                    {{--<li><a href="{{ URL::to('backoffice/' . $item . '/delete') }}">Remove {{ $item }}</a></li> --}}{{-- Delete --}}
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                    <h4 class="text-center">User Management</h4>
                    <ul class="nav navbar-nav list-group-item">
                        <?php $user = ['users', 'orders', 'addresses', 'baskets', 'reviews', 'promotions', 'taxes', 'wishlists'];?>
                        @foreach ($user as $item)
                            <li>
                                <a href="{{ "#submenu_" . $item }}" data-toggle="collapse">{{ $item }}<span class="caret"></span></a>
                                <ul class="collapse panel nav navbar-nav" id="{{ "submenu_" . $item }}">
                                    <li><a href="{{ URL::to('backoffice/' . $item . '/' ) }}">Overview</a></li> {{-- Overview --}}
                                    <li><a href="{{ URL::to('backoffice/' . $item . '/create') }}">Add {{ $item }}</a></li> {{-- Create --}}
                                    {{--<li><a href="{{ URL::to('backoffice/' . $item . '/update') }}">Update {{ $item }}</a></li> --}}{{-- Update --}}
                                    {{--<li><a href="{{ URL::to('backoffice/' . $item . '/delete') }}">Remove {{ $item }}</a></li> --}}{{-- Delete --}}
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            <div class="col-sm-offset-3 col-md-9" style="padding-top:2rem;">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    @yield('footer')

</body>
</html>
