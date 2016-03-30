
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datatables/js/datatables.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
        <script type="text/javascript" src="/assets/backend/xeditable/js/bootstrap-editable.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/chosen/chosen.jquery.js"></script>

    @stop

    @section('content')

        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.news.manageNews') }}">Manage News</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Manage News</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-visible">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs"> <span class="glyphicon glyphicon-tasks"></span> Manage News List</div>
                        </div>
                        <div class="panel-body pbn">
                            <table class="table table-striped table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Slug</th>
                                        <th>Category</th>
                                        <th>Cover</th>
                                        <th>Content</th>
                                        <th>Visible To</th>
                                        <th>Created</th>
                                        <th class="text-center hidden-xs">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $er=1; ?>
                                @foreach ($newsList as $news)
                                <tr id="CMS{{ $news->id }}" class="{{ ($news->status==0)? 'disabletr' : '' }}">
                                    <td>{{ $news->id }}</td>
                                    <td><div style="width: 150px;">{{ $news->title }}</div></td>
                                    <td>{{ substr($news->slug, 0, 20) . '...' }}</td>
                                    <td>{{ $newsCategoryList[$er-1]->name }}</td>
                                    <td>
                                        <div><center>
                                                <?php if($news->image==' ' || $news->image==''){ ?>
                                                No <br> Image
                                                <?php }else{ ?>
                                                <img src="/assets/backend/img/news_covers/{{ $news->image }}" id="hover{{ $er }}" class="catImg" alt="">
                                                <?php } ?>
                                            </center>
                                        </div>
                                    <td><div style="width:150px;">{{ substr(strip_tags($news->content), 0 ,150) }}</div></td>
                                    <td>{{ $memberType[$er-1]->type }}</td>
                                    <td>{{ $news->created_at }}</td>

                                    <td class="hidden-xs text-center">
                                        <div class="btn-group btn-group1">
                                            <button type="button"  id="{{ $news->id }}" class="btn btn-danger btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-ban"></span> </button>
                                            <ul class='dropdown-menu checkbox-persist pull-right text-left' role='menu'>
                                                <li class="cmsStatus" id="status{{ $news->id }}">
                                                    <?php if($news->status==1){ ?>
                                                    <a onclick="return disableF('{{ $news->id }}');" id="{{ $news->id }}">
                                                        <i class='glyphicons glyphicons-ban'></i> Disable
                                                    </a>
                                                    <?php }else{ ?>
                                                    <a onclick="return enableF('{{ $news->id }}');" id="{{ $news->id }}">
                                                        <i class='glyphicons glyphicons-ok'></i> Enable
                                                    </a>
                                                    <?php } ?>
                                                </li>
                                                <li>
                                                    <a onclick="return deleteF('{{ $news->id }}');" id="{{ $news->id }}">
                                                        <i class='glyphicons glyphicons-circle_remove'></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-green2 btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-cogwheel"></span> </button>
                                                <ul class="dropdown-menu checkbox-persist pull-right text-left" role="menu">
                                                    <li>
                                                        <a href="{{ URL::route('admin.news.view', $news->id) }}"><i class="fa fa-eye"></i> View </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ URL::route('admin.news.edit', $news->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php $er++; ?>
                                @endforeach
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
        <script>
            $('.catImg').hover(function() {
                var catId= $(this).attr('id');
                $("#"+catId).addClass('transition');
            }, function() {
                var catId= $(this).attr('id');
                $("#"+catId).removeClass('transition');
            });
        </script>
        <script type="text/javascript">

            jQuery(document).ready(function () {

                "use strict";

                // Init Theme Core
                Core.init();

                // Init Datatables with Tabletools Addon
                $('#datatable').dataTable( {
                    "aoColumnDefs": [{ 'bSortable': false, 'aTargets': [ -1 ] }],
                    "oLanguage": { "oPaginate": {"sPrevious": "", "sNext": ""} },
                    "iDisplayLength": 10,
                    "aLengthMenu": [[5,10, 25, 50, -1], [5, 10, 25, 50, "All"]],
                    "sDom": 'T<"panel-menu dt-panelmenu"lfr><"clearfix">tip'

                });

                // Manually Init Chosen on Datatables Filters
                $("select[name='datatable_length']").chosen();

                // Init Xeditable Plugin
                $.fn.editable.defaults.mode = 'popup';
                $('.xedit').editable();
                $('div#datatable_filter').remove();

            });
            ///////////////Delete row/////////////////////////

            function deleteF(id){
                $.ajax({
                    type: "Get",
                    url: "/admin/news/delete/" + id,
                    success: function(result){
                        $('#CMS'+id).fadeOut("slow");
                        $('.panel-body.pbn').fadeOut(800, function(){
                            $('.panel-body.pbn').fadeIn().delay(200);
//                            location.reload();
                        });
                    },
                });
            }

            function disableF(id){
                $.ajax({
                    type: "Get",
                    url: "/admin/news/disable/" + id,
                    success: function(result){
//                        $('.cmsStatus').html(result);
                        $('.panel-body.pbn').fadeOut(200, function(){
                            $('.panel-body.pbn').fadeIn().delay(2000);
                            $('#CMS'+id).addClass("disabletr");

                            $('#status' + id).empty();
                            var html_content = '<a onclick="return enableF(' + id + ')"><i class="fa fa-check-square-o"></i> Enable</a>';
                            $('#status' + id).append(html_content);
                        });
                    },
                });
            }

            function enableF(id){
                $.ajax({
                    type: "Get",
                    url: "/admin/news/enable/" + id,
                    success: function(result){
//                        $('.cmsStatus').html(result);
                        $('.panel-body.pbn').fadeOut(200, function(){
                            $('.panel-body.pbn').fadeIn().delay(2000);
                            $('#CMS'+id).removeClass("disabletr");

                            $('#status' + id).empty();
                            var html_content = '<a onclick="return disableF(' + id + ')"><i class="fa fa-ban"></i> Disable</a>';
                            $('#status' + id).append(html_content);
                        });
                    },
                });
            }

        </script>

    @stop

@stop
