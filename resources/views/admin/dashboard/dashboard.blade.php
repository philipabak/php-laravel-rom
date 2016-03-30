
@extends('adminLayout')

    @section('custom-js')

        <!-- Page Plugins -->
        <script type="text/javascript" src="/assets/backend/plugins/raphael/raphael.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/morris/morris.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/datatables/js/datatables.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/jvectormap/jquery-jvectormap.min.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/clndr/clndr.js"></script>
        <script type="text/javascript" src="/assets/backend/plugins/clndr/moment.js"></script>

        <!-- Flot Plugins -->
        <script type="text/javascript" src="/assets/backend/plugins/jqueryflot/jquery.flot.min.js"></script>

    @stop

    @section('content')

        <!--main content start-->
        <div id="topbar">
            <div class="topbar-left">
                <ol class="breadcrumb">
                    <li class="crumb-active">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Dashboard</a>
                    </li>
                    <li class="crumb-icon">
                        <a href="{{ URL::route('admin.dashboard.index') }}"><span class="glyphicon glyphicon-home"></span></a>
                    </li>
                    <li class="crumb-link">
                        <a href="{{ URL::route('admin.dashboard.index') }}">Home</a>
                    </li>
                    <li class="crumb-trail">Dashboard</li>
                </ol>
            </div>
            <div class="topbar-right">
                <div class="dashboard-widget-tray">
                    <button type="button" class="btn btn-default btn-gradient btn-sm br4">Widgets</button>
                </div>
            </div>
        </div>

        <div id="content">
            <div id="widget-dropdown" class="row">
                <div class="col-sm-3">
                    <div class="panel panel-overflow mb10">
                        <div class="panel-body pn pl20">
                            <div class="icon-bg"><i class="fa fa-envelope text-grey"></i></div>
                            <h2 class="mt15 lh15 text-grey2"><b>728</b></h2>
                            <h5 class="text-muted">Connections</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-overflow mb10">
                        <div class="panel-body pn pl20">
                            <div class="icon-bg"><i class="fa fa-bar-chart-o text-teal"></i></div>
                            <h2 class="mt15 lh15 text-teal2"><b>267</b></h2>
                            <h5 class="text-muted">Reach</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-overflow mb10">
                        <div class="panel-body pn pl20">
                            <div class="icon-bg"><i class="fa fa-comments-o text-blue"></i></div>
                            <h2 class="mt15 lh15 text-blue2"><b>523</b></h2>
                            <h5 class="text-muted">Comments</h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="panel panel-overflow mb10">
                        <div class="panel-body pn pl20">
                            <div class="icon-bg"><i class="fa fa-twitter text-purple"></i></div>
                            <h2 class="mt15 lh15 text-purple2"><b>348</b></h2>
                            <h5 class="text-muted">Tweets</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading"> <span class="panel-title"><i class="fa fa-pencil"></i> Live Site Activity </span>
                            <ul class="nav panel-tabs">
                                <li class="active"><a href="#tab1" data-toggle="tab">New Users</a></li>
                                <li><a href="#tab2" data-toggle="tab">Orders</a></li>
                                <li><a href="#tab3" data-toggle="tab">Tickets</a></li>
                            </ul>
                        </div>
                        <div class="panel-body pn">
                            <div class="tab-content border-none pn">
                                <div id="tab1" class="tab-pane active p15">
                                    <div class="row">
                                        <div class="col-lg-8 pn">
                                            <div id="graph" style="height: 395px; width: 100%;"></div>
                                        </div>
                                        <div class="col-lg-4 visible-lg pl5">
                                            <h4 class="text-uppercase mbn"> Server Statistics </h4>
                                            <h6 class="mb15"> Summary of recent server events. </h6>
                                            <div class="small mb5"> Disk Usage (82.2%)</div>
                                            <div class="progress progress-sm mb10">
                                                <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 86%;"> <span class="sr-only">60% Complete</span> </div>
                                            </div>
                                            <div class="small mb5"> Disk Usage (82.2%)</div>
                                            <div class="progress progress-sm mb10">
                                                <div class="progress-bar progress-bar-orange" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"> <span class="sr-only">60% Complete</span> </div>
                                            </div>
                                            <div class="small mb5"> Disk Usage (82.2%)</div>
                                            <div class="progress progress-sm">
                                                <div class="progress-bar progress-bar-teal" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 24%"> <span class="sr-only">40% Complete (success)</span> </div>
                                            </div>
                                            <div class="btn-tray mt25 mb15">
                                                <h4 class="text-uppercase mbn hidden"> Map Events </h4>
                                                <h6 class="mb15 hidden"> Summary of locational sales. </h6>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-default btn-gradient btn-block btn-sm">USA</button>
                                                    </div>
                                                    <div class="col-md-4 pln prn">
                                                        <button type="button" class="btn btn-default btn-gradient btn-block btn-sm">Turkey</button>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="button" class="btn btn-default btn-gradient btn-block btn-sm">India</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="map1" class="jvector-simple" style="width: 100%; height: 155px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab2" class="tab-pane">
                                    <div class="table-layout">
                                        <div class="col-sm-3 va-t panel-sidemenu p25 border-right hidden-xs">
                                            <h4 class="mb25"> Social </h4>
                                            <div id="choices"></div>
                                            <div class="divider"></div>
                                            <ul class="list-unstyled fs12">
                                                <li class="text-muted"><span class="glyphicons glyphicons-facebook text-blue2 fs16 mr15"></span>27 <b>Likes</b> <small>- 1 Hours ago</small></li>
                                                <li class="pt5 text-muted"><span class="glyphicons glyphicons-twitter text-teal2 fs16 mr15"></span>14 <b>Tweets</b> <small>- 4 Hours ago</small></li>
                                                <li class="pt5 text-muted"><span class="glyphicons glyphicons-pinterest text-red2 fs16 mr15"></span>29 <b>Shares</b> <small>- 7 Hours ago</small></li>
                                                <li class="pt5 text-muted"><span class="glyphicons glyphicons-twitter text-teal2 fs16 mr15"></span>42 <b>Tweets</b> <small>- 8 Hours ago</small></li>
                                                <li class="pt5 text-muted"><span class="glyphicons glyphicons-instagram text-orange2 fs16 mr15"></span>16 <b>Comments</b> <small>- 12 Hours ago</small></li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-9 p20 pb35">
                                            <div class="chart-toggle" style="height: 365px; width: 100%;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab3" class="tab-pane p15">
                                    <table class="table table-widget table-striped table-checklist mt15" id="datatable">
                                        <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Progress</th>
                                            <th>Skills</th>
                                            <th>Notes</th>
                                            <th>Deadline</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-slash">Test Building presentation <b>Capacity</b></td>
                                            <td><div class="progress">
                                                    <div class="progress-bar progress-bar-purple" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%"><span class="sr-only">40% Complete (success)</span> </div>
                                                </div></td>
                                            <td><span class="label bg-grey2">Patience</span></td>
                                            <td class="text-slash text-muted"><small>400 people will attend</small></td>
                                            <td class="text-slash semi-bold">11/14/2013</td>
                                            <td class="text-right"><div class="cBox cBox-inline">
                                                    <input type="checkbox" id="tableBox" name="check" value="None"/>
                                                    <label for="tableBox"></label>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-slash">Write check to <b>Kids Hospital</b> for Holiday</td>
                                            <td><div class="progress">
                                                    <div class="progress-bar progress-bar-orange" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"><span class="sr-only">40% Complete (success)</span> </div>
                                                </div></td>
                                            <td><span class="label bg-blue">A Heart</span></td>
                                            <td class="text-slash text-muted"><small>Amount is still $4,500</small></td>
                                            <td class="text-slash semi-bold">11/14/2013</td>
                                            <td class="text-right"><div class="cBox cBox-inline">
                                                    <input type="checkbox" id="tableBox2" name="check" value="None"/>
                                                    <label for="tableBox2"></label>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-slash"><b>Upload</b> all 1400 Icons to Server</td>
                                            <td><div class="progress">
                                                    <div class="progress-bar progress-bar-teal" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"><span class="sr-only">80% Complete</span> </div>
                                                </div></td>
                                            <td><span class="label bg-orange">Python</span><span class="label bg-purple">DB</span></td>
                                            <td class="text-slash text-muted"><small>400 people will attend</small></td>
                                            <td class="text-slash semi-bold">11/14/2013</td>
                                            <td class="text-right"><div class="cBox cBox-inline">
                                                    <input type="checkbox" id="tableBox3" name="check" value="None"/>
                                                    <label for="tableBox3"></label>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-slash">Restyle <b>Themeforest</b> website design</td>
                                            <td><div class="progress">
                                                    <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 50%"><span class="sr-only">60% Complete (warning)</span> </div>
                                                </div></td>
                                            <td><span class="label bg-teal">CSS</span><span class="label bg-green">Html</span></td>
                                            <td class="text-slash text-muted"><small>400 people will attend</small></td>
                                            <td class="text-slash semi-bold">11/14/2013</td>
                                            <td class="text-right"><div class="cBox cBox-inline">
                                                    <input type="checkbox" id="tableBox4" name="check" value="None"/>
                                                    <label for="tableBox4"></label>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-slash">Write check to <b>Kids Hospital</b> for Holiday</td>
                                            <td><div class="progress">
                                                    <div class="progress-bar progress-bar-orange" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"><span class="sr-only">40% Complete (success)</span> </div>
                                                </div></td>
                                            <td><span class="label bg-blue">A Heart</span></td>
                                            <td class="text-slash text-muted"><small>Amount is still $4,500</small></td>
                                            <td class="text-slash semi-bold">11/14/2013</td>
                                            <td class="text-right"><div class="cBox cBox-inline">
                                                    <input type="checkbox" id="tableBox5" name="check" value="None"/>
                                                    <label for="tableBox5"></label>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-slash">Write check to <b>Kids Hospital</b> for Holiday</td>
                                            <td><div class="progress">
                                                    <div class="progress-bar progress-bar-orange" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"><span class="sr-only">40% Complete (success)</span> </div>
                                                </div></td>
                                            <td><span class="label bg-blue">A Heart</span></td>
                                            <td class="text-slash text-muted"><small>Amount is still $4,500</small></td>
                                            <td class="text-slash semi-bold">11/14/2013</td>
                                            <td class="text-right"><div class="cBox cBox-inline">
                                                    <input type="checkbox" id="tableBox6" name="check" value="None"/>
                                                    <label for="tableBox6"></label>
                                                </div></td>
                                        </tr>
                                        <tr>
                                            <td class="text-slash"><b>Upload</b> all 1400 Icons to Server</td>
                                            <td><div class="progress">
                                                    <div class="progress-bar progress-bar-teal" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"><span class="sr-only">80% Complete</span> </div>
                                                </div></td>
                                            <td><span class="label bg-orange">Python</span><span class="label bg-purple">DB</span></td>
                                            <td class="text-slash text-muted"><small>400 people will attend</small></td>
                                            <td class="text-slash semi-bold">11/14/2013</td>
                                            <td class="text-right"><div class="cBox cBox-inline">
                                                    <input type="checkbox" id="tableBox7" name="check" value="None"/>
                                                    <label for="tableBox7"></label>
                                                </div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-lg-3 visible-lg mt5">
                                    <div class="text-block text-center">
                                        <h5 class="mbn text-muted">This Years Total Sales</h5>
                                        <h4 class="mb5"><b>$1,532,512 </b></h4>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-9 mt5 pr25">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-3 text-center">
                                            <div class="media">
                                                <div class="media-object pull-left pt10 mrn"><span class="stateface stateface-ca fs26 text-purple"></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading mbn">San Jose, CA </h6>
                                                    <h5 class="mb5">$47,112</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-3 text-center">
                                            <div class="media">
                                                <div class="media-object pull-left pt10 mrn"><span class="stateface stateface-tx fs24 text-orange"></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading mbn">Denver, CO </h6>
                                                    <h5 class="mb5">$32,512</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-3 text-center">
                                            <div class="media">
                                                <div class="media-object pull-left pt10 mrn"><span class="stateface stateface-mo fs22 text-teal"></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading mbn">St. Louis, MO </h6>
                                                    <h5 class="mb5">$14,532</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6 col-sm-3 text-center prn">
                                            <div class="media">
                                                <div class="media-object pull-left pt10 mrn"><span class="stateface stateface-ny fs24 text-green2"></span></div>
                                                <div class="media-body">
                                                    <h6 class="media-heading mbn">New York, NY </h6>
                                                    <h5 class="mb5">$75,116</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

                // Dashboard Widgets Slidedown
                $('.dashboard-widget-tray .btn:first-child').on('click', function() {
                    $('#widget-dropdown').slideToggle('fast');
                });

                var runFlotChart = function () {

                    // Add a series of colors to be used in the charts and pie graphs
                    var Colors = [blueColor, purpleColor, orangeColor, greenColor, redColor, tealColor, yellowColor];

                    if ($(".chart-toggle").length) {

                        var datasets = {
                            "Facebook": {
                                label: "Facebook",
                                data: [[1, 40], [2, 8000], [3, 3400], [4, 6000], [5, 9100], [6, 43500], [7, 16000], [8, 2000], [9, 800], [10, 600]]
                            },
                            "Twitter": {
                                label: "Twitter",
                                data: [[1, 40], [2, 100], [3, 200], [4, 1000], [5, 11100], [6, 1500], [7, 2400], [8, 5000], [9, 12000], [10, 24000]]
                            },
                            "Pinterest": {
                                label: "Pinterest",
                                data: [[1, 40], [2, 7000], [3, 1700], [4, 15000], [5, 14400], [6, 9500], [7, 5600], [8, 700], [9, 800], [10, 400]]
                            },
                            "Instagram": {
                                label: "Instagram",
                                data: [[1, 16000], [2, 7000], [3, 200], [4, 3300], [5, 8000], [6, 500], [7, 600], [8, 3700], [9, 5800], [10, 2300]]
                            },
                        };

                        // hard-code color indices to prevent them from shifting as
                        // countries are turned on/off
                        var i = 0;
                        $.each(datasets, function(key, val) {
                            val.color = i;
                            ++i;
                        });

                        // insert checkboxes
                        var choiceContainer = $("#choices");
                        $.each(datasets, function(key, val) {
                            choiceContainer.append("<div class='cBox mt15 " + key.toLowerCase() +"-bg'><input type='checkbox' name='" + key + "' checked='checked' id='" + key + "'/> <label for='" + key + "'>" + val.label + "</label></div>");
                        });

                        choiceContainer.find("input").click(function() {
                            plotAccordingToChoices();
                        });

                        var plotAccordingToChoices = function() {
                            var data = [];
                            choiceContainer.find("input:checked").each(function () {
                                var key = $(this).attr("name");
                                if (key && datasets[key]) {
                                    data.push(datasets[key]);
                                }
                            });

                            if (data.length > 0) {
                                $.plot(".chart-toggle", data, {
                                    grid: {
                                        show: true,
                                        aboveData: true,
                                        color: "#3f3f3f",
                                        labelMargin: 5,
                                        axisMargin: 0,
                                        borderWidth: 0,
                                        borderColor: null,
                                        minBorderMargin: 5,
                                        clickable: true,
                                        hoverable: true,
                                        autoHighlight: true,
                                        mouseActiveRadius: 20
                                    },
                                    series: {
                                        lines: {
                                            show: true,
                                            fill: 0.5,
                                            lineWidth: 2,
                                            steps: false
                                        },
                                        points: {
                                            show: false
                                        }
                                    },
                                    yaxis: {
                                        min: 0
                                    },
                                    xaxis: {
                                        ticks: 11,
                                        tickDecimals: 0
                                    },
                                    colors: Colors,
                                    shadowSize: 1,
                                    tooltip: true,
                                    //activate tooltip
                                    tooltipOpts: {
                                        content: "%s : %y.0",
                                        shifts: {
                                            x: -30,
                                            y: -50
                                        }
                                    }
                                });
                            }
                        }
                        plotAccordingToChoices();
                    }
                };

                // Jvector Map Plugin
                var runJvectorMap = function () {
                    var mapData = [900, 700, 350, 500];
                    // Init Jvector Map
                    $('#map1').vectorMap({
                        map: 'us_lcc_en',
                        //regionsSelectable: true,
                        backgroundColor: '#FFF',
                        series: {
                            markers: [{
                                attribute: 'r',
                                scale: [3, 7],
                                values: mapData
                            }]
                        },
                        regionStyle: {
                            initial: {
                                fill: '#E5E5E5'
                            },
                            hover: {
                                "fill-opacity": 0.3
                            }
                        },
                        markers: [{
                            latLng: [37.78, -122.41],
                            name: 'San Francisco,CA'
                        }, {
                            latLng: [36.73, -103.98],
                            name: 'Texas,TX'
                        }, {
                            latLng: [38.62, -90.19],
                            name: 'St. Louis,MO'
                        }, {
                            latLng: [40.67, -73.94],
                            name: 'New York City,NY'
                        }],
                        markerStyle: {
                            initial: {
                                fill: '#a288d5',
                                stroke: '#b49ae0',
                                "fill-opacity": 1,
                                "stroke-width": 10,
                                "stroke-opacity": 0.3,
                                r: 3
                            },
                            hover: {
                                stroke: 'black',
                                "stroke-width": 2
                            },
                            selected: {
                                fill: 'blue'
                            },
                            selectedHover: {}
                        },
                    });


                    // Manual code to alter the Vector map plugin to
                    // allow for individual coloring of countries
                    var states = ['US-CA', 'US-TX', 'US-MO', 'US-NY'];
                    var colors = ['#e2ceeb', '#f1dccb', '#d7f0f0', '#b6e2a0'];
                    var colors2 = ['#c384dd', '#efac75', '#95e5e7', '#7ec35d'];
                    $.each(states, function (i, e) {
                        $("[data-code=" + e + "]").css({
                            fill: colors[i]
                        });
                    });
                    $('.jvector-simple').find('.jvectormap-marker').each(function (i, e) {
                        $(e).css({
                            fill: colors2[i],
                            stroke: colors2[i]
                        });
                    });
                }

                // Clndr Plugin
                var runClndr = function () {
                    // Init Clndr Widget (small calendar)
                    $('#clndr').clndr({
                        daysOfTheWeek: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
                    });
                }

                // Datatables Plugin
                var runDatatables = function () {
                    $('#datatable, #datatable_2').dataTable({
                        "bSort": true,
                        "bPaginate": false,
                        "bLengthChange": false,
                        "bFilter": false,
                        "bInfo": false,
                        "bAutoWidth": false,
                        "aoColumnDefs": [{
                            'bSortable': false,
                            'aTargets': [-1]
                        }]
                    });
                }

                // Morris Charts Plugin
                var runMorrisCharts = function () {
                    // Use Morris.Area instead of Morris.Line
                    Morris.Area({
                        element: 'graph',
                        data: [{
                            y: '2006',
                            a: 0,
                            b: 0,
                            c: 0
                        }, {
                            y: '2007',
                            a: 25,
                            b: 35,
                            c: 25
                        }, {
                            y: '2008',
                            a: 30,
                            b: 30,
                            c: 29
                        }, {
                            y: '2009',
                            a: 35,
                            b: 40,
                            c: 35
                        }, {
                            y: '2010',
                            a: 40,
                            b: 50,
                            c: 65
                        }, {
                            y: '2011',
                            a: 180,
                            b: 350,
                            c: 240
                        }, {
                            y: '2012',
                            a: 40,
                            b: 50,
                            c: 75
                        }, {
                            y: '2013',
                            a: 40,
                            b: 50,
                            c: 25
                        }, {
                            y: '2014',
                            a: 30,
                            b: 40,
                            c: 15
                        }, {
                            y: '2015',
                            a: 25,
                            b: 35,
                            c: 5
                        }, {
                            y: '2016',
                            a: 0,
                            b: 0,
                            c: 0
                        }],
                        xkey: 'y',
                        ykeys: ['a', 'b', 'c'],
                        labels: ['Series A', 'Series B', 'Series C'],
                        lineColors: [orangeColor, purpleColor, tealColor],
                    });
                }

                // Init Jquery Sortable
                $(".sortable").sortable();
                $(".sortable").disableSelection();

                // Init All Dashboard required Widgets
                runJvectorMap();
                runClndr();
                runDatatables();
                runMorrisCharts();

                //////////////////////////////////////
                // Responsive Dashboard Chart Helpers

                // Update chart size anytime the window is resized or when our primary
                // content container undergoes an animation(indicating a size change).
                $(window).resize(_.debounce(function(){
                    if  ($('#graph').length){
                        $('#graph').empty();
                        runMorrisCharts()
                    }
                    if  ($('.chart-toggle').length){
                        $('.chart-toggle').empty();
                        $('#choices').empty();
                        runFlotChart();
                    }
                }, 200));

                // When a panel tab is clicked check to see if the new tab contains a chart.
                // If it does we need to recreate it as the container size changes on tab show
                $('.panel-tabs li').on('click', function() {
                    var Graph1 = $($(this).find('a').attr('href')).find('.chart-toggle');
                    var Graph2 = $($(this).find('a').attr('href')).find('#graph');
                    if ($(Graph1).length) {
                        $(Graph1).empty();
                        $('#choices').empty();
                        var timeout = setTimeout(function() {
                            runFlotChart();
                        },100);
                    }
                    else if ($(Graph2).length) {
                        $(Graph2).empty();
                        $('#choices').empty();
                        var timeout = setTimeout(function() {
                            runMorrisCharts()
                        },100);
                    }
                });

                $('body').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(e) {
                    $('#graph').empty();
                    runMorrisCharts();
                });

            });
        </script>
    @stop
@stop
