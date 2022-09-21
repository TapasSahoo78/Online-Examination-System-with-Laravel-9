<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OES Student</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="{{ asset('assets/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- MORRIS CHART STYLES-->
    <link href="{{ asset('assets/js/morris/morris-0.4.3.min.css') }}" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
        input {
            width: 100%;
        }

        select {
            width: 100%;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html" style="background-color: blue !important;">OES STUDENT</a>
            </div>
            <div
                style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;">
                Last access : 30 May
                2014 &nbsp; <a href="/logout" class="btn btn-danger square-btn-adjust"
                    style="background-color: blue !important;">Logout</a> </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="{{ asset('assets/img/find_user.png') }}" class="user-image img-responsive" />
                    </li>


                    <li>
                        <a class="active-menu" href="/dashboard" style="background-color: blue !important;"><i
                                class="fa fa-dashboard fa-3x"></i>Dashboard</a>
                    </li>

                    <li>
                        <a href="/logout"><i class="fa fa-sign-out fa-3x"></i>Logout</a>
                    </li>


                </ul>

            </div>

        </nav>
        <!-- /. NAV SIDE  -->


        @yield('space-work')



    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    {{-- <script src="{{ asset('assets/js/jquery-1.10.2.js') }}"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- BOOTSTRAP SCRIPTS -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="{{ asset('assets/js/jquery.metisMenu.js') }}"></script>
    <!-- MORRIS CHART SCRIPTS -->
    <script src="{{ asset('assets/js/morris/raphael-2.1.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/morris/morris.js') }}"></script>
    <!-- CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/multiselect-dropdown.js') }}"></script> --}}


</body>

</html>
