<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OES Admin</title>
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
                <a class="navbar-brand" href="index.html">OES ADMIN</a>
            </div>
            <div
                style="color: white;
            padding: 15px 50px 5px 50px;
            float: right;
            font-size: 16px;">
                Last access : 30 May
                2014 &nbsp; <a href="/logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li class="text-center">
                        <img src="{{ asset('assets/img/find_user.png') }}" class="user-image img-responsive" />
                    </li>


                    <li>
                        <a class="active-menu" href="/admin/dashboard"><i
                                class="fa fa-dashboard fa-3x"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="/admin/dashboard"><i class="fa fa-book fa-3x"></i>Subjects</a>
                    </li>
                    <li>
                        <a href="/admin/exam"><i class="fa fa-tasks fa-3x"></i>Exams</a>
                    </li>
                    <li>
                        <a href="/admin/qna-ans"><i class="fa fa-question-circle fa-3x"></i>Q&A</a>
                    </li>
                    <li>
                        <a href="/admin/students"><i class="fa fa-tasks fa-3x"></i>Students</a>
                    </li>
                    <li>
                        <a href="/logout"><i class="fa fa-sign-out fa-3x"></i>Logout</a>
                    </li>

                    {{-- <li>
                        <a href="#"><i class="fa fa-sitemap fa-3x"></i> Multi-Level Dropdown<span
                                class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="blank.html"><i class="fa fa-square-o fa-3x"></i> Blank Page</a>
                    </li> --}}


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
