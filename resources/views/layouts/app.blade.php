<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <!--<script src="{{ asset('js/app.js') }}"></script>-->

    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap-theme.min.css') }}"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
    <script src="{{ asset('lib/moment/js/moment.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('lib/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" />
    <script src="{{ asset('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('lib/select2/js/select2.min.js') }}"></script>

    <script src="{{ asset('lib/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    <!-- BootstrapValidator v0.4.5 bootstrap-validator.min.js -->
    <script src="{{ asset('lib/bootstrap-validator/bootstrap-validator.min.js') }}"></script>

    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        $(function () {
            $('#startdate,#enddate').datetimepicker({
                format: "MM dd, yyyy, HH:ii p",
                showMeridian: true,
                autoclose: true,
                todayBtn: true
            });

            $('#js-search-multi').select2();

            $('#js-search-multi').on('select2:opening select2:closing', function( event ) {
                var $searchfield = $(this).parent().find('.select2-search__field');
                $searchfield.prop('disabled', true);
            });
            $('#event-form')
                .bootstrapValidator({
                    // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
                    /*feedbackIcons: {
                        valid: 'glyphicon glyphicon-ok',
                        invalid: 'glyphicon glyphicon-remove',
                        validating: 'glyphicon glyphicon-refresh'
                    },*/
                    fields: {
                        'userslist[]': {
                            validators: {
                                notEmpty: {
                                    message: 'Invitee field is required. Please Select at least one user from the list'
                                }
                            },
                        },
                        type: {
                            validators: {
                                notEmpty: {
                                    message: 'Event type is required'
                                }
                            }
                        },
                        subject: {
                            validators: {
                                stringLength: {
                                    min: 10,
                                    message:'Minimum length 5 characters',
                                },
                                notEmpty: {
                                    message: 'Event Subject is required and cannot be empty'
                                }
                            }
                        },
                        start_date: {
                            validators: {
                                notEmpty: {
                                    message: 'Event Start Date is required and cannot be empty'
                                }
                            }
                        },
                        end_date: {
                            validators: {
                                notEmpty: {
                                    message: 'Event End Date is required and cannot be empty'
                                }
                            }
                        },
                        description: {
                            validators: {
                                stringLength: {
                                    min: 8,
                                    message:'Minimum length 8 characters.'
                                },
                                notEmpty: {
                                    message: 'Event Description is required and cannot be empty',
                                }
                            }
                        },
                        location: {
                            validators: {
                                stringLength: {
                                    min: 8,
                                    message:'Minimum length 8 characters.'
                                }
                            }
                        },
                    }
                }).on('success.form.bv', function(e) {
                $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#event-form').data('bootstrapValidator').resetForm();

                // Prevent form submission
                e.preventDefault();

                // Get the form instance
                var $form = $(e.target);

                // Get the BootstrapValidator instance
                var bv = $form.data('bootstrapValidator');

                // Use Ajax to submit form data
                $.post($form.attr('action'), $form.serialize(), function(result) {
                    console.log(result);
                }, 'json');
            });

        });

    </script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li><a href="{{ url('/') }}">Home</a></li>
                        @if (!Auth::guest())
                            <li><a href="{{ route('posts.create') }}">New Article</a></li>
                            <li class="dropdown">
                                <a href="#"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    Calender  <span class="caret"></span>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{ url('/calendar/events') }}">Events</a></li>
                                        </ul>
                                </a>
                            </li>
                        @endif
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        @role('Admin') {{-- Laravel-permission blade helper --}}
                                            <a href="{{ route('users.index') }}"><i class="fa fa-btn fa-unlock"></i>Admin</a>
                                        @endrole
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>


        @if(Session::has('flash_message'))
            <div class="container">      
                <div class="alert alert-success"><em> {!! session('flash_message') !!}</em>
                </div>
            </div>
        @endif 
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                {{--  @include ('errors.list') Including error file --}}
            </div>
        </div>
        @if (!Auth::guest())
        <script type="text/javascript">
            setInterval(function(){
                notifyMessage();
            }, 36000);
            function notifyMessage(){
                $.ajax({
                 url: 'calendar/events/notify',
                token:window.Laravel,
                type: 'get',
                dataType:'json',
                success: function(response){
                $.each(response, function( index, value ) {
                   $.notify({
                       message: 'test' //value.subject
                   }, {
                       type: 'info',
                       timer: 1000,
                   });
   	            });
              }
                });
        }
        </script>
        @endif
        @yield('content')

    </div>

    <!-- Scripts -->

</body>
</html>
