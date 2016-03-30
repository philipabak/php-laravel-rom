
@extends('user.profile.profileLayout')

    @section('tab-content')
        <style>
            .row{
                margin-right: -10px;!important;
            }
        </style>

        <div>
            <div class="row">
                <div class="col-xs-12 profile-page">

                    <div class="row">
                        <div class="col-xs-8 col-sm-2">
                            <div class="photo-container" id="images">
                                <img src="/assets/backend/img/avatars/{{ $userItem->photo }}" alt="" class="img-responsive">
                            </div>
                            <form class="register-form" action="{{ URL::route('user.user.uploadAccountImage') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8" novalidate="novalidate">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <div class="form-group" style="margin-top: 60px;">
                                    <div class="input-icon">
                                        <input type="file" name="avtar" class="upload" id="member_photo_upload" title="Select Your Profile Image">
                                        <input type="submit" class="btn btn-primary" value="Upload Image" style="margin-top: 10px;">
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-xs-12 col-sm-3">
                            <h2>{{ $userItem->username }}</h2><p>{{ $userItem->email }}</p><span class="membersince">{{ $userItem->role }} Since {{ $userItem->created_at->format('Y/m/d') }}</span>
                            <div class="points-counter">
                                <span><i class="fa fa-gamepad"></i> {{ $userItem->points }}</span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-7">
                            <form class="form-horizontal" action="{{ URL::route('user.profile.updateProfileInforms') }}" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                <div class="form-group align-left">
                                    <label for="inputEmail3" class="col-sm-3 control-label"><i class="fa fa-envelope"></i> Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" name="email" class="form-control email" id="inputEmail3" placeholder="Change Email" required="required">
                                    </div>
                                </div>
                                <div class="form-group align-left">
                                    <label for="inputPassword3" class="col-sm-3 control-label"><i class="fa fa-lock"></i> Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" class="form-control pas1" id="inputPassword3" placeholder="Change Password" required="required">
                                    </div>
                                </div>
                                <div class="form-group align-left">
                                    <label for="inputPassword4" class="col-sm-3 control-label"></i> Re-type</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control pas2" id="inputPassword4" placeholder="Retype Password">
                                        <span id="yError" style="color:red; display:block;"></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-3">
                                        <button type="submit" class="btn btn-default" id="update1">Update</button>
                                    </div>
                                    <div class="col-sm-5">
                                        <span style="color:green;display:block">
                                            @if(isset($message) && $message != '')
                                                {{ $message }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-4">
                            <h3 class="subsection-title">
                                <i class="fa fa-download"></i> Added to Download List
                            </h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Size</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($downloadList as $item)
                                    <tr>
                                        <th scope="row">{{ $item->title }}</th>
                                        <td><span class="download-size">{{ ($item->size / 1024 / 1024 > 0.1)? number_format($item->size / 1024 / 1024, 1) . 'MB' : number_format($item->size / 1024, 1) . 'KB' }}</span></td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <div class="col-md-4">
                            <h3 class="subsection-title">
                                <i class="fa fa-history"></i> Download History
                            </h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Size</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($downloadHistoryList as $item)
                                    <tr>
                                        <th scope="row">{{ $item->title }}</th>
                                        <td><span class="download-size">{{ ($item->size / 1024 / 1024 > 0.1)? number_format($item->size / 1024 / 1024, 1) . 'MB' : number_format($item->size / 1024, 1) . 'KB' }}</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <h3 class="subsection-title">
                                <i class="fa fa-money"></i> Purchase History
                            </h3>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>QTY</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($purchaseHistoryList as $item)
                                    <tr>
                                        <th scope="row">{{ $item->title }}</th>
                                        <td><span class="download-size">${{ number_format($item->price, 2) }}</span></td>
                                        <td>{{ $item->quantity }}</td>
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

@stop
