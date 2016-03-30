
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
                        <a href="{{ URL::route('admin.users.edit', $userItem->id) }}">Edit User</a>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Edit User</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"> <span class="glyphicons glyphicons-pencil"></span> Edit User </span>
                        </div>
                        <div class="panel-body">
                        <form action="{{ URL::route('admin.users.update', $userItem->id) }}" name="User" class="form-horizontal" id="UserAdminAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <fieldset class="fieldset">
                                <legend class="legend">Login Information</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select User Role:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="role" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select The Role" id="UserRole" required="required" onchange="membership_fn(this.value);">
                                            <option value="0" {{ ($userItem->user_type == 0)? 'selected' : '' }}>Admin</option>
                                            @foreach($memberType as $member)
                                                <option value="{{ $member->id }}" {{ ($member->id == $userItem->user_type)? 'selected' : '' }}>{{ $member->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group" id="div_points">
                                    <label class="col-lg-2 control-label">Points:</label>
                                    <div class="col-lg-6 selectC">
                                        <input name="points" class="form-control" placeholder="Type the Points" maxlength="50" type="number" id="points" required="required" value="{{ $userItem->points }}">
                                    </div>
                                </div>
                                <div class="form-group" id="div_membership">
                                    <label class="col-lg-2 control-label">Premium Membership Type:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="membership_role" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select The Membership Role" id="MembershipRole" required="required">
                                            @foreach($membershipType as $membership)
                                                <option value="{{ $membership->id }}" {{ ($membership->id == $userItem->membership_type)? 'selected' : '' }}>{{ $membership->PlanType }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email Address:</label>
                                    <div class="col-lg-6">
                                        <input name="email" class="form-control" placeholder="Type Your Email" maxlength="50" type="email" id="UserEmail" required="required" readonly value="{{ $userItem->email }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Username:</label>
                                    <div class="col-lg-6">
                                        <input name="username" class="form-control" placeholder="Type Your username" maxlength="255" type="text" id="UserUsername" required="required" readonly value="{{ $userItem->username }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Display Name</label>
                                    <div class="col-lg-6">
                                        <input name="name" class="form-control" placeholder="Type Your Display Name" required="required" maxlength="255" type="text" id="UserFirstName" value="{{ $userItem->first_name . ' ' . $userItem->last_name }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">New Password:</label>
                                    <div class="col-lg-6">
                                        <input name="password" class="form-control pas1" placeholder="Enter The Password" type="password" id="UserPassword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Confirm Password:</label>
                                    <div class="col-lg-6">
                                        <input name="confirm_password" class="pas2 form-control" placeholder="Conform Password" type="password" id="UserConfirmPassword">
                                        <span id="yError" style="color:red;display:block"></span>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="legend">Member Profile</legend>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Member's Photo:</label>
                                    <div class="col-lg-2">
                                        <div class="upload-image">
                                            <div class="btn btn-info btn-gradient">
                                                <label for="AdImageFiles">+Add Photo</label>
                                                <input type="file" name="avtar" class="upload" style="width:62%;" id="member_photo_upload" title="Select Your Profile Image">
                                            </div>
                                        </div>
                                        <div class="input-group col-md-4 pull-left">
                                            <div id="images">
                                                <img src="/assets/backend/img/avatars/{{ $userItem->photo }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="btn-group" style="font-size: 18px;">or
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="btn btn-info btn-gradient pull-right avtr" style="font-weight: 600;" type="button">
                                            <span class="glyphicons glyphicons-old_man"></span> Choose avtar
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group avtarGroup">
                                    <label for="inputPhone" class="col-lg-2 control-label">Choose any one:</label>
                                    <div class="col-lg-10">
                                        @for($av=1;$av<=18;$av++)
                                            <div class="avtars">
                                                <input type="radio" name="avtar1" id="av{{ $av }}" value="{{ $av . '.jpeg' }}" {{ ($userItem->photo == $av . '.jpeg')? 'selected' : '' }}>
                                                <img src="/assets/backend/img/avatars/{{ $av . '.jpeg' }}" alt="">
                                            </div>
                                        @endfor
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

                var user_type = '<?php echo $userItem->user_type; ?>';
                if(user_type == 7){
                    $('#div_membership').css('display', 'block');
                } else{
                    $('#div_membership').css('display', 'none');
                }
                if(user_type == 4){
                    $('#div_points').css('display', 'block');
                } else{
                    $('#div_points').css('display', 'none');
                }
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

            function membership_fn(id){
                if(id == 7){
                    $('#div_membership').css('display', 'block');
                }else{
                    $('#div_membership').css('display', 'none');
                }
                if(id == 4){
                    $('#div_points').css('display', 'block');
                }else{
                    $('#div_points').css('display', 'none');
                }
            }

        </script>
    @stop

@stop
