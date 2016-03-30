
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
                        <a href="{{ URL::route('admin.categories.manageCategory') }}">Manage Category</a>

                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    <li class="crumb-trail">Manage Category</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-visible">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs"> <span class="glyphicon glyphicon-tasks"></span> Manage Categories List</div>
                        </div>
                        <div class="panel-body pbn">
                            <table class="table table-striped table-bordered table-hover" id="datatable">
                                <thead>
                                <tr>
{{--
                                    <th>Left</th>
                                    <th>Right</th>
--}}
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Parent</th>
                                    <th>Slug</th>
                                    <th>Icon</th>
                                    <th>Created</th>
                                    <th class="text-center hidden-xs">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $er=1; ?>
                                @foreach ($categoryList as $category)
                                <tr id="catR{{ $category->id }}" class="{{ ($category->status==1)? 'disabletr' : '' }}">
{{--
                                    <td>{{ $category->lft }}</td>
                                    <td>{{ $category->rght }}</td>
--}}
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td><?php if(!$category->parent_id){ ?>
                                            <b>Self</b>
                                        <?php }else{ ?>
                                        {{ $category->parent_name }}
                                        <br>
                                        {{  '(Id=' . $category->parent_id . ')' }}
                                        <?php } ?>
                                    </td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        <div><center>
                                                <?php if($category->icon == ' ' || $category->icon == ''){
                                                    echo  "No <br> Image";
                                                }else{
                                                    echo  '<img src="/assets/backend/img/icon/thumb_icon/' . $category->icon .'" id="hover' . $er .'" class="catImg" alt="">';
                                                } ?>
                                            </center>
                                        </div>
                                    </td>
                                    <td>{{ $category->created_at }}</td>
                                    <td class="hidden-xs text-center">
                                        <div class="btn-group btn-group1">
                                            <button type="button"  id="{{ $category->id }}" class="btn checkID btn-danger btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-ban"></span> </button>
                                            <ul class='dropdown-menu checkbox-persist pull-right text-left' role='menu'>
                                                <li id="status{{ $category->id }}">
                                                    <?php if($category->status==0){ ?>
                                                    <a onclick="return disableF('{{ $category->id }}')">
                                                        <i class="fa fa-ban"></i> Disable
                                                    </a>
                                                    <?php }else{ ?>
                                                    <a onclick="return enableF('{{ $category->id }}')">
                                                        <i class="fa fa-check-square-o"></i> Enable
                                                    </a>
                                                    <?php } ?>
                                                </li>
                                                <li>
                                                    <a onclick="return deleteF('{{ $category->id }}')">
                                                        <i class="glyphicons glyphicons-circle_remove"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>

                                        <div class="btn-group">
                                            <button type="button" class="btn bg-green2 btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-cogwheel"></span> </button>
                                            <ul class="dropdown-menu checkbox-persist pull-right text-left" role="menu">
                                                <li>
                                                    <a href="{{ URL::route('admin.categories.view', $category->id) }}">
                                                        <i class="fa fa-eye"></i> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ URL::route('admin.categories.edit', $category->id) }}">
                                                        <i class="fa fa-pencil"></i> Edit
                                                    </a>
                                                </li>
                                            </ul>
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
                    "iDisplayLength": 20,
                    "aLengthMenu": [[10, 20, 40, 60, 80, -1], [10, 20, 40, 60, 80, "All"]],
                    "sDom": 'T<"panel-menu dt-panelmenu"lfr><"clearfix">tip'

                });

                // Manually Init Chosen on Datatables Filters
                $("select[name='datatable_length']").chosen();

                // Init Xeditable Plugin
                $.fn.editable.defaults.mode = 'popup';
                $('.xedit').editable();
                $('div#datatable_filter').remove();

///////////////////////////////////////////////////

            });
            ///////////////Delete row/////////////////////////

            function deleteF(id){
                $.ajax({
                    type: "Get",
                    url: "/admin/categories/delete/" + id,
                    success: function(result){
                        $('#catR'+id).fadeOut("slow");
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
                    url: "/admin/categories/disable/" + id,
                    success: function(result){
                        $('.panel-body.pbn').fadeOut(200, function(){
                            $('.panel-body.pbn').fadeIn().delay(2000);
                            $('#catR'+id).addClass("disabletr");

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
                    url: "/admin/categories/enable/" + id,
                    success: function(result){
                        $('.panel-body.pbn').fadeOut(200, function(){
                            $('.panel-body.pbn').fadeIn().delay(2000);
                            $('#catR'+id).removeClass("disabletr");

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
