
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
                        <a href="{{ URL::route('admin.memberships.manageMembership') }}">Manage Membership</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Manage Membership</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-visible">
                        <div class="panel-heading">
                            <div class="panel-title hidden-xs"> <span class="glyphicon glyphicon-tasks"></span> Manage Membership List</div>
                        </div>
                        <div class="panel-body pbn">
                            <table class="table table-striped table-bordered table-hover" id="datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plan Type</th>
                                        <th>Price</th>
                                        <th>Plan Duration</th>
                                        <th>Connections UpTo</th>
                                        <th>Downloading Limit</th>
                                        <th>Downloading Type</th>
                                        <th class="text-center hidden-xs">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($membershipType as $membership)
                                <tr id="CMS{{ $membership->id }}">
                                    <td>{{ $membership->id }}</td>
                                    <td>{{ $membership->PlanType }}</td>
                                    <td>$ {{ $membership->Price }}</td>
                                    <td>{{ $membership->PlanDuration }} Months</td>
                                    <td>{{ $membership->ConnectionsUpTo }}</td>
                                    <td>{{ ($membership->DownloadingLimit)? $membership->DownloadingLimit : 'Unlimited' }}</td>
                                    <td>{{ $membership->DownloadingType }}</td>

                                    <td class="hidden-xs text-center">
                                        <div class="btn-group btn-group1">
                                            <button type="button"  id="{{ $membership->id }}" class="btn btn-danger btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-ban"></span> </button>
                                            <ul class='dropdown-menu checkbox-persist pull-right text-left' role='menu'>
                                                <li>
                                                    <a onclick="return deleteF('{{ $membership->id }}');" id="{{ $membership->id }}">
                                                        <i class='glyphicons glyphicons-circle_remove'></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-green2 btn-gradient btn-sm dropdown-toggle" data-toggle="dropdown"> <span class="glyphicons glyphicons-cogwheel"></span> </button>
                                                <ul class="dropdown-menu checkbox-persist pull-right text-left" role="menu">
                                                    <li>
                                                        <a href="{{ URL::route('admin.memberships.view', $membership->id) }}"><i class="fa fa-eye"></i> View </a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ URL::route('admin.memberships.edit', $membership->id) }}"><i class="fa fa-pencil"></i> Edit</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                    url: "/admin/memberships/delete/" + id,
                    success: function(result){
                        $('#CMS'+id).fadeOut("slow");
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
