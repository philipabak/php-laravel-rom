
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/plugins/ladda/ladda.min.js"></script>

    @stop

    @section('content')

        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.categories.view', $viewCategory->id) }}">View Category</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">View Category</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"> <i class="fa fa-sitemap"></i> View Category</span>
                            <div class="panel-header-menu pull-right mr10">
                                <label class="checkbox-inline mr10">
                                    <a href="{{ URL::route('admin.categories.edit', $viewCategory->id) }}" data-style="expand-left" class="btn btn-info btn-gradient btn-sm ladda-button">
                                        <i class="fa fa-pencil"></i> <span class="ladda-label">Edit</span><span class="ladda-spinner"></span>
                                        <div class="ladda-progress" style="width: 0px;"></div>
                                        <span class="ladda-spinner"></span>
                                    </a>
                                </label>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table id="user" class="table table-bordered table-striped" style="clear: both">
                                <tbody>
                                <tr>
                                    <td style="width: 30%;">ID:</td>
                                    <td style="width: 70%;">{{ $viewCategory->id }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 30%;">Parent Category:</td>
                                    <td style="width: 70%;">{{ ($parentCategory)? $parentCategory->name : 'Main Category' }}</td>
                                </tr>
                                <tr>
                                    <td>Name:</td>
                                    <td>{{ $viewCategory->name }}</td>
                                </tr>
                                <tr>
                                    <td>Slug:</td>
                                    <td>{{ $viewCategory->slug }}</td>
                                </tr>
                                <tr>
                                    <td>Icon</td>
                                    <td>
                                        <?php if($viewCategory->icon){ ?>
                                        <img width="200" src="/assets/backend/img/icon/thumb_icon/{{ $viewCategory->icon }}" class="cat_icon" alt="">
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created</td>
                                    <td>{{ $viewCategory->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Modified</td>
                                    <td>{{ $viewCategory->updated_at }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @stop

    @section('custom-script')

        <!-- Page Plugins -->
        <script type="text/javascript">
            jQuery(document).ready(function () {
                // Init Theme Core
                Core.init();
                "use strict";

                // Init Ladda Plugin on buttons
                Ladda.bind( '.ladda-button', { timeout: 2000 } );

                // Bind progress buttons and simulate loading progress. Note: Button still requires ".ladda-button" class.
                Ladda.bind( '.progress-button', {
                    callback: function( instance ) {
                        var progress = 0;
                        var interval = setInterval( function() {
                            progress = Math.min( progress + Math.random() * 0.1, 1 );
                            instance.setProgress( progress );

                            if( progress === 1 ) {
                                instance.stop();
                                clearInterval( interval );
                            }
                        }, 200 );
                    }
                });

            });
        </script>

    @stop

@stop
