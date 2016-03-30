
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/summernote/summernote.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datatables/js/datatables.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datatables/extras/TableTools/media/js/ZeroClipboard.js"></script>
        <script type="text/javascript" src="/assets/backend/xeditable/js/bootstrap-editable.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/chosen/chosen.jquery.js"></script>

    @stop

    @section('content')

        <!--main content start-->
        <div id="content">
            <!-- EMAIL HEADER -->
            <div class="content-header">
                <div class="pull-left">
                    <div class="tab-btns ib">
                        <a href="#email-view" role="tab" data-toggle="tab" class="view-toggle hidden"></a>
                        <a href="#email-compose" role="tab" data-toggle="tab" class="btn bg-purple2 btn-sm mr10 compose-toggle">
                            <span class="glyphicons glyphicons-share mr5"></span> Compose Mail
                        </a>
                        <a href="#email-list" role="tab" data-toggle="tab" class="btn bg-purple2 btn-sm mr10 mail-toggle hidden">
                            <span class="glyphicons glyphicons-unshare mr5"></span> Return to Inbox
                        </a>
                    </div>
                    <div class="btn-group mr15">
                        <button type="button" class="btn btn-default btn-gradient btn-sm pr20 pl20 trash"><i class="fa fa-trash-o"></i> </button>
                    </div>
                    <!-- <input type="text" class="email-search input-unstyled" placeholder="Search..." value="Search..."> -->
                </div>
                <div class="pull-right"> <span class="email-count text-muted mr10"> 1-50 of 136 </span>
                    <div class="btn-group mr10">
                        <button type="button" class="btn btn-default btn-gradient btn-sm pr10 pl10"><span class="glyphicons glyphicons-chevron-left"></span> </button>
                        <button type="button" class="btn btn-default btn-gradient btn-sm pr10 pl10"><span class="glyphicons glyphicons-chevron-right"></span> </button>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="tab-content bg-light pn mt20">
                <div class="tab-pane fade p15" id="email-compose">
                    <!-- EMAIL COMPOSE -->
                    <div class="email-compose">
                        <form action="{{ URL::route('admin.messages.composeNew') }}" id="MessagesAdminIndexForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <div class="row mb5 mt10">
                            <div class="col-xs-5">
                                <div class="input-group"> <span class="input-group-addon"><span class="glyphicons glyphicons-old_man"></span> </span>
                                    <input type="hidden" value="{{ Session::get('user_email') }}" name="from_usr"/>
                                    <input type="email" class="form-control" placeholder="Email"  name="to_usr">
                                    <div class="input-group-btn">
                                        <button type="button" id="token-toggle" class="btn btn-default btn-gradient p6" tabindex="-1"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-5">
                                <div class="form-group">
                                    <div class="input-group"> <span class="input-group-addon"><span class="glyphicons glyphicons-keys"></span> </span>
                                        <input class="form-control" type="text" placeholder="Subject" name="subject" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn bg-grey2 pull-right btn-block" id="sendM"><span class="glyphicons glyphicons-share mr10"></span>Send</button>
                            </div>
                        </div>
                        <div class="summernote mt15"></div>
                        </form>
                    </div>
                </div>

                <div class="tab-pane active fade in" id="email-list">
                    <!-- EMAIL LISTINGS -->
                    <div class="email-list">
                        <table class="table table-striped table-hover table-curved email-table">
                            <tbody>
                            @foreach($inboxMessages as $item)
                            <tr class="fw700" id="tr{{ $item->id }}">
                                <td class="table-icon">
                                    <div class="cBox cBox-inline">
                                        <input type="checkbox" class="trash_check" id="{{ $item->id }}" name="check" value="{{ $item->id }}">
                                    </div>
                                </td>
                                <td class="table-icon"><span class="glyphicons glyphicons-star fs15"></span></td>
                                <td id="{{ $item->id }}">{{ $item->from_usr }}</td>
                                <td id="{{ $item->id }}"><span><span class="label bg-purple label-sm mr10">Friend</span>{{ $item->subject }}</span></td>
                                <td class="text-right"><span class="glyphicons mr10"></span>10:23am</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- end listings (maybe) -->
                </div>
                <div class="tab-pane fade p20 pt15" id="email-view">
                    <!-- EMAIL VIEW -->
                    <div class="email-view">
                    </div>
                </div>
                <!-- End tab -->
            </div>
            <!-- End tab-content -->
        </div>
    @stop

    @section('custom-script')

        <!-- Page Plugins -->
        <script type="text/javascript">
            jQuery(document).ready(function () {
                "use strict";

                // Init Summernote Instances
                $('.summernote').summernote({
                    height: 315,   //set editable area's height
                    focus: false  //set focus editable area after Initialize summernote
                });
                $('.summernote2').summernote({
                    height: 200,   //set editable area's height
                    focus: false  //set focus editable area after Initialize summernote
                });
                $(".note-codeable").attr("name","body");

                // Toggle Sidebar Menu
                $('#mail-sidebar').on('click', function() {
                    $('.email-menu').slideToggle();
                    $('.sidebar-menu').toggleClass('animated fadeIn hidden');
                });

                // Toggle Content Buttons
                $('.compose-toggle, .mail-toggle').on('click', function() {
                    $('.compose-toggle, .mail-toggle').toggleClass('hidden');
                });
                $('.email-table tr td').on('click', function() {
                    var starToggle = $(this).find('.glyphicons-star');
                    if (starToggle.length) {starToggle.toggleClass('text-orange');}
                    if ($(this).hasClass('table-icon')) {return}

                    var mid = $(this).attr('id');
                    $.ajax({
                        type: 'GET',
                        url: "/admin/messages/details/" + mid,
                        success: function(d){
                            $('.email-view').html(d.html_content);
                        }
                    });

                    $('a[href="#email-view"]').tab('show') // Select tab by name
                });

                // Toggle Active list menu item
                $('.email-menu ul li').on('click',function() {
                    $('a[href="#email-list"]').tab('show') // Select tab by name
                    $(this).siblings('li').removeClass('active').end().addClass('active');
                });

                // Toggle Extra Fields
                $('#token-toggle').on('click', function() {
                    $('.token-fields').toggleClass('animated fadeIn hidden');
                });


                $('#sendM').on('click', function() {
                    var message = $('.note-editable').html();
                    $('.note-codeable').html(message);

                });

                $('.trash').on('click', function() {
                    var messageID = $('.trash_check').attr('id');
                    var val = [];

                    $(':checkbox:checked').each(function(i){
                        val[i] = $(this).val();

                        if(val[i] != 'None'){
                            $.ajax({
                                type: 'GET',
                                url: "/admin/messages/messageTrash/" + val[i],
                                success: function(d){
                                    location.reload();
                                }
                            });
                        }
                    });
                });
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

        </script>

    @stop

@stop
