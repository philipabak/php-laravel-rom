
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
                        <a href="{{ URL::route('admin.files.addFile') }}">Add New File</a>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    <li class="crumb-trail">Add New File</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading"> <span class="panel-title"> <span class="glyphicons glyphicons-film"></span> Add New File </span> </div>
                        <div class="panel-body">
                            <form action="{{ URL::route('admin.files.addNewFile') }}" class="form-horizontal" id="add_fileAdminAddFileForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <fieldset class="fieldset">
                                <legend class="legend">Media Information</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-6">
                                        <input name="title" class="form-control" placeholder="Type the title" maxlength="200" type="text" id="FileTitle" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Slug</label>
                                    <div class="col-lg-6">
                                        <input name="slug" readonly="readonly" class="form-control" placeholder="Slug.." maxlength="500" type="text" id="FileSlug" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Select Category:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="parent_id" required="required" class="form-control multiselect1" placeholder="Select the category. " id="FileParentId">
{{--
                                            <option value=""></option>
--}}
                                        @foreach($categoryList as $category)
                                            <option value="{{ $category->id }}">{{ ($category->parent_id)? '--' : '' }} {{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Author:</label>
                                    <div class="col-lg-6">
                                        <input name="author" class="form-control" placeholder="Type the author name" maxlength="100" type="text" id="FileAuthor" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Author Email:</label>
                                    <div class="col-lg-6">
                                        <input name="author_email" class="form-control" placeholder="Type the author email" type="email" id="FileAuthorEmail" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Author Website:</label>
                                    <div class="col-lg-6">
                                        <input name="author_website" value="http://" class="form-control pas1" maxlngth="500" type="text" id="FileAuthorWebsite">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="Address">Description:</label>
                                    <div class="col-lg-6">
                                        <textarea name="description" class="form-control" rows="4" placeholder="Type the description" cols="30" id="FileDescription" required="required"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="SearchTerms">Search Terms: Please type comma(,) between terms.</label>
                                    <div class="col-lg-6">
                                        <textarea name="search_terms" class="form-control" rows="2" placeholder="Type the search terms" cols="30" id="SearchTerms" required="required"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputComments" class="col-lg-2 control-label">Allow Comments?:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="allow_comment" style="margin-left: -4px;" class="multiselect1 form-control" id="FileAllowComment" required="required">
{{--
                                            <option value="">Select</option>
--}}
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="FileDownloadVisibleTo" class="col-lg-2 control-label">Download Visible To:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="download_visible_to" style="margin-left: -4px;" class="multiselect1 form-control" id="FileDownloadVisibleTo" required="required">
{{--
                                            <option value="">Select User Type...</option>
--}}
                                        @foreach($memberType as $member)
                                            <option value="{{ $member->id }}">{{ $member->type }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="FileDownloadBy" class="col-lg-2 control-label">Download By:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="download_by" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select status" id="FileDownloadBy" required="required">
{{--
                                            <option value="">Select User Type...</option>
--}}
                                            @foreach($memberType as $member)
                                                <option value="{{ $member->id }}">{{ $member->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="FileRegion" class="col-lg-2 control-label">Region:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="region" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select status" id="FileRegion" required="required">
                                            @foreach($regionList as $region)
                                                <option value="{{ $region->id }}">{{ $region->country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Release Group:</label>
                                    <div class="col-lg-6">
                                        <input name="release" class="form-control" placeholder="Type the release group" maxlength="100" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Language:</label>
                                    <div class="col-lg-6">
                                        <input name="language" class="form-control" placeholder="Type the language" maxlength="100" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Previous versions:</label>
                                    <div class="col-lg-6">
                                        <input name="version" class="form-control" placeholder="Type the previous version" maxlength="100" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="status" class="col-lg-2 control-label">Status:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="status" style="margin-left: -4px;" class="multiselect1 form-control" placeholder="Select status" id="FileStatus" required="required">
                                            @foreach($romStatus as $status)
                                                <option value="{{ $status->id }}">{{ $status->type }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="legend">Media Files</legend>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Cover Image:</label>
                                    <div class="col-lg-2">
                                        <div class="upload-image">
                                            <div class="btn btn-info btn-gradient">
                                                <label for="AdImageFiles">+Add Photo</label>
                                                <input type="file" name="image" class="upload" style="width:62%;" id="member_photo_upload" title="Select Your Profile Image">
                                            </div>
                                        </div>
                                        <div class="input-group col-md-4 pull-left">
                                            <div id="images"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">File (local server):</label>
                                    <div class="col-lg-6">
                                        <input type="file" name="file" class="form-control" id="FileFile" required>
{{--
                                        <select name="file" class="form-control" id="FileFile">
                                            <option value="">Select File..</option>
                                        </select>
--}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-6" style="text-align: center;">OR</div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">External Link:</label>
                                    <div class="col-lg-6">
                                        <input name="url" type="url" class="form-control" placeholder="Enter the external url." id="FileUrl">
                                        <label class="file_url"></label>
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
                                            <button id="submit" class="btn bg-blue3 bg-gradient pull-right" type="submit"><i class="fa fa-plus"></i> Save</button>
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
        <script type="text/javascript"file_url>
            jQuery(document).ready(function () {

                "use strict";

                // Init Theme Core
                Core.init();

                // Enable Ajax Loading
                Ajax.init();



                //Init Boostrap Multiselect
                $('.multiselect1').multiselect();

            });

            $('#RomFile, #RomUrl').blur(function(){
                var files = $('#RomFile').val();
                var url = $('#RomUrl').val();
                if((files == ' ' || files == '') && (url == ' ' || url == '')){
                    var fu_error = 'There should be at lest one required.';

                    $('label.file_url').show();
                    $('.file_url').text(fu_error);
                    return false;
                }else {
                    $('.file_url').text('');
                    $('.file_url').hide();
                }
            });
            $('#add_romAdminAddRomForm').submit(function(){
                var files = $('#RomFile').val();
                var url = $('#RomUrl').val();
                if((files == ' ' || files == '') && (url == ' ' || url == '')){
                    var fu_error = 'There should be at lest one required.';

                    $('label.file_url').show();
                    $('.file_url').text(fu_error);
                    return false;
                }else {
                    $('.file_url').text('');
                    $('.file_url').hide();
                }
            });

            // validate the comment form when it is submitted
            $("#add_romAdminAddRomForm").validate();

            $('#RomUrl').keyup(function(){
                $('#RomFile').val('');
            });

            $('#RomFile').change(function(){
                $('#RomUrl').val('');
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


            $('#RomParentId').change( function(){
                var catid = $(this).val();
                $.ajax({
                    url: '/<?php $parentparentdir=basename(dirname(dirname(dirname(dirname(__FILE__)))));
				echo $parentparentdir; ?>/Roms/find_files/'+catid,
                    type: "POST",
                    data: new FormData(),
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(data)
                    {
                        $("#RomFile").html(data);
                    }
                });

            });

            $('#FileTitle').blur(function(){
                var str = jQuery('#FileTitle').val();
                var patt1 = str.trim();
                var result = patt1.replace(/\s{1,}/g, '-');
                $("#FileSlug").val(result);
            });

        </script>

    @stop

@stop
