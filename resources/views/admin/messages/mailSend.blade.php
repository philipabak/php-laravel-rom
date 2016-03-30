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
    <title>{{ $title }}</title>

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' type='text/css' href='/assets/backend/bootstrap/css/bootstrap.min.css'>

    <!-- Theme CSS -->
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/vendor.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/theme.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/utility.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/custom.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/fonts/icomoon/icomoon.min.css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/backend/img/favicon.ico">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Google Map API -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
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

</head>

<body>

<div id="main">

    <!-- Start: Content -->
    <section id="content_wrapper">

        <div id="content">
            <div class="tab-content bg-light pn mt20">
                <div class="tab-pane fade p20 pt15" id="email-view">
                    <!-- EMAIL VIEW -->
                    <div class="email-view">
                        <span class="pull-right text-muted m5">{{ date('Y-m-d H:i') }}</span>
                        <h3><span class="text-orange2">Subject - </span>{{ $subject }}</h3>
                        <hr class="mt10 mb10"/>
                        <img src="{{ $photo_url }}" class="img-responsive mw50 pull-left mr20">
                        <div class="pull-right mt5">
<!--                            <span class="label bg-blue2 mr10">New</span> <span class="label bg-green2">Co-Worker</span>
-->                     </div>
                        <h4 class="mt15 mb5">From: {{ $from_name }}</h4>
                        <small class="text-muted">From: {{ $from_usr }}</small>
                        <div class="clearfix"></div>
                        <hr class="mb15 mt10">
                        <p>{{ $body }}</p>
                        <hr class="mb15 mt15"/>
<!--                        <h4 class="mb25"> <span class="glyphicons glyphicons-paperclip mr10"></span> 3 Attachments - <small> View Images | Download All</small> </h4>
                        <div class="attachments mb30">
                            <img src="/assets/backend/img/stock/12.jpg" class="mw140 mr15"> <img src="/assets/backend/img/stock/7.jpg" class="responsive mw140 mr15"> <img src="/assets/backend/img/stock/4.jpg" class="responsive mw140">
                        </div>
-->

                        <div class="row mb5 mt10"></div>

                        <script type="text/javascript">
                            jQuery(document).ready(function () {
                                "use strict";

                                $("#reply").on("click", function() {
                                    var message1 = $("#reply").html();
                                    alert(message1);
                                });

                                $(".summernote").summernote({
                                    height: 315,
                                    focus: false  //set focus editable area after Initialize summernote
                                });

                                $( ".note-editable" ).addClass( "reply" );
                                $( ".note-editable" ).attr( "id","reply" );

                            });
                        </script>
                    </div>
                </div>
                <!-- End tab -->
            </div>
            <!-- End tab-content -->
        </div>

    </section>

    <script>
        $(document).ready(function(){
            $(".alert-success").delay(10000)
                .fadeOut("slow", function () {
                    $(".alert-success").remove();
                });
        });
    </script>

</body>
</html>
