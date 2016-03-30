
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/plugins/globalize/globalize.js"></script>
        <script type="text/javascript" src="/assets/backend/ckeditor/ckeditor.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/multiselect/bootstrap-multiselect.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/validate/jquery.validate.js"></script>

    @stop

    @section('content')

        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.news.addNews') }}">Edit News</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Add New News</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"> <span class="glyphicons glyphicons-pencil"></span> Edit News </span>
                        </div>
                        <div class="panel-body">
                        <form action="{{ URL::route('admin.news.update', $viewNews->id) }}" class="form-horizontal" id="admin_addAdminAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <fieldset class="fieldset">
                                <legend class="legend">General Information</legend>
                                <div class="form-group">
                                    <label for="inputComments" class="col-lg-2 control-label">Category:</label>
                                    <div class="col-lg-6 selectC" id="div_category">
                                        <select name="category" class="multiselect1 form-control" id="NewsListCategory">
                                            <option value="">Select User Type...</option>
                                        @foreach($newsCategoryList as $newsCategory)
                                            <option value="{{ $newsCategory->id }}">{{ $newsCategory->name }}</option>
                                        @endforeach
                                        </select>
                                        <label style="display:none;" class="error NewsListCategory">This field is required.</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-6">
                                        <input name="title" class="form-control" placeholder="Type the title" maxlength="200" type="text" id="NewsListTitle" required="required" value="{{ $viewNews->title }}">
                                        <label style="display:none;" class="error NewsListTitle">This field is required.</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Slug</label>
                                    <div class="col-lg-6">
                                        <input name="slug" readonly="readonly" class="form-control" placeholder="Slug.." maxlength="200" type="text" id="NewsListSlug" required="required" value="{{ $viewNews->slug }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="Address">Content:</label>
                                    <div class="col-lg-10">
                                        <div class="panel">
                                            <div class="panel-body pn">
                                                <textarea name="content" id="editor1" class="editor1" rows="4" placeholder="Enter the page content." cols="30">{{ $viewNews->title }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputComments" class="col-lg-2 control-label">Page Visible To:</label>
                                    <div class="col-lg-6 selectC" id="div_membertype">
                                        <select name="visible_to" class="multiselect1 form-control" id="NewsListVisibleTo">
                                            <option value="">Select User Type...</option>
                                        @foreach($memberType as $member)
                                            <option value="{{ $member->id }}">{{ $member->type }}</option>
                                        @endforeach
                                        </select>
                                        <label style="display:none;" class="error NewsListVisibleTo">This field is required.</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputComments" class="col-lg-2 control-label">Status:</label>
                                    <div class="col-lg-6 selectC" id="div_status">
                                        <select name="status" class="multiselect1 form-control" id="NewsListStatus">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                        <label style="display:none;" class="error NewsListStatus">This field is required.</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 text-right">News Cover</label>
                                    <div class="col-md-10">
                                        <div class="input-group col-md-6">
                                            <div class="upload-image">
                                                <div class="btn btn-info btn-gradient">
                                                    <label for="AdImageFiles">+Add Photo</label>
                                                    <input type="file" name="photo" class="upload" id="member_photo_upload" title="Select Your Profile Image">
                                                </div>
                                            </div>
                                            <div class="input-group col-md-4 pull-left">
                                                <div id="imagesN">
                                                    <?php if($viewNews->image){ ?>
                                                    <img class="thumbnail" width="200px" id="imageId" src="/assets/backend/img/news_covers/{{ $viewNews->image }}" alt="">
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
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

        <script type="text/javascript">
            jQuery(document).ready(function () {

                "use strict";

                // Init Theme Core
                Core.init();

                // Enable Ajax Loading
                Ajax.init();

                //Init Boostrap Multiselect
                $('.multiselect1').multiselect();

                var categoryId = '<?php echo $viewNews->category; ?>';
                $('#div_category input[name="multiselect"][type="radio"][value=' + categoryId + ']').click();

                var membertypeId = '<?php echo $viewNews->visible_to; ?>';
                $('#div_membertype input[name="multiselect"][type="radio"][value=' + membertypeId + ']').click();

                var statusId = '<?php echo $viewNews->status; ?>';
                $('#div_status input[name="multiselect"][type="radio"][value=' + statusId + ']').click();

            });

            // Init Ckeditor. Replace Text area with Ckeditor
            // and assign it a custom skin class
            CKEDITOR.replace( 'editor1',
                    {
                        on : { instanceReady : function ( evt )  {
                            $('#editor1').height(350);
                            $('#cke_1_contents').height(300);
                            $('#cke_editor1').addClass('fusionSkin');
                        }}
                    });

            // validate the comment form when it is submitted
            jQuery(document).ready(function() {
                jQuery('#admin_addAdminAddForm').submit(function(e){

                    var cat= jQuery('#NewsListCategory').val();
                    var text= jQuery('#editor1').val();
                    var vto= jQuery('#NewsListVisibleTo').val();
                    var sta= jQuery('#NewsListStatus').val();

                    if(cat=='' ){jQuery('.NewsListCategory').show(); }
                    if( text==''){jQuery('.editor1L').show();}
                    if(vto=='' ){jQuery('.NewsListVisibleTo').show();}
                    if(sta=='' ){jQuery('.NewsListStatus').show();}

                    if(cat=='' || text=='' || vto=='' || sta=='' ){
                        e.preventDefault();
                    }


                });

                jQuery('#NewsListCategory').change(function(){
                    var cate= jQuery('#NewsListCategory').val();
                    if(cate=='' ){ jQuery('.NewsListCategory').fadeIn('slow'); }else{ jQuery('.NewsListCategory').fadeOut('slow'); }
                });
                jQuery('#NewsListVisibleTo').change(function(){
                    var v_to= jQuery('#NewsListVisibleTo').val();
                    if(v_to=='' ){ jQuery('.NewsListVisibleTo').fadeIn('slow'); }else{ jQuery('.NewsListVisibleTo').fadeOut('slow'); }
                });
                jQuery('#NewsListStatus').change(function(){
                    var stat= jQuery('#NewsListStatus').val();
                    if(stat=='' ){ jQuery('.NewsListStatus').fadeIn('slow'); }else{ jQuery('.NewsListStatus').fadeOut('slow'); }
                });

            });

            $("#admin_addAdminAddForm").validate();

            $('#NewsListTitle').blur(function(){
                var str = jQuery('#NewsListTitle').val();
                var patt1 = str.trim();
                var result = patt1.replace(/\s{1,}/g, '-');
                $("#NewsListSlug").val(result);
            });

            function readURL(input) {

                var imageFiles;

                imageFiles = document.getElementById('member_photo_upload').files

                for(var i=0; i<=imageFiles.length;i++){
                    if (input.files && input.files[i]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            var image = '<div class="slott" id="slot-2" data-slot="2"><img class="thumbnail" height="30" width="50" id="imageId" src="' + e.target.result + '"/></div>';
                            jQuery('#imagesN').html(image);              }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            }

            jQuery('#member_photo_upload').change(function(){
                readURL(this);
            });

        </script>

    @stop

@stop
