
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/plugins/ladda/ladda.min.js"></script>

    @stop

    @section('content')

        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.files.addFile') }}">View File</a>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    <li class="crumb-trail">View File</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading"> <span class="panel-title"> <i class="fa fa-sitemap"></i> File Detail</span>
                            <div class="panel-header-menu pull-right mr10">
                                <label class="checkbox-inline mr10">
                                    <a href="{{ URL::route('admin.files.edit', $romview->id) }}" data-style="expand-left" class="btn btn-info btn-gradient btn-sm ladda-button">
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
                                <fieldset class="fieldset">
                                    <legend class="legend">Media Information</legend>
                                    <tr>
                                        <td style="width: 30%;">Title</td>
                                        <td style="width: 70%;">{{ $romview->title }}</td>
                                    </tr>
                                    <tr>
                                        <td>Slug</td>
                                        <td>{{ $romview->slug }}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>{{ $categoryName->name }}</td>
                                    </tr>
                                    <?php if($romview->file != ''){ ?>
                                    <tr>
                                        <td>File Path</td>
                                        <td>{{ $romview->file_path }}</td>
                                    </tr>
                                    <tr>
                                        <td>File Name</td>
                                        <td>{{ $romview->file }}</td>
                                    </tr>
                                    <tr>
                                        <td>File Size</td>
                                        <td>{{ number_format($romview->file_size/1024/1024, 2) }} MB</td>
                                    </tr>
                                    <?php }else{?>
                                    <tr>
                                        <td>External Url</td>
                                        <td>{{ $romview->url }}</td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <td>Search Terms</td>
                                        <td>{{ $romview->search_terms }}</td>
                                    </tr>
                                    <tr>
                                        <td>Author</td>
                                        <td>{{ $romview->author }}</td>
                                    </tr>
                                    <tr>
                                        <td>Author Email</td>
                                        <td>{{ $romview->author_email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Author Website</td>
                                        <td>{{ $romview->author_website }}</td>
                                    </tr>
                                    <tr>
                                        <td>Download By</td>
                                        <td>{{ $downloadBy->type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Download Visible To</td>
                                        <td>{{ $downloadVisible->type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Region</td>
                                        <td>{{ $region->country }}</td>
                                    </tr>
                                    <tr>
                                        <td>Language</td>
                                        <td>{{ $romview->language }}</td>
                                    </tr>
                                    <tr>
                                        <td>Release Group</td>
                                        <td>{{ $romview->release }}</td>
                                    </tr>
                                    <tr>
                                        <td>Previous version</td>
                                        <td>{{ $romview->version }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>{{ $status->type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Cover Image</td>
                                        <td><img src="/assets/backend/img/rom_images/thumb/{{ $romview->image }}" class="cat_icon" alt=""></td>
                                    </tr>
                                    <tr>
                                        <td>Created</td>
                                        <td>{{ $romview->created_at }}</td>
                                    </tr>
                                </fieldset>
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
