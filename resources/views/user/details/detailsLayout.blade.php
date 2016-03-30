
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
                            <!-- <div class="home-search-container">
                              <input type="text" class="side-search" placeholder="Search">
                              <img src="images/bg-magnify.png" alt="" class="bg-magnify">
                            </div> -->
                        </div>

                        <div class="col-xs-12 col-md-10 main-content-container" id="horizontalTab">
                            <ul>
{{--
                                <li class="side-gray {{ ($tab == 'dashboard')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.profile.dashboard') }}" class="r-tabs-anchor"><i class="fa fa-tachometer"></i> Dashboard</a></li>
--}}

                                <li class="browseroms {{ ($tab == 'details')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.details.details', array($parentItem->slug, $categoryItem->slug, $fileItem->slug, 'details')) }}" class="r-tabs-anchor"><i class="fa fa-eye"></i> File Details</a></li>
{{--
                                <li class="media"><a href="#tab-2"><i class="fa fa-picture-o"></i> Media</a></li>
                                <li class="gamedetails"><a href="#tab-3"><i class="fa fa-tasks"></i> Game Details</a></li>
--}}
{{--
                                <li class="comments {{ ($tab == 'comments')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.details.comments', array($parentItem->slug, $categoryItem->slug, $fileItem->slug)) }}" class="r-tabs-anchor"><i class="fa fa-comments"></i> Comments <span>({{ count($commentList) }})</span></a></li>
--}}
                                <li class="comments {{ ($tab == 'comments')? 'r-tabs-tab r-tabs-state-active' : 'r-tabs-tab r-tabs-state-default' }}"><a href="{{ URL::route('user.details.details', array($parentItem->slug, $categoryItem->slug, $fileItem->slug, 'comments')) }}" class="r-tabs-anchor"><i class="fa fa-comments"></i> Comments <span>({{ count($commentList) }})</span></a></li>
                            </ul>

                            <div class="btn-group btn-breadcrumb">
                                <a href="javascript:;" class="btn btn-default"><i class="glyphicon glyphicon-home"></i></a>
                                <a href="javascript:;" class="btn btn-default">{{ $parentItem->name }}</a>
                                <a href="/files/{{ $parentItem->slug }}/{{ $categoryItem->slug }}" class="btn btn-default">{{ $categoryItem->name }}</a>
                            </div>

                            @yield('tab-content')

                            @yield('tab-footer')

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

            function addLikeDislike(mid, type){
                $.ajax({
                    type: "Get",
                    url: "/ajax/addLikeDislike/" + type + "/" + mid,
                    success: function(result){
                        if(result.refresh_flag == 1){
                            var url = '/files/' + '<?php echo $parentItem->slug; ?>' + '/' + '<?php echo $categoryItem->slug; ?>' + '/' + '<?php echo $fileItem->slug; ?>' + '/comments'
                            location.href = url;
//                            location.reload();
                        }
                    },
                });
            }

            function addComment(fid){
                var comment_content = $('#add_comment').val();
                if(comment_content != '') {
                    $.ajax({
                        type: "Get",
                        url: "/ajax/addComment/" + fid,
                        data: {comment_content: comment_content},
                        success: function (result) {
                            var url = '/files/' + '<?php echo $parentItem->slug; ?>' + '/' + '<?php echo $categoryItem->slug; ?>' + '/' + '<?php echo $fileItem->slug; ?>' + '/comments'
                            location.href = url;
//                        location.reload();
                        },
                    });
                }else{
                    alert('Please type the comment.');
                    return false;
                }
            }

            function fileDownload(){
                var user_id = '{{ Session::get('user_id') }}';
                if(user_id){
                    var url = '/files/' + '<?php echo $parentItem->slug; ?>' + '/' + '<?php echo $categoryItem->slug; ?>' + '/' + '<?php echo $fileItem->slug; ?>' + '/download';
                    location.href = url;
                }else{
                    bootbox.alert("You need to login for downloading files.", function() {
                    });
                }
            }

            function addDownloadList(fid){
                var user_id = '{{ Session::get('user_id') }}';
                if(user_id){
                    $.ajax({
                        type: "Get",
                        url: "/ajax/addDownloadList/" + fid,
                        data: {},
                        success: function (result) {
                            bootbox.alert("Success!", function() {
                            });
                        },
                    });
                }else{
                    bootbox.alert("You need to login for adding download-list.", function() {
                    });
                }
            }

        </script>
    @stop

    @stop
