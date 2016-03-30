
@extends('user.details.detailsLayout')

    @section('tab-content')
        <style>
            .row{
                margin-right: -10px;!important;
            }
        </style>

        <div>
            <h1 class="page-title"> {{ $fileItem->title }} ({{ $region->country }}) {{ ($fileItem->language)? '(' . $fileItem->language . ')' : '' }}</h1>

            <div class="col-xs-12">

                <div class="row">

                    <div class="col-xs-12 col-sm-4 col-md-4 col-md-offset-0">
                        <img src="/assets/backend/img/rom_images/thumb/{{ $fileItem->image }}" alt="" class="img-responsive cover-art">
                    </div>
                    <div class="col-xs-12 col-sm-8 col-md-8 col-md-offset-0">
                        <div class="row">

                            <div class="col-xs-12">
                                <div class="btn-download col-xs-12 col-lg-6 col-sm-12">
<!--
                                    <a href="/ajax/fileDownload/{{ $fileItem->id }}" class="big-download">DOWNLOAD <span>FILE</span></a>
-->
                                    <a href="javascript:;" onclick="fileDownload('<?php echo $fileItem->id; ?>');" class="big-download">DOWNLOAD <span>FILE</span></a>
                                </div>
                                <div class="btn-add col-xs-12 col-lg-6 col-sm-12">
                                    <a href="javascript:;" onclick="addDownloadList('<?php echo $fileItem->id; ?>');" class="big-download"><span>ADD TO</span><br>DOWNLOAD LIST</a>
                                </div>


                            </div>
                            <div class="col-xs-12 div col-md-6">
                                <p class="detail-label">FILESIZE</p>
                                <p class="detail">{{ ($fileItem->file_size / 1024 / 1024 > 0.1)? number_format($fileItem->file_size / 1024 / 1024, 1) . 'MB' : number_format($fileItem->file_size / 1024, 1) . 'KB' }}</p>

                                <p class="detail-label">DATE</p>
                                <p class="detail">{{ $fileItem->created_at }}</p>
                                @if($fileItem->release)
                                    <p class="detail-label">RELEASE GROUP</p>
                                    <p class="detail">{{ $fileItem->release }}</p>
                                @endif
                                @if($fileItem->version)
                                    <p class="detail-label">PREVIOUS VERSION</p>
                                    <p class="detail">{{ $fileItem->version }}</p>
                                @endif
                                @if($fileItem->search_terms)
                                    <p class="detail-label">SEARCH TERMS</p>
                                    <p class="detail">{{ $fileItem->search_terms }}</p>
                                @endif

                            </div>
                            <div class="col-xs-12 div col-md-6">
                                <p class="detail-label">DOWNLOADS</p>
                                <p class="detail">{{ $fileItem->download_number }}</p>
                                <p class="detail-label">REGION</p>
                                <p class="detail">{{ $region->country }}</p>
                                @if($fileItem->language)
                                    <p class="detail-label">LANGUAGE</p>
                                    <p class="detail">{{ $fileItem->language }}</p>
                                @endif
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    @stop

    @section('tab-footer')
        <div class="text-center similar-container">
            <hr>
            <h4>Similar Games</h4>

            <ul class="similar-results">
                <li><img src="/assets/frontend/images/sample-coverart.jpg" alt="" class="img-responsive"></li>
                <li><img src="/assets/frontend/images/sample-coverart.jpg" alt="" class="img-responsive"></li>
                <li><img src="/assets/frontend/images/sample-coverart.jpg" alt="" class="img-responsive"></li>
                <li><img src="/assets/frontend/images/sample-coverart.jpg" alt="" class="img-responsive"></li>
            </ul>
        </div>

    @stop

    @stop
