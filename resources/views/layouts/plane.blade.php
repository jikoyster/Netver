<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Audit Trail Only</title>
    <meta name="robots" content="noindex">

    <!-- Styles -->

    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/netver.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />
    <style type="text/css">
        .dropdown-submenu {
            position: relative;
        }

        .dropdown-submenu .dropdown-menu {
            top: 0;
            left: 100%;
            margin-top: -1px;
        }
        .caret-right {
            border-bottom: 4px solid transparent;
            border-top: 4px solid transparent;
            border-left: 4px solid;
            display: inline-block;
            height: 0;
            vertical-align: top;
            width: 0;
            margin-top: 7px;
        }
        #grid-basic > thead > tr > th:first-child,
        #grid-basic > tbody tr > td:first-child {
            width: 0px;
            visibility: hidden;
        }
        footer.footer > .container > button {
            color: blue;
            font-weight: bold;
        }
        footer.footer > .container > textarea {
            width: 700px;
            height: 100px;
            margin: 7px auto;
        }
        footer.footer > .container > span {
            font-size: 20px;
        }
        .popover {
            padding: 0;
        }
        .popover-title {
            background-color: #1c75fa;
            color: #fff;
            font-weight: bold;
        }
        .popover-content {
            min-height: 50px;
        }
        .custom-number-format {
            text-align: right;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    
                    <a class="navbar-brand hidden" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    @include('layouts.nav')
                </div>
            </div>
        </nav>

        <div class="col-md-12">
        <div class="col-md-12" style="background-color: #fff;">

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Activity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($audit_trails as $rec)
                        <tr>
                            <td>{{$rec->first_name}}</td>
                            <td>
                            	<div><strong>{{$rec->created_at.' '.\Carbon\Carbon::parse($rec->created_at)->diffForHumans()}}</strong></div>
                            	{{$rec->activity}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Issue</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ui_reports as $rec)
                        <tr>
                            <td>{{$rec->first_name}}</td>
                            <td>
                            	<div style="font-weight: bold;">
                            		{{$rec->created_at.' '.\Carbon\Carbon::parse($rec->created_at)->diffForHumans()}}
                            	</div>
                                <div style="font-weight: bold; color: {{($rec->resolved_status == '-status-resolved-') ? 'green':'red'}};">
                                	{{$rec->page}}
                                </div>
                                {{$rec->issue}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</body>
</html>