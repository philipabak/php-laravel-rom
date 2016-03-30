<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    <link rel="stylesheet" href="/assets/frontend/css/font-awesome.min.css">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/frontend/images/favicon.ico">
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="/assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/frontend/css/responsive-tabs.css" />
    <link rel="stylesheet" href="/assets/frontend/css/style.css">
    <link href="/assets/frontend/css/custom.css" rel="stylesheet" type="text/css"/>

    @yield('custom-css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/assets/frontend/js/jquery.js"></script>
    <script src="/assets/frontend/js/bootstrap.min.js"></script>
    <script src="/assets/frontend/js/bootbox.min.js"></script>

    @yield('custom-js')

</head>

<body>
    <!-- Header -->
    <div class="header">
        <div class="container">
            <div class="row text-center">
                <div class="col-xs-8 col-sm-6 col-sm-offset-3 col-lg-3 col-lg-offset-0 logo-container">
                    <a href="{{ URL::route('user.user.home') }}"><img src="/assets/frontend/images/logo-romU.png" alt="" class="img-responsive"></a>
                </div>
                <a href="#" class="col-xs-3 visible-xs collapse-button navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="col-xs-12 col-lg-8 col-lg-offset-1" style="margin-top: 10px;">
                    <div class="navbar-collapse collapse">
                        <!-- <a href="#" class="top-search visible-lg"><i class="fa fa-search"></i></a> -->
                        <div class="small-search visible-md visible-lg">
                            <a href="{{ URL::route('user.user.search') }}" class="search-toggle"><i class="fa fa-search"></i></a>
<!--
                            <input type="search" class="small-search-input">
-->
                        </div>
                        <ul class="nav text-center top-nav" style="background: url();">
                            <?php if(Session::has('user_id')){?>
                            <li><a href="{{ URL::route('user.user.userLogout') }}">Log Out <i class="fa fa-user"></i></a></li>
                            <?php }else{ ?>
                            <li><a href="{{ URL::route('user.user.signin') }}">Sign In <i class="fa fa-user"></i></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row text-center">

                <div class="col-xs-12 col-lg-12 col-lg-offset-1" style="margin-left: 0px;">
                    <div class="navbar-collapse collapse" style="margin-top: 10px;">
                        <ul class="nav text-center top-nav" id="nav_wrap">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- // end -->
    @yield('left-side')

    @yield('content')

    <!-- footer -->
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-10 col-xs-offset-1">
                <div class="footer">
                    <a href="#">Advertise with Us</a>  |  <a href="#">Privacy Policy</a>  |  <a href="#">Disclaimer</a>
                </div>
            </div>
        </div>
    </div>
    <!-- // end -->

    <script>
        jQuery(document).ready(function () {
            $.ajax({
                type: "Get",
                url: "/getCategory",
                success: function(result){
                    var categoryList_html = '';
                    var parentCatetorySlug = '';
                    var count_category = 0;
                    result['data'].forEach(function(categoryItem) {
                        if (categoryItem['parent_id'] == '' || categoryItem['parent_id'] == null) {
                            if (count_category != 0) categoryList_html += '</li><li></ul></li>';
                            parentCatetorySlug = categoryItem['slug'];
                            categoryList_html += '  <li class="dropdown">' +
                                                 '    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' + categoryItem['name'] + ' <span class="caret"></span></a>' +
                                                 '    <ul class="dropdown-menu">';
                        }else{
//                            categoryList_html += '      <li><a href="/category/' + categoryItem['slug'] + '">' + categoryItem['name'] + '</a></li>';
                            categoryList_html += '      <li><a href="/files/' + parentCatetorySlug + '/' + categoryItem['slug'] + '">' + categoryItem['name'] + '</a></li>';
                        }
                        count_category++;
                    });
                    categoryList_html += '<li></li></ul></li>';
                    categoryList_html += '<li><a href="/dashboard">PROFILE</a></li>';
                    categoryList_html += '<li></li>';
                    $('#nav_wrap').empty();
                    $('#nav_wrap').append(categoryList_html);
                },
            });

        });
    </script>
    @yield('custom-script')

</body>
</html>


