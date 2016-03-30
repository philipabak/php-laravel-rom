
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/plugins/ladda/ladda.min.js"></script>

    @stop

    @section('content')

        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.users.view', $userItem->id) }}">View Profile</a>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">View Profile</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading"> <span class="panel-title"> <i class="fa fa-sitemap"></i> User Profile</span>
                            <div class="panel-header-menu pull-right mr10">
                                <label class="checkbox-inline mr10">
                                    <a href="{{ URL::route('admin.users.edit', $userItem->id) }}" data-style="expand-left" class="btn btn-info btn-gradient btn-sm ladda-button">
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
                                    <td style="width: 30%;">First Name</td>
                                    <td style="width: 70%;">{{ $userItem->first_name }}</td>
                                </tr>
                                <tr>
                                    <td>Last Name</td>
                                    <td>{{ $userItem->last_name }}</td>
                                </tr>
                                <tr>
                                    <td>User Name</td>
                                    <td>{{ $userItem->username }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $userItem->email }}</td>
                                </tr>

                                <tr>
                                    <td>Mobile</td>
                                    <td>{{ $userItem->mobile }}</td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td>{{ $userItem->gender }}</td>
                                </tr>
                                <tr>
                                    <td>Birthday</td>
                                    <td>{{ $userItem->DOB }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $userItem->addres }}</td>
                                </tr>
                                <tr>
                                    <td>Nationality</td>
                                    <td>{{ $userItem->nationality }}</td>
                                </tr>
                                <tr>
                                    <td>Country</td>
                                    <td>{{ $countryName->country }}</td>
                                </tr>
                                <tr>
                                    <td>Zip</td>
                                    <td>{{ $userItem->zip }}</td>
                                </tr>
                                <tr>
                                    <td>Ip</td>
                                    <td>{{ $userItem->ip }}</td>
                                </tr>
                                <tr>
                                    <td>Photo</td>
                                    <td>
                                        <?php if($userItem->photo){ ?>
                                        <img src="/assets/backend/img/avatars/{{ $userItem->photo }}" class="cat_icon" alt="">
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Created</td>
                                    <td>{{ $userItem->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Modified</td>
                                    <td>{{ $userItem->updated_at }}</td>
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
