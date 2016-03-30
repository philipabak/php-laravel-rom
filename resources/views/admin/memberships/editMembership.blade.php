
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/plugins/globalize/globalize.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/multiselect/bootstrap-multiselect.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/validate/jquery.validate.js"></script>

    @stop

    @section('content')

        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.memberships.edit', $userItem->id) }}">Edit Membership</a>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Edit Membership</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading"> <span class="panel-title"> <span class="glyphicons glyphicons-pencil"></span> Edit Membership </span> </div>
                        <div class="panel-body">
                        <form action="{{ URL::route('admin.memberships.update', $userItem->id) }}" name="User" class="form-horizontal" id="UserAdminAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <fieldset class="fieldset">
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Membership Type</label>
                                    <div class="col-lg-6">
                                        <input name="PlanType" class="form-control" placeholder="Type Membership Name" required="required" maxlength="255" type="text" id="PlanType" value="{{ $userItem->PlanType }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Price</label>
                                    <div class="col-lg-6">
                                        <input name="Price" class="form-control" placeholder="Type Price" maxlength="30" type="number" id="Price" required="required" value="{{ $userItem->Price }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Plan Duration(Months)</label>
                                    <div class="col-lg-6">
                                        <input name="PlanDuration" class="form-control" placeholder="Type Plan Duration" maxlength="30" type="number" id="Planduration" required="required" value="{{ $userItem->PlanDuration }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Connections UpTo</label>
                                    <div class="col-lg-6">
                                        <input name="ConnectionsUpTo" class="form-control" placeholder="Type Connections UpTo" maxlength="30" type="number" id="ConnectionsUpTo" required="required" value="{{ $userItem->ConnectionsUpTo }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Downloading Limit ( If you want to set unlimited, please type 0 as value )</label>
                                    <div class="col-lg-6">
                                        <input name="DownloadingLimit" class="form-control" placeholder="Type Downloading Limit" maxlength="30" type="number" id="DownloadingLimit" required="required" value="{{ $userItem->DownloadingLimit }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Downloading Type</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="DownloadingType" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select Downloading Type" id="DownloadingType" required="required">
                                            <option value="MB" {{ ($userItem->DownloadingType == 'MB')? 'selected' : '' }}>MB</option>
                                            <option value="GB" {{ ($userItem->DownloadingType == 'GB')? 'selected' : '' }}>GB</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group"></div>

                                <div class="form-group">
                                    <label for="inputMobile" class="col-lg-2 control-label"></label>
                                    <div class="col-lg-6" style="text-align: left;">
                                        <div class="btn-group">
                                            <button class="btn bg-red3 bg-gradient pull-right" type="reset"><i class="fa fa-times"></i> Reset</button>
                                        </div>
                                        <div class="btn-group">
                                            <button id="register1" class="btn bg-blue3 bg-gradient pull-right" type="submit"><i class="fa fa-plus"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @stop

    @section('custom-script')
        <script type="text/javascript">
            jQuery(document).ready(function () {

                "use strict";

                // Init Theme Core
                Core.init();

                // Enable Ajax Loading
                Ajax.init();


                // validate the comment form when it is submitted
                $("#UserAdminAddForm").validate();

                //Init Boostrap Multiselect
                $('.multiselect1').multiselect();

                $('#multiselect4').multiselect({
                    enableFiltering: true,
                })

                //Init jquery Date Picker
                $('.datepicker').datepicker()

            });

            $('.avtr').click(function(){
                $('#member_photo_upload').val("");
                $('#images').html("");
                $("input[type='radio']#av1").prop('checked', true);
                $('.avtarGroup').fadeIn(1500);
            });

            $('#member_photo_upload').click(function(){
                $("input[type='radio']#av1").prop('checked', false);
                $('.avtarGroup').hide();
            });

            function readURL(input) {

                var imageFiles;

                imageFiles = document.getElementById('member_photo_upload').files

                for(i=0; i<=imageFiles.length;i++){
                    if (input.files && input.files[i]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            var image = '<div class="slott" id="slot-2" data-slot="2"><img class="thumbnail" height="30" width="50" id="imageId" src="' + e.target.result + '"/></div>';
                            jQuery('#images').html(image);              }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            }

            jQuery('#member_photo_upload').change(function(){
                readURL(this);
            });
            jQuery('#register1').click(function(e){

                var pass1 = jQuery('.pas1').val();
                var pass2 = jQuery('.pas2').val();
                jQuery('#yError').hide();
                if (pass1 != pass2) {
                    jQuery(".pas2").css({"animation":"0.7s linear 0s normal none 1 shake", "border":"1px solid #CE5454","box-shadow":"0 0 4px -2px #CE5454"});
                    jQuery('#yError').html('Both password fields must be filled out and they would be same.');
                    jQuery('#yError').show();
                    e.preventDefault();
                }else { return true; }

            });

        </script>
    @stop

@stop
