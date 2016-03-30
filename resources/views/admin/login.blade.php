<!DOCTYPE html>
<html>
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="AdminDesigns">
    <title>
            {{ $title }}
    </title>

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>


    <!-- Theme CSS -->
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/vendor.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/theme.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/utility.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/custom.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/fonts/icomoon/icomoon.min.css'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' type='text/css' href='/assets/backend/bootstrap/css/bootstrap.min.css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/backend/img/favicon.ico">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- jQuery -->
    <script type="text/javascript" src="/assets/backend/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/assets/backend/jquery/jquery_ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/backend/bootstrap/js/bootstrap.min.js"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="/assets/backend/utility/spin.min.js"></script>
    <script type="text/javascript" src="/assets/backend/utility/underscore-min.js"></script>
    <script type="text/javascript" src="/assets/backend/js/ajax.js"></script>
    <script type="text/javascript" src="/assets/backend/js/main.js"></script>
    <script type="text/javascript" src="/assets/backend/js/custom.js"></script>
    <script type="text/javascript" src="/assets/backend/backstretch/jquery.backstretch.min.js"></script>

    <!-- Google Map API -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>


</head>

<body class="minimal login-page">

    <a href="{{ URL::route('user.user.home') }}" class="returnToHome">
        <i class="fa fa-arrow-circle-left fa-3x text-light"></i>
        <span class="text-light"> Return <br> to Home</span>
    </a>

    <!-- Start: Main -->
    <div id="main">
        <div id="content">
            <div class="row">
                <div id="page-logo">
                    <img src="/assets/backend/img/logos/logo-white.png" class="img-responsive" alt="" data-pin-nopin="true">
                </div>
            </div>
            <div class="row">
                <div class="panel-bg">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"> <span class="glyphicon glyphicon-lock text-blue2"></span> Admin Login </span>
                            <span class="panel-header-menu pull-right mr15 text-muted fs12"></span>
                        </div>
                        <form action="{{ URL::route('user.user.login') }}" id="UserLoginForm" method="post" accept-charset="utf-8">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="panel-body">
                                <div class="login-avatar"><img src="/assets/backend/img/avatars/login.png" alt=""></div>
                                <div class="form-group">
                                    @if(isset($message) && $message != '')
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ $message }}
                                    </div>
                                    @endif
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                        <div class="input text required">
                                            <input name="username" placeholder="User Name" class="form-control" autofocus="autofocus" maxlength="255" type="text" id="UserUsername" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-link"></span></span>
                                        <div class="input password required">
                                            <input name="password" class="form-control" placeholder="Password" type="password" id="UserPassword" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                  <span class="text-muted fs12 lh30">
                                      <a href="{{ URL::route('user.user.forgetpassword') }}">Forgotten Password ?</a>
                                  </span>
                                  <button class="btn bg-blue-alt bg-gradient pull-right" type="submit"><i class="fa fa-home"></i> Login</button>
                                  <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Main -->

    <div class="overlay-black"></div>

    <script type="application/javascript">
        jQuery(document).ready(function () {

            "use strict";

            // Init Theme Core
            Core.init();

            // Enable Ajax Loading
            Ajax.init();

            // Init Full Page BG(Backstretch) plugin
            $.backstretch("/assets/backend/img/stock/splash/2.jpg");

        });
    </script>

