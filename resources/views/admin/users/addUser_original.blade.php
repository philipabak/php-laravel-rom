
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
                        <a href="{{ URL::route('admin.users.addUser') }}">Add New User</a>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Add New User</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading"> <span class="panel-title"> <span class="glyphicons glyphicons-user_add"></span> Add New User </span> </div>
                        <div class="panel-body">
                        <form action="{{ URL::route('admin.users.addNewUser') }}" name="User" class="form-horizontal" id="UserAdminAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <fieldset class="fieldset">
                                <legend class="legend">Member Information</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">First Name</label>
                                    <div class="col-lg-6">
                                        <input name="first_name" class="form-control" placeholder="Type Your First Name" required="required" maxlength="255" type="text" id="UserFirstName">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Last Name</label>
                                    <div class="col-lg-6">
                                        <input name="last_name" class="form-control" placeholder="Type Your last Name" maxlength="30" type="text" id="UserLastName" required="required">
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="legend">Login Information</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select User Role:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="role" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select The Role" id="UserRole" required="required">
                                            <option value="">Select</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Customer">Customer</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Email Address:</label>
                                    <div class="col-lg-6">
                                        <input name="email" class="form-control" placeholder="Type Your Email" maxlength="50" type="email" id="UserEmail" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Username:</label>
                                    <div class="col-lg-6">
                                        <input name="username" class="form-control" placeholder="Type Your username" maxlength="255" type="text" id="UserUsername" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Password:</label>
                                    <div class="col-lg-6">
                                        <input name="password" class="form-control pas1" placeholder="Enter The Password" type="password" id="UserPassword" required="required">
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
                                <legend class="legend">Contact Information</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="Address">Address:</label>
                                    <div class="col-lg-6">
                                        <textarea name="addres" class="form-control" rows="4" title="Please Type your Address" cols="30" id="UserAddres" required="required"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMobile" class="col-lg-2 control-label"> Your Mobile:</label>
                                    <div class="col-lg-6">
                                        <input name="mobile" class="form-control" placeholder="Type Your Mobile Number" maxlength="30" type="text" id="UserMobile" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Your Phone:</label>
                                    <div class="col-lg-6">
                                        <input name="phone" class="form-control" placeholder="Type Your Phone Number" maxlength="30" type="tel" id="UserPhone">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Gender:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="gender" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select your gender" id="UserGender" required="required">
                                            <option value="">Select</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="maskedDate" class="col-lg-2 control-label">Your Birthday:</label>
                                    <div class="col-lg-6">
                                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-calendar"></i> </span>
                                            <input name="DOB" class="form-control datepicker mtn" id="datepicker" maxlength="10" autocomplete="off" placeholder="11/11/1111" type="text" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputStandard" class="col-lg-2 control-label">Your Nationality:</label>
                                    <div class="col-lg-6">
                                        <input name="nationality" class="form-control" placeholder="Enter your nationality" maxlength="50" type="text" id="UserNationality" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputStandard" class="col-lg-2 control-label">Select The City:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="country" data-placeholder="Select City" id="multiselect4" class="form-control" tabindex="2" required="required">
                                            <option value="0">Select City...</option>
                                        @foreach($countryList as $country)
                                            <option value="{{ $country->id }}">{{ $country->country }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputMobile" class="col-lg-2 control-label"> Your postal /Zip Code:</label>
                                    <div class="col-lg-6">
                                        <input name="zip" class="form-control" placeholder="Type Your Zip Code" maxlength="20" type="text" id="UserZip" required="required">
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
                                            <div id="images"></div>
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
                                                <input type="radio" name="avtar1" id="av{{ $av }}" value="{{ $av . '.jpeg' }}">
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
