
@extends('userLayout')

    @section('custom-css')
        <link rel="stylesheet" href="/assets/frontend/css/breadcrumb-style.css">
    @stop

    @section('custom-js')
        <!-- Responsive Tabs JS -->
        <script src="/assets/frontend/js/jquery.responsiveTabs.js" type="text/javascript"></script>
    @stop

    @section('content')
        <div class="container">
            <div class="inside">
                <div class="row">
                    <div class="col-xs-12 inside">
                        <div class="col-xs-12 col-md-2 side-content-container">
                        </div>

                        <div class="col-xs-12 col-md-10 main-content-container" id="horizontalTab">
                            <ul>
                                <li class="side-gray {{ ($tab == 'dashboard')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.profile.dashboard') }}" class="r-tabs-anchor"><i class="fa fa-tachometer"></i> Dashboard</a></li>
                                <li class="side-gray {{ ($tab == 'messages')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.profile.messages') }}" class="r-tabs-anchor"><i class="fa fa-inbox"></i> Messages</a></li>
<!--                                <li class="side-gray {{ ($tab == 'community')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.profile.community') }}" class="r-tabs-anchor"><i class="fa fa-picture-o"></i> Community <span>2</span></a></li>-->
                                <li class="side-gray {{ ($tab == 'downloadList')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.profile.downloadList') }}" class="r-tabs-anchor"><i class="fa fa-download"></i> Download List</a></li>
                                <li class="side-gray {{ ($tab == 'downloadHistory')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.profile.downloadHistory') }}" class="r-tabs-anchor"><i class="fa fa-history"></i> Download History</a></li>
                                <li class="side-gray {{ ($tab == 'purchaseHistory')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.profile.purchaseHistory') }}" class="r-tabs-anchor"><i class="fa fa-money"></i> Purchase History</a></li>
                            </ul>

                            @yield('tab-content')

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @stop

    @section('custom-script')
        <script type="text/javascript">
            $(document).ready(function () {
                var $tabs = $('#horizontalTab');
                $tabs.responsiveTabs({
                    rotate: false,
                    startCollapsed: 'accordion',
                    collapsible: 'accordion',
                    setHash: true,
                    activate: function(e, tab) {
                        $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                    },
                    activateState: function(e, state) {
                        //console.log(state);
                        $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
                    }
                });

            });

            $( ".search-toggle" ).click(function() {
                $( ".small-search-input" ).fadeToggle( "slow", function() {
                    // Animation complete.
                });
            });

            jQuery('#update1').click(function(e){
                var email = jQuery('.email').val();
                var pass1 = jQuery('.pas1').val();
                var pass2 = jQuery('.pas2').val();
                jQuery('#yError').hide();
                if (email == '') {
                    jQuery(".email").css({"animation":"0.7s linear 0s normal none 1 shake", "border":"1px solid #CE5454","box-shadow":"0 0 4px -2px #CE5454"});
                    jQuery('#yError').html('Email field must be filled out.');
                    jQuery('#yError').show();
                    e.preventDefault();
                }else if (pass1 == '') {
                    jQuery(".pas1").css({"animation":"0.7s linear 0s normal none 1 shake", "border":"1px solid #CE5454","box-shadow":"0 0 4px -2px #CE5454"});
                    jQuery('#yError').html('Password fields must be filled out.');
                    jQuery('#yError').show();
                    e.preventDefault();
                }else if (pass1 != pass2) {
                    jQuery(".pas2").css({"animation":"0.7s linear 0s normal none 1 shake", "border":"1px solid #CE5454","box-shadow":"0 0 4px -2px #CE5454"});
                    jQuery('#yError').html('Both password fields must be filled out and they would be same.');
                    jQuery('#yError').show();
                    e.preventDefault();
                }else { return true; }
            });

        </script>
        <script>
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

    @stop

    @stop
