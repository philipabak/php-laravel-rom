
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
                            <div class="row">
                                <div class="col-sm-10">

                                    <div class="btn-group btn-breadcrumb">
                                        <a href="javascript:;" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                                        <a href="javascript:;" class="btn btn-default">{{ $parentItem->name }}</a>
                                        <a href="javascript:;" class="btn btn-default">{{ $categoryItem->name }}</a>
                                    </div>

                                </div>
                                <div class="text-right col-sm-2 ">
                                    <div class="small-search">
                                        <a href="#" class="search-toggle"><img src="/assets/frontend/images/bg-magnify.png" alt="" ></a>
                                        <input type="search" class="small-search-input">
                                    </div>
                                </div>
                            </div>
                            <ul>
                                <li class="browseroms r-tabs-tab r-tabs-state-active"><a href="javascript:;" class="r-tabs-anchor"><i class="fa fa-eye"></i> File List </a></li>
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

            $( ".options-toggle" ).click(function() {
                $( ".view-options" ).fadeToggle( "fast", function() {
                    // Animation complete.
                });
            });

        </script>
    @stop

    @stop
