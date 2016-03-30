<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/assets/metronic/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
    <!-- BEGIN THEME STYLES -->
    <link href="/assets/metronic/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/global/css/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
    <link id="style_color" href="/assets/metronic/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/metronic/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME STYLES -->
    <link rel="shortcut icon" href="/assets/backend/img/favicon.ico"/>
    <!-- Custom CSS -->
    <link href="/assets/frontend/css/custom.css" rel="stylesheet" type="text/css"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="login" style="background: url('/assets/frontend/images/bg-main.jpg') top center no-repeat #000 ;">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="{{ URL::route('user.user.home') }}">
        <img src="/assets/frontend/images/logo-romU.png" style="width: 300px;" alt=""/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content radius-20">
    <form action="{{ URL::route('user.user.doResetPassword') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" novalidate="novalidate">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="email" value="{{ $email }}"/>
        <h3>Reset Password</h3>
        <p>
            Enter your new password below:
        </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix radius-10" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix radius-10" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <a href="/signin"><button id="register-back-btn" type="button" class="btn blue radius-15">
                <i class="m-icon-swapleft"></i> Back </button></a>
            <button type="submit" id="register-submit-btn" class="btn green pull-right radius-15">
                Update <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2016 &copy; ROMUNIVERSE
</div>
<!-- END COPYRIGHT -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="/assets/metronic/global/plugins/respond.min.js"></script>
<script src="/assets/metronic/global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="/assets/metronic/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/assets/metronic/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
<script src="/assets/metronic/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/metronic/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/assets/metronic/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="/assets/metronic/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/metronic/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/metronic/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/metronic/global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="/assets/metronic/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/metronic/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/metronic/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="/assets/metronic/admin/pages/scripts/login-soft.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        Demo.init();
        // init background slide images
/*
        $.backstretch([
                    "/assets/frontend/images/bg-main.jpg"
                ], {
                    fade: 1000,
                    duration: 8000
                }
        );
*/
    });

    function readURL(input) {

        var imageFiles;

        imageFiles = document.getElementById('member_photo_upload').files

        for(i=0; i<=imageFiles.length;i++){
            if (input.files && input.files[i]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    var image = '<div class="slott" id="slot-2" data-slot="2"><img class="thumbnail" width="200" style="margin: 10px auto;" id="imageId" src="' + e.target.result + '"/></div>';
                    jQuery('#images').html(image);              }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }

    jQuery('#member_photo_upload').change(function(){
        readURL(this);
    });

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>