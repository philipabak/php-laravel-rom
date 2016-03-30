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
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="{{ URL::route('user.user.userLogin') }}" method="post">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide radius-10">
            <button class="close" data-close="alert"></button>
			<span>
			Enter any username and password. </span>
        </div>
        <?php if(isset($message)){ ?>
        <div class="alert alert-danger radius-10">
            <button class="close" data-close="alert"></button>
			<span>{{ $message }}</span>
        </div>
        <?php } ?>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix radius-10" type="text" autocomplete="off" placeholder="Username" name="username"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix radius-10" type="password" autocomplete="off" placeholder="Password" name="password"/>
            </div>
        </div>
        <div class="form-actions">
<!--
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"/> Remember me </label>
-->
            <button type="submit" class="btn green pull-right radius-15">
                Login <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
<!--
        <div class="login-options">
            <h4>Or login with</h4>
            <ul class="social-icons">
                <li>
                    <a class="facebook" data-original-title="facebook" href="javascript:;">
                    </a>
                </li>
                <li>
                    <a class="twitter" data-original-title="Twitter" href="javascript:;">
                    </a>
                </li>
                <li>
                    <a class="googleplus" data-original-title="Goole Plus" href="javascript:;">
                    </a>
                </li>
                <li>
                    <a class="linkedin" data-original-title="Linkedin" href="javascript:;">
                    </a>
                </li>
            </ul>
        </div>
-->
        <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p>
                no worries, click <a href="javascript:;" id="forget-password">
                    here </a>
                to reset your password.
            </p>
        </div>
        <div class="create-account">
            <p>
                Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">
                    Create an account </a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="{{ URL::route('user.user.userForgetpassword') }}" method="post">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <h3>Forget Password ?</h3>
        <p>
            Enter your e-mail address below to reset your password.
        </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix radius-10" type="text" autocomplete="off" placeholder="Email" name="email"/>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn blue radius-15">
                <i class="m-icon-swapleft"></i> Back </button>
            <button type="submit" class="btn green pull-right radius-15">
                Submit <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="{{ URL::route('user.user.createAccount') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" novalidate="novalidate">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
        <h3>Sign Up</h3>
        <p>
            Enter your account details below:
        </p>
<!--
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Address</label>
            <div class="input-icon">
                <i class="fa fa-check"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Address" name="address"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">City/Town</label>
            <div class="input-icon">
                <i class="fa fa-location-arrow"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="City/Town" name="city"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Country</label>
            <select name="country" id="select2_sample4" class="select2 form-control">
                <option value=""></option>
            </select>
        </div>
-->
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix radius-10" type="text" autocomplete="off" placeholder="Username" name="username"/>
            </div>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix radius-10" type="text" placeholder="Email" name="email"/>
            </div>
        </div>
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
<!--
        <div class="form-group">
            <label>
                <input type="checkbox" name="tnc"/> I agree to the <a href="javascript:;">
                    Terms of Service </a>
                and <a href="javascript:;">
                    Privacy Policy </a>
            </label>
            <div id="register_tnc_error">
            </div>
        </div>
-->
        <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn blue radius-15">
                <i class="m-icon-swapleft"></i> Back </button>
            <button type="submit" id="register-submit-btn" class="btn green pull-right radius-15">
                Sign Up <i class="m-icon-swapright m-icon-white"></i>
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