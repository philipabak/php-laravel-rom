<!DOCTYPE html>
<html>
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="AdminDesigns">
    <title>{{ $title }}</title>

    <!-- Font CSS (Via CDN) -->
    <link rel='stylesheet' type='text/css' href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' type='text/css' href='/assets/backend/bootstrap/css/bootstrap.min.css'>

    <!-- Theme CSS -->
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/vendor.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/theme.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/utility.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/css/custom.css'>
    <link rel='stylesheet' type='text/css' href='/assets/backend/fonts/icomoon/icomoon.min.css'>

    @yield('custom-css')

    <!-- Favicon -->
    <link rel="shortcut icon" href="/assets/backend/img/favicon.ico">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Google Map API -->
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="/assets/backend/jquery/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="/assets/backend/jquery/jquery_ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="/assets/backend/bootstrap/js/bootstrap.min.js"></script>

    <!-- Theme Javascript -->
    <script type="text/javascript" src="/assets/backend/utility/spin.min.js"></script>
    <script type="text/javascript" src="/assets/backend/utility/underscore-min.js"></script>
    <script type="text/javascript" src="/assets/backend/js/ajax.js"></script>
    <script type="text/javascript" src="/assets/backend/js/main.js"></script>
    <script type="text/javascript" src="/assets/backend/js/custom.js"></script>
    <script type="text/javascript" src="/assets/backend/backstretch/jquery.backstretch.min.js"></script>

    <script type="text/javascript">
        //<![CDATA[
        var Shop = {"basePath":"\/","params":{"controller":"users","action":"admin_dashboard"}};
        //]]>
    </script>

    @yield('custom-js')

    </head>

    <body>

        <!-- Start: Header -->
        <header class="navbar navbar-fixed-top">
            <div class="navbar-branding">
                <span id="toggle_sidemenu_l" class="glyphicons glyphicons-show_lines"></span>
                <a href="{{ URL::route('admin.dashboard.index') }}" class="navbar-brand">
                    <img src="/assets/backend/img/logos/logo.png" alt="logo">
                </a>
            </div>

            <div class="navbar-left">
                <div class="navbar-divider"></div>
                <div id="settings_menu">
                    <span class="glyphicons glyphicons-settings dropdown-toggle cursor" data-toggle="dropdown"></span>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ URL::route('admin.dashboard.viewProfile') }}">
                                <span class="glyphicons glyphicons-user text-red2 mr15"></span>
                                Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('admin.dashboard.changePassword') }}">
                                <span class="glyphicons glyphicons-unlock text-purple2 mr15"></span>
                                Change Password
                            </a>
                        </li>
                        <li>
                            <a href="{{ URL::route('admin.dashboard.screenLock') }}">
                                <span class="glyphicons glyphicons-lock text-grey2 mr15"></span>
                                Screen Lock
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="navbar-right">
                <div class="navbar-menus">
                    <div class="btn-group" id="alert_menu">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons glyphicons-bell"></span> <b>3</b> </button>
                        <ul class="dropdown-menu media-list" role="menu">
                            <li class="dropdown-header">Recent Alerts<span class="pull-right glyphicons glyphicons-bell"></span></li>
                            <li class="p15 pb10">
                                <ul class="list-unstyled">
                                    <li><span class="glyphicons glyphicons-bell text-orange2 fs16 mr15"></span><b>CEO</b> lunch meeting Tuesday</li>
                                    <li class="pt10"><span class="glyphicons glyphicons-facebook text-blue2 fs16 mr15"></span>Facebook likes are at <b>4,100</b></li>
                                    <li class="pt10"><span class="glyphicons glyphicons-paperclip text-teal2 fs16 mr15"></span>Mark <b>uploaded</b> 3 new Docs</li>
                                    <li class="pt10"><span class="glyphicons glyphicons-gift text-purple2 fs16 mr15"></span>It's <b>Marks</b> 34th Birthday</li>
                                    <li class="pt10"><span class="glyphicons glyphicons-cup text-red2 fs16 mr15"></span>Best new employee awarded to <b>Jessica</b></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group" id="comment_menu">
                        <button type="button" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicons glyphicons-display"></span> <b>7</b> </button>
                        <div class="dropdown-menu" role="menu">
                            <ul class="nav nav-tabs tabs-border-bottom" role="tablist">
                                <li class="active"><a href="#header_tab1" role="tab" data-toggle="tab">Messages</a></li>
                                <li><a href="#header_tab2" role="tab" data-toggle="tab">Tickets</a></li>
                                <li><a href="#header_tab3" role="tab" data-toggle="tab">Todo List</a></li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content pn border-none dropdown-persist">
                                <div class="tab-pane active" id="header_tab1">
                                    <div class="dropdown-submenu dropdown-persist">
                                        <div class="row">
                                            <div class="col-xs-8">
                                                <input class="dropdownSearch" type="text" placeholder="Search...">
                                            </div>
                                            <div class="col-xs-4">
                                                <div class="cBox cBox-inline ml20">
                                                    <input type="checkbox" id="headercBox1" name="check" value="None"/>
                                                    <label for="headercBox1">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p15">
                                        <div class="media border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded" src="" alt="..."> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading mbn">Simon Rivers <small class="text-light5"> - 3 hours ago</small></h5>
                                                <p class="text-muted"> Hey Louis, I was wondering if</p>
                                            </div>
                                        </div>
                                        <div class="media mt10 border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded border-online" src="" alt="..."> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading mbn">Tracy Rope <small class="text-light5"> - 8 hours ago</small></h5>
                                                <p class="text-muted"> Bam baby get at, I was</p>
                                            </div>
                                        </div>
                                        <div class="media mt10 border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded border-online" src="" alt="..."> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading mbn">Courtney Dash <small class="text-light5"> - 3 days ago</small></h5>
                                                <p class="text-muted"> I was wonde awesome brief </p>
                                            </div>
                                        </div>
                                        <div class="media mt10 border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded border-light5" src="" alt="..."> </a>
                                            <div class="media-body">
                                                <h5 class="media-heading mbn">Simon Rivers <small class="text-light5"> - 3 hours ago</small></h5>
                                                <p class="text-muted mbn"> Hey Louis, I was wondering </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="header_tab2">
                                    <div class="dropdown-submenu dropdown-persist">
                                        <div class="cBox cBox-inline cBox-orange ml15 p1">
                                            <input type="checkbox" id="headercBox2" name="check" value="None"/>
                                            <label for="headercBox2">Closed</label>
                                        </div>
                                        <div class="cBox cBox-inline cBox-purple">
                                            <input type="checkbox" id="headercBox3" name="check" value="None"/>
                                            <label for="headercBox3">Low</label>
                                        </div>
                                        <div class="cBox cBox-inline cBox-blue">
                                            <input type="checkbox" id="headercBox4" name="check" value="None"/>
                                            <label for="headercBox4">Med</label>
                                        </div>
                                        <div class="cBox cBox-inline cBox-red2 cBox-gradient">
                                            <input type="checkbox" id="headercBox5" name="check" value="None" checked/>
                                            <label for="headercBox5">Urgent</label>
                                        </div>
                                    </div>
                                    <div class="sortable mt10 mb10">
                                        <div class="todo-item table-layout p8">
                                            <div class="todo-handle va-m">
                                                <div class="v-handle"></div>
                                            </div>
                                            <div class="todo-body va-m"><b class="text-muted">[Ticket #1]</b> - Validation Errors <small class="text-blue2"> [read more..]</small></div>
                                        </div>
                                        <div class="todo-item table-layout p8">
                                            <div class="todo-handle va-m">
                                                <div class="v-handle"></div>
                                            </div>
                                            <div class="todo-body va-m"><b class="text-muted">[Ticket #2]</b> - User Profile Debug<small class="text-blue2"> [read more..]</small></div>
                                        </div>
                                        <div class="todo-item table-layout p8">
                                            <div class="todo-handle va-m">
                                                <div class="v-handle"></div>
                                            </div>
                                            <div class="todo-body va-m"><b class="text-muted">[Ticket #3]</b> - User hacked <small class="text-blue2"> [read more..]</small></div>
                                        </div>
                                        <div class="todo-item table-layout p8">
                                            <div class="todo-handle va-m">
                                                <div class="v-handle"></div>
                                            </div>
                                            <div class="todo-body va-m"><b class="text-muted">[Ticket #4]</b> - Mailbox Debug <small class="text-blue2"> [read more..]</small></div>
                                        </div>
                                        <div class="todo-item table-layout p8">
                                            <div class="todo-handle va-m">
                                                <div class="v-handle"></div>
                                            </div>
                                            <div class="todo-body va-m"><b class="text-muted">[Ticket #5]</b> - User Profile Debug<small class="text-blue2"> [read more..]</small></div>
                                        </div>
                                        <div class="todo-item table-layout p8">
                                            <div class="todo-handle va-m">
                                                <div class="v-handle"></div>
                                            </div>
                                            <div class="todo-body va-m"><b class="text-muted">[Ticket #6]</b> - User Profile Debug<small class="text-blue2"> [read more..]</small></div>
                                        </div>
                                        <div class="todo-item table-layout p8">
                                            <div class="todo-handle va-m">
                                                <div class="v-handle"></div>
                                            </div>
                                            <div class="todo-body va-m"><b class="text-muted">[Ticket #7]</b> - User Profile Debug<small class="text-blue2"> [read more..]</small></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="header_tab3">
                                    <div class="dropdown-submenu dropdown-persist">
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <input class="dropdownSearch" type="text" placeholder="Create New Item...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ticket-item table-layout">
                                        <div class="ticket-handle va-m">
                                            <div class="cBox ml10">
                                                <input type="checkbox" id="headercBox7" name="check" value="None"/>
                                                <label for="headercBox7"></label>
                                            </div>
                                        </div>
                                        <div class="ticket-body p10 va-m"><b class="text-muted">[#2]</b> - IE8 Profile Drag Errors <span class="label label-sm bg-grey2 ml10">Javascript</span></div>
                                    </div>
                                    <div class="ticket-item table-layout">
                                        <div class="ticket-handle va-m">
                                            <div class="cBox ml10">
                                                <input type="checkbox" id="headercBox6" name="check" value="None"/>
                                                <label for="headercBox6"></label>
                                            </div>
                                        </div>
                                        <div class="ticket-body p10 va-m"><b class="text-muted">[#1]</b> - Validation Errors on USCM testing facitiliy <small class="text-red2">- Urgent</small></div>
                                    </div>
                                    <div class="ticket-item table-layout">
                                        <div class="ticket-handle va-m">
                                            <div class="cBox ml10">
                                                <input type="checkbox" id="headercBox9" name="check" value="None"/>
                                                <label for="headercBox9"></label>
                                            </div>
                                        </div>
                                        <div class="ticket-body p10 va-m"><b class="text-muted">[#4]</b> - CSS Problems with Tables <span class="label label-sm bg-orange2 ml10">CSS</span></div>
                                    </div>
                                    <div class="ticket-item table-layout">
                                        <div class="ticket-handle va-m">
                                            <div class="cBox ml10">
                                                <input type="checkbox" id="headercBox10" name="check" value="None"/>
                                                <label for="headercBox10"></label>
                                            </div>
                                        </div>
                                        <div class="ticket-body p10 va-m"><b class="text-muted">[#5]</b> - PHP Form validation errors occuring on email page<span class="label label-sm bg-purple2 ml10">PHP</span></div>
                                    </div>
                                    <div class="ticket-item table-layout">
                                        <div class="ticket-handle va-m">
                                            <div class="cBox ml10">
                                                <input type="checkbox" id="headercBox8" name="check" value="None"/>
                                                <label for="headercBox8"></label>
                                            </div>
                                        </div>
                                        <div class="ticket-body p10 pb15 va-m"><b class="text-muted">[#3]</b> - Mailbox Validation Errors on Firefox</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="btn-group" id="toggle_sidemenu_r">
                        <button type="button"> <span class="glyphicons glyphicons-parents"></span> </button>
                    </div>
                </div>
            </div>
        </header>

    <div id="main">

        <!-- Start: Sidebar -->
        <aside id="sidebar_left">
            <div class="user-info">
                <h5 class="media-heading mt5 mbn fw700 cursor"><?php echo (Session::get('user_id')==1)? 'Super Admin' : 'Administrator'; ?> Profile</h5>
                <div class="media">
                    <a class="pull-left">
                        <div class="media-object border border-purple br64 bw2 p2">
                            <img src="/assets/backend/img/avatars/admin.jpg" class="br64" alt="">
                        </div>
                    </a>
                    <div class="mobile-link">
                        <span class="glyphicons glyphicons-show_big_thumbnails"></span>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading mt5 mbn fw700 cursor"><?php echo Session::get('first_name') . ' ' . Session::get('last_name'); ?>
                            <span class="caret ml5"></span>
                        </h5>
                        <div class="media-links fs11">
                            <a>Menu</a>
                            <i class="fa fa-circle text-muted fs3 p8 va-m"></i>
                            <a href="{{ URL::route('admin.dashboard.logout') }}">(Sign Out)</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="user-divider"></div>

            <div class="user-menu">
                <div class="row text-center mb15">
                    <div class="col-xs-4">
                        <a href="{{ URL::route('admin.dashboard.index') }}">
                            <span class="glyphicons glyphicons-home fs22 text-blue2"></span>
                            <h5 class="fs11">Home</h5>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="messages.html">
                            <span class="glyphicons glyphicons-inbox fs22 text-orange2"></span>
                            <h5 class="fs11">Inbox</h5>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="{{ URL::route('admin.dashboard.viewProfile') }}">
                            <span class="glyphicons glyphicons-user fs22 text-purple2"></span>
                            <h5 class="fs11">Profile</h5>
                        </a>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-xs-4 text-center">
                        <a href="{{ URL::route('admin.dashboard.changePassword') }}">
                            <span class="glyphicons glyphicons-unlock fs22 text-grey3"></span>
                            <h5 class="fs11">Change Password</h5>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="profile.html">
                            <span class="glyphicons glyphicons-blog fs22 text-green2"></span>
                            <h5 class="fs11">Blog</h5>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="gallery.html">
                            <span class="glyphicons glyphicons-picture fs22 text-light6"></span>
                            <h5 class="fs11">Gallery</h5>
                        </a>
                    </div>
                </div>
            </div>

            <div class="sidebar-menu">
                <ul class="nav">
                    <li>
                        <a href="{{ URL::route('admin.dashboard.index') }}">
                            <span class="glyphicons glyphicons-home"></span>
                            <span class="sidebar-title">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#sideSeven">
                            <span class="imoon imoon-mail"></span>
                            <span class="sidebar-title">Messages</span>
                            <span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.messages.inbox') }}">
                                    <span class="glyphicons glyphicons-inbox"></span>
                                    <span class="sidebar-title">Inbox</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.messages.sentMail') }}">
                                    <span class="glyphicon glyphicon-send"></span>
                                    <span class="sidebar-title">Sent Mail</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.messages.trash') }}">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    <span class="sidebar-title">Trash</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a class="accordion-toggle" href="#sideSeven">
                            <span class="glyphicons glyphicons-group"></span>
                            <span class="sidebar-title">Users</span><span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.users.addUser') }}">
                                    <span class="glyphicons glyphicons glyphicons-user_add"></span>
                                    Add New user
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.users.manageUser') }}">
                                    <span class="glyphicons glyphicons-user"></span>
                                    Manage Users
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#sideSeven">
                            <span class="glyphicons glyphicons-nameplate_alt"></span>
                            <span class="sidebar-title">Files List</span>
                            <span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.files.addFile') }}">
                                    <span class="glyphicons glyphicons glyphicons-circle_plus"></span>
                                    Add New File
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.files.manageFile') }}">
                                    <span class="glyphicons glyphicons-edit"></span>
                                    Manage Files
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#">
                            <span class="glyphicons glyphicons-show_thumbnails_with_lines"></span>
                            <span class="sidebar-title">Categories</span>
                            <span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.categories.addCategory') }}" class="publish_all">
                                    <span class="glyphicons glyphicons glyphicons-circle_plus"></span>
                                    Add New
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.categories.manageCategory') }}">
                                    <span class="glyphicons glyphicons-edit"></span>
                                    Manage Category
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#sideSeven">
                            <span class="glyphicons glyphicons-book_open"></span>
                            <span class="sidebar-title">CMS Pages</span>
                            <span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.pages.addPage') }}" class="publish_all">
                                    <span class="glyphicons glyphicons glyphicons-circle_plus"></span>
                                    Add New Page
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.pages.managePage') }}">
                                    <span class="glyphicons glyphicons-edit"></span>
                                    Manage pages
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#sideSeven">
                            <span class="imoon imoon-newspaper"></span>
                            <span class="sidebar-title">News</span>
                            <span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.news.addNews') }}" class="publish_all">
                                    <span class="glyphicons glyphicons glyphicons-circle_plus"></span>
                                    Add News
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.news.manageNews') }}">
                                    <span class="glyphicons glyphicons-edit"></span>
                                    Manage News
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ URL::route('admin.advertisement.index') }}">
                            <span class="glyphicons glyphicons-projector"></span>
                            <span class="sidebar-title">Advertisement</span>
                        </a>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#sideSeven">
                            <span class="imoon imoon-newspaper"></span>
                            <span class="sidebar-title">Premium Memberships</span>
                            <span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.memberships.addMembership') }}" class="publish_all">
                                    <span class="glyphicons glyphicons glyphicons-circle_plus"></span>
                                    Add Membership
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.memberships.manageMembership') }}">
                                    <span class="glyphicons glyphicons-edit"></span>
                                    Manage Membership
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="accordion-toggle" href="#sideSeven">
                            <span class="imoon imoon-newspaper"></span>
                            <span class="sidebar-title">User Group</span>
                            <span class="caret"></span>
                        </a>
                        <ul id="sideSeven" class="nav sub-nav">
                            <li>
                                <a href="{{ URL::route('admin.usergroups.addUsergroup') }}" class="publish_all">
                                    <span class="glyphicons glyphicons glyphicons-circle_plus"></span>
                                    Add Usergroup
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.usergroups.manageUsergroup') }}">
                                    <span class="glyphicons glyphicons-edit"></span>
                                    Manage Usergroup
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>


        <!-- Start: Content -->
        <section id="content_wrapper">
            @if(isset($message) && $message != '')
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $message }}
            </div>
            @endif

            @yield('content')

        </section>

        <!-- Start: Right Sidebar -->
        <aside id="sidebar_right">
            <div class="sidebar-right-header">
                <div class="pull-right posr">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-circle text-orange2 fs8"></i> <span class="caret text-muted"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-sm" role="menu">
                        <li class="menu-arrow">
                            <div class="menu-arrow-up"></div>
                        </li>
                        <li><a href="javascript:void(0);"><i class="fa fa-circle text-green2 pr5"></i> Online</a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-circle text-red2 pr5"></i> Busy</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-circle text-orange2 pr5"></i> Away</a></li>
                    </ul>
                </div>
                <div class="media mtn">
                    <a class="pull-left mt5" href="#"> <img class="thumbnail thumbnail-sm rounded" src="" alt="..."> </a>
                    <div class="media-body">
                        <h5 class="small mt5 mbn text-cloud"><b>Current Status:</b></h5>
                        <h5 class="small text-white"><b>"Away: Lunch meeting"</b></h5>
                    </div>
                </div>
            </div>
            <div class="sidebar_right_content p25">
                <div class="sidebar_right_menu row text-center">
                    <div class="col-xs-4 pln">
                        <a href="calendar.html"> <span class="glyphicons glyphicons-imac fs22 text-grey2"></span>
                            <h5 class="fs11 text-white">Calendar</h5>
                        </a>
                    </div>
                    <div class="col-xs-4">
                        <a href="profile.html"> <span class="glyphicons glyphicons-settings fs22 text-green"></span>
                            <h5 class="fs11 text-white">Settings</h5>
                        </a>
                    </div>
                    <div class="col-xs-4 prn">
                        <a href="messages.html"> <span class="glyphicons glyphicons-inbox fs22 text-orange"></span>
                            <h5 class="fs11 text-white">Inbox</h5>
                        </a>
                    </div>
                </div>
                <hr class="mb25 mtn border-dark3"/>
                <h5 class="text-muted fs13 mb25">Notes</h5>
                <h5 class="text-white mbn">9:30 AM - Ford Pitch</h5>
                <p class="text-light6 fs12 fw600 mb15">Client expects a working draft</p>
                <h5 class="text-white mbn">12:15 AM - Lunch Meeting</h5>
                <p class="text-light6 fs12 fw600 mb15">To discuss Ford Pitch outcome</p>
                <h5 class="text-white mbn">2:30 AM - Computer Repair</h5>
                <p class="text-light6 fs12 fw600 mb15">Coming to replace failing HD </p>
                <h5 class="text-white mbn">4:15 AM - First Yoga Class</h5>
                <p class="text-light6 fs12 fw600">Ask about your free classes</p>
                <hr class="mb25 mt25 border-dark3"/>
                <h5 class="text-muted fs13 pull-left mr20">Users</h5>
                <div class="btn-group pull-left">
                    <button type="button" class="btn btn-gradient btn-xs bg-blue7-alt dropdown-toggle fs11 fw600" data-toggle="dropdown"><i class="fa fa-circle text-green2 fs8 pr5"></i> Online <span class="caret caret-sm ml5"></span> </button>
                    <ul class="dropdown-menu dropdown-sm" role="menu">
                        <li class="menu-arrow">
                            <div class="menu-arrow-up"></div>
                        </li>
                        <li><a href="javascript:void(0);"><i class="fa fa-circle text-green2 pr5"></i> Online</a></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-circle text-red2 pr5"></i> Busy</a></li>
                        <li class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="fa fa-circle text-orange2 pr5"></i> Away</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
                <div class="media mt30 border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded" src="" alt="..."> </a>
                    <div class="media-body">
                        <h5 class="media-heading text-white mbn">Simon Rivers</h5>
                        <p class="text-muted fs12"> What's up, buddy</p>
                    </div>
                </div>
                <div class="media border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded" src="" alt="..."> </a>
                    <div class="media-body">
                        <h5 class="media-heading text-white mbn">Eric Ulrich</h5>
                        <p class="text-muted fs12"> Client Problem pg.14</p>
                    </div>
                </div>
                <div class="media border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded" src="" alt="..."> </a>
                    <div class="media-body">
                        <h5 class="media-heading text-white mbn">Hershel Sandin</h5>
                        <p class="text-muted fs12"> Looking for an intern?</p>
                    </div>
                </div>
                <div class="media border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded" src="" alt="..."> </a>
                    <div class="media-body">
                        <h5 class="media-heading text-white mbn">Jacob Hill</h5>
                        <p class="text-muted fs12"> Lunch meeting tomorrow.</p>
                    </div>
                </div>
                <div class="media border-none"> <a class="pull-left" href="#"> <img class="media-object thumbnail thumbnail-sm rounded" src="" alt="..."> </a>
                    <div class="media-body">
                        <h5 class="media-heading text-white mbn">Dante Harper</h5>
                        <p class="text-muted fs12"> I have a new twitter!</p>
                    </div>
                </div>
            </div>
        </aside>

    </div>

        @yield('admin-footer')

    <script>
        $(document).ready(function(){
            $(".alert-success").delay(10000)
                .fadeOut("slow", function () {
                    $(".alert-success").remove();
                });
        });
    </script>

    @yield('custom-script')

    </body>
</html>
