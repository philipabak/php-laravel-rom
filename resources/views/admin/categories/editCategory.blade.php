
@extends('adminLayout')

    @section('custom-js')

        <script type="text/javascript" src="/assets/backend/plugins/globalize/globalize.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/multiselect/bootstrap-multiselect.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/validate/jquery.validate.js"></script>

    @stop

    @section('content')

        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.categories.edit', $viewCategory->id) }}">Edit Category</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Edit Category</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"> <span class="glyphicons glyphicons-pencil"></span> Edit Category </span>
                        </div>
                        <div class="panel-body">
                        <form action="{{ URL::route('admin.categories.update', $viewCategory->id) }}" class="form-horizontal" id="CategoryAdminAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <label class="col-md-2 text-right">Category Name</label>
                                <div class="col-md-10">
                                    <div class="input-group col-md-6">
                                        <input name="name" class="form-control" placeholder="Category Name" maxlength="255" type="text" id="CategoryName" required value="{{ $viewCategory->name }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 text-right">Category Slug</label>
                                <div class="col-md-10">
                                    <div class="input-group col-md-6">
                                        <input name="slug" class="form-control" placeholder="Category Slug" maxlength="255" type="text" id="CategorySlug" readonly value="{{ $viewCategory->slug }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="div_category">
                                <label class="col-md-2 text-right">Parent Category</label>
                                <div class="col-md-10">
                                    <div class="input-group col-md-6 selectC">
                                        <select name="parent_id" id="multiselect1" class="form-control" placeholder="Parent Category " title="Select the parent category.">
                                            <option value="0">Main Category</option>
                                        @foreach($categoryList as $category)
                                            <option value="{{ $category->id }}">{{ ($category->parent_id)? '--' : '' }} {{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 text-right">Category Icon</label>
                                <div class="col-md-10">
                                    <div class="input-group col-md-6">
                                        <div class="upload-image">
                                            <div class="btn btn-info btn-gradient">
                                                <label for="AdImageFiles">+Add Photo</label>
                                                <input type="file" name="photo" class="upload" id="member_photo_upload" title="Select Your Profile Image">
                                            </div>
                                            <i class='image-hint'>Upload only 100px(H) x 150px(W)</i>
                                        </div>
                                        <div class="input-group col-md-4 pull-left">
                                            <div id="images">
                                                <?php if($viewCategory->icon){ ?>
                                                <img class="thumbnail" width="200px" id="imageId" src="/assets/backend/img/icon/thumb_icon/{{ $viewCategory->icon }}" alt="">
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-2 text-right"></label>
                                <div class="col-md-10">
                                    <div class="input-group col-md-6" style="text-align: right;">
                                        <div class="btn-group">
                                            <button class="btn bg-red3 bg-gradient pull-right" type="reset"><i class="fa fa-times"></i> Reset</button>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn bg-blue3 bg-gradient pull-right" type="submit"><i class="fa fa-plus"></i> Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @stop

    @section('custom-script')

        <!-- Page Plugins -->
        <script type="text/javascript">
            jQuery(document).ready(function () {

                "use strict";

                // Init Theme Core
                Core.init();

                // Enable Ajax Loading
                Ajax.init();


                // validate the comment form when it is submitted
                $("#CategoryAdminAddForm").validate();

                //Init Boostrap Multiselect
                $('#multiselect1').multiselect();

                var categoryId = '<?php echo $viewCategory->parent_id; ?>';
                $('#div_category input[name="multiselect"][type="radio"][value=' + categoryId + ']').click();

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

            $('#CategoryName').blur(function(){
                var str = jQuery('#CategoryName').val();
                var patt1 = str.trim();
                var result = patt1.replace(/\s{1,}/g, '-');
                $("#CategorySlug").val(result);
            });

        </script>

    @stop

@stop
