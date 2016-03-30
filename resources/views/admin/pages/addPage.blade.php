
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
                        <a href="{{ URL::route('admin.pages.addPage') }}">Add New Page</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Add New Page</li>
                </ol>
            </div>
        </div>

        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <span class="panel-title"> <span class="glyphicons glyphicons-notes"></span> Add New CMS Page </span>
                        </div>
                        <div class="panel-body">
                        <form action="{{ URL::route('admin.pages.addNewPage') }}" class="form-horizontal" id="addAdminAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate">
                            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                            <fieldset class="fieldset">
                                <legend class="legend">General Information</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Title</label>
                                    <div class="col-lg-6">
                                        <input name="title" class="form-control" placeholder="Type the title" maxlength="200" type="text" id="CmsPageTitle" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Slug</label>
                                    <div class="col-lg-6">
                                        <input name="slug" readonly="readonly" class="form-control" placeholder="Slug.." maxlength="200" type="text" id="CmsPageSlug" required="required">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" for="Address">Content:</label>
                                    <div class="col-lg-10">
                                        <div class="panel">
                                            <div class="panel-body pn">
                                                <textarea name="content" id="editor1" class="editor1" rows="4" placeholder="Enter the page content." cols="30"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputComments" class="col-lg-2 control-label">Page Visible To:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="visible_to" style="margin-left: -4px;" class="multiselect1 form-control" id="CmsPageVisibleTo">
                                        @foreach($memberType as $member)
                                            <option value="{{ $member->id }}">{{ $member->type }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputComments" class="col-lg-2 control-label">Status:</label>
                                    <div class="col-lg-6 selectC">
                                        <select name="status" style="margin-left: -4px;" class="multiselect1 form-control" id="CmsPageStatus">
                                            <option value="">Select</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="legend">Meta Information</legend>
                                <div class="form-group">
                                    <label for="inputPhone" class="col-lg-2 control-label">Meta Title:</label>
                                    <div class="col-lg-6">
                                        <input name="meta_title" class="form-control" placeholder="Enter the page Meta Title." maxlength="100" type="text" id="CmsPageMetaTitle">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Keywords:</label>
                                    <div class="col-lg-6">
                                        <input name="keywords" class="form-control" placeholder="Enter the page keywords." maxlength="200" type="text" id="CmsPageKeywords">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Description:</label>
                                    <div class="col-lg-6">
                                        <textarea name="meta_description" rows="6" class="form-control" placeholder="Enter the Meta Ddescription of page." cols="30" id="CmsPageMetaDescription"></textarea>
                                    </div>
                                </div>
                            </fieldset>

                            <fieldset class="fieldset">
                                <legend class="legend">Navigation Information</legend>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label">Area:</label>
                                    <div class="col-lg-6">
                                        <span for="ColorsRed">Footer </span>
                                        <input type="checkbox" name="p_area" value="Footer" checked="checked" id="CmsPagePArea">
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
            $("#addAdminAddForm").validate();

            $('#CmsPageTitle').blur(function(){
                var str = jQuery('#CmsPageTitle').val();
                var patt1 = str.trim();
                var result = patt1.replace(/\s{1,}/g, '-');
                $("#CmsPageSlug").val(result);
            });

        </script>

    @stop

@stop
