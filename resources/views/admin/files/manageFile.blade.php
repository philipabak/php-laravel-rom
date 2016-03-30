
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
                        <a href="{{ URL::route('admin.files.manageFile') }}">Manage Files</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Manage Files</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-visible">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs"> <span class="glyphicon glyphicon-tasks"></span> Manage Files List</div>
                        </div>
                        <div class="panel-body pbn">
                            <table class="table table-striped table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Author</th>
                                    <th>Cover</th>
                                    <th>Down. Visible To</th>
                                    <th>Down. By</th>
                                    <th>Created</th>
                                    <th class="text-center hidden-xs">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $er=1; ?>
                                @foreach ($romList as $rom)
                                <tr id="romR{{ $rom->id }}" class="{{ ($rom->status==1)? 'disabletr' : '' }}">
                                    <td>{{ $rom->id }}</td>
                                    <td>{{ $rom->title }}</td>
                                    <td>{{ $rom->slug }}</td>

                                    <td>{{ $categoryList[$er-1]->name }}</td>
                                    <td>{{ $rom->author }}</td>
                                    <td>
                                        <div><center>
                                                <?php if($rom->image == ''){ ?>
                                                <img src="/assets/backend/img/rom_images/thumb/empty.jpg" id="hover{{ $er }}" class="catImg" alt="">
                                                <?php }else{ ?>
                                                    <img src="/assets/backend/img/rom_images/thumb/{{ $rom->image }}" id="hover{{ $er }}" class="catImg" alt="">
                                                <?php } ?>
                                            </center>
                                        </div>
                                    </td>
                                    <td>{{ $memberType_to[$er-1]->type }}</td>
                                    <td>{{ $memberType_by[$er-1]->type }}</td>
                                    <td>{{ $rom->created_at }}</td>
                                    <td class="hidden-xs text-center">
                                        <div class="btn-group btn-group1">
                                            <button type="button"  id="{{ $rom->id }}" class="btn btn-danger btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-ban"></span> </button>
                                            <ul class='dropdown-menu checkbox-persist pull-right text-left' role='menu'>
                                                <li>
                                                    <a onclick="return deleteF('{{ $rom->id }}')">
                                                        <i class='glyphicons glyphicons-circle_remove'></i> Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <ul style="list-style:none;"><li> </li><li><b>Current</b>: <span class="text-primary">{{ $romStatus[$er-1]->type }}</span></li></ul>
                                                </li>
                                            </ul>
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-green2 btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-cogwheel"></span> </button>
                                                <ul class="dropdown-menu checkbox-persist pull-right text-left" role="menu">
                                                    <li>
                                                        <a href="{{ URL::route('admin.files.view', $rom->id) }}"><i class="fa fa-eye"></i> View </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ URL::route('admin.files.edit', $rom->id) }}"><i class="fa fa-pencil"></i> Edit</a>
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

            function deleteF(id){
                $.ajax({
                    type: "Get",
                    url: "/admin/files/delete/" + id,
                    success: function(result){
                        $('#romR'+id).fadeOut("slow");
                        $('.panel-body.pbn').fadeOut(800, function(){
                            $('.panel-body.pbn').fadeIn().delay(200);
//                            location.reload();
                        });
                    },
                });
            }
        </script>

    @stop

@stop
