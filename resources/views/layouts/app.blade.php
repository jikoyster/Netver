<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
    @yield('css')
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

        @yield('content')

        @if(Auth::check())
            <footer class="footer text-center">
              <div class="container">
                <button class="btn" id="report_prob_btn">Report a problem or mistake on this page</button>
                <textarea required class="form-control" name="report_prob" style="display: none;"></textarea>
                <button class="btn" style="display: none;" id="sbmit_prob_btn">Submit</button>
              </div>
            </footer>
        @endif
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            $('.dropdown-submenu a.test').on("mouseover", function(e){
                $(this).parent().parent().find('.dropdown-submenu').find('a').next('ul').hide();
                $(this).next('ul').toggle();
                e.stopPropagation();
                e.preventDefault();
            });
            $(".alert").fadeTo(7000, 500).slideUp(1000, function(){
                $(".alert").slideUp();
            });

            $('#report_prob_btn').click(function(){
                $('[name=report_prob]').slideToggle();
                $('#sbmit_prob_btn').slideToggle();
            });

            $('#sbmit_prob_btn').click(function(){
                $.post('<?=route('ui-reports')?>', {
                    _token: $('[name=_token]').val(),
                    url: '{{url()->current()}}',
                    issue: $('[name=report_prob]').val()
                }).success(function(data){
                    if('ui-reports' == "<?=Request::segment(1)?>")
                        window.location="<?=url()->current()?>";
                }).error(function(error){
                    if(error.responseJSON.message != 'Unauthenticated.')
                        console.log(error.responseJSON.errors.issue[0]);
                });

                $('[name=report_prob]').slideToggle();
                $('#sbmit_prob_btn').slideToggle(function(){
                    $('footer.footer > .container').html('<span class="text-white"><strong>Report Submitted!</strong></span>');
                    setTimeout(function(){
                        $('footer.footer > .container').slideToggle();
                    },3000);
                });
                $('#report_prob_btn').slideToggle();
            });
            
            let registerUI = function() {
                $.post('<?=route('ui-registrations')?>', {
                    _token: $('[name=_token]').val(),
                    ui_url: '{{url()->current()}}'
                }).success(function(data){
                    console.log(data);
                }).error(function(error){
                    if(error.responseJSON.message != 'Unauthenticated.')
                        console.log(error.responseJSON.errors.ui_url[0]);
                });
            }
            registerUI();
        });
    </script>
    @yield('script')
</body>
</html>
