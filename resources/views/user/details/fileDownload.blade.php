
@extends('userLayout')

    @section('custom-css')
        <link rel="stylesheet" href="/assets/frontend/css/creditly.css">
    @stop

    @section('custom-js')
        <script src="/assets/frontend/js/creditly.js" type="text/javascript"></script>
        <!-- Responsive Tabs JS -->
        <script src="/assets/frontend/js/jquery.responsiveTabs.js" type="text/javascript"></script>
    @stop

    @section('content')
        <div class="container">
            <div class="inside">
                <div class="row">
                    <div class="col-xs-12 col-sm-10 col-sm-offset-1 search-page">


                        <div class="search-results">


                            <hr>


                            <div class="col-md-12 text-center">
                                <div class="col-xs-10 col-xs-offset-1">
                                    <h3>{{ $fileItem->title }} {{ ($region->country)? '(' . $region->country . ')' : '' }} {{ ($fileItem->language)? '(' . $fileItem->language . ')' : '' }}</h3>
                                    <p class="willstart">Your download will start in <span class="wait-time">60 Seconds</span>.<br>
                                        Downloads for unregistered users are limited to <strong>150/kbps</strong>.</p>
                                </div>
                            </div>
                            <hr>


                            <ul class="account-types">



                                <li>

                                    <table class="table table-striped text-center account-box standard">

                                        <tbody>
                                        <tr>
                                            <td class="plan-type">Standard</td>
                                        </tr>
                                        <tr><td class="plan-price"><span class="dollar-sign">$</span><span class="plan-price">39.99</span></td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">BUY NOW</a></td></tr>
                                        </tbody>
                                    </table>

                                </li>

                                <li class="active">

                                    <table class="table table-striped text-center account-box silver">
                                        <tbody><tr>
                                            <td class="plan-type">Silver</td>
                                        </tr>


                                        <tr><td class="plan-price"><span class="dollar-sign">$</span><span class="plan-price">39.99</span></td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">BUY NOW</a></td></tr>
                                        </tbody>
                                    </table>

                                </li>

                                <li>

                                    <table class="table table-striped text-center account-box gold">
                                        <tbody><tr>
                                            <td class="plan-type">Gold</td>
                                        </tr>


                                        <tr><td class="plan-price"><span class="dollar-sign">$</span><span class="plan-price">39.99</span></td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">BUY NOW</a></td></tr>
                                        </tbody>
                                    </table>

                                </li>

                                <li>

                                    <table class="table table-striped text-center account-box platinum">
                                        <tbody>
                                        <tr>
                                            <td class="plan-type">Platinum</td>
                                        </tr>

                                        <tr><td class="plan-price"><span class="dollar-sign">$</span><span class="plan-price">39.99</span></td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td>details</td></tr>
                                        <tr><td><a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">BUY NOW</a></td></tr>
                                        </tbody>
                                    </table>


                                </li>
                            </ul>

                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Credit Card Details</h4>
                                        </div>
                                        <div class="modal-body">

                                            <div>
                                                <h2 class="text-center"></h2>
                                                <!-- validator -->
                                                <section class="creditly-wrapper blue-theme">
                                                    <div class="credit-card-wrapper">
                                                        <div class="first-row form-group">
                                                            <div class="col-sm-8 controls">
                                                                <label class="control-label">Card Number</label>
                                                                <input class="number credit-card-number form-control"
                                                                       type="text" name="number"
                                                                       pattern="\d*"
                                                                       inputmode="numeric" autocomplete="cc-number" autocompletetype="cc-number" x-autocompletetype="cc-number"
                                                                       placeholder="&#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149; &#149;&#149;&#149;&#149;">
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <label class="control-label">CVV</label>
                                                                <input class="security-code form-control"·
                                                                       inputmode="numeric"
                                                                       pattern="\d*"
                                                                       type="text" name="security-code"
                                                                       placeholder="&#149;&#149;&#149;">
                                                            </div>
                                                        </div>
                                                        <div class="second-row form-group">
                                                            <div class="col-sm-8 controls">
                                                                <label class="control-label">Name on Card</label>
                                                                <input class="billing-address-name form-control"
                                                                       type="text" name="name"
                                                                       placeholder="John Smith">
                                                            </div>
                                                            <div class="col-sm-4 controls">
                                                                <label class="control-label">Expiration</label>
                                                                <input class="expiration-month-and-year form-control"
                                                                       type="text" name="expiration-month-and-year"
                                                                       placeholder="MM / YY">
                                                            </div>
                                                        </div>
                                                        <div class="card-type">
                                                        </div>
                                                    </div>
                                                </section>
                                                <br><br>
                                                <p class="small"><em>Vivamus a commodo nisl. Donec facilisis est vitae sem ornare placerat. Pellentesque cursus mollis mauris, ut ullamcorper massa hendrerit et. Proin pulvinar, leo id fermentum efficitur, nisl purus gravida ex, at efficitur massa risus placerat augue.</em></p>

                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">SUBSCRIBE</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <br>
                            <hr>
                            <br>


                        </div>
                    </div>



                </div>
            </div>
        </div>
        </div>
    @stop

    @section('custom-script')
        <script type="text/javascript">
            $(document).ready(function () {
                var $tabs = $('#horizontalTab');
                $tabs.responsiveTabs({
                    rotate: false,
                    startCollapsed: 'accordion',
                    collapsible: 'accordion',
                    setHash: true,
                    activate: function(e, tab) {
                        $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
                    },
                    activateState: function(e, state) {
                        //console.log(state);
                        $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
                    }
                });

            });
            $( ".search-toggle" ).click(function() {
                $( ".small-search-input" ).fadeToggle( 0, function() {
                    // Animation complete.
                });
            });
        </script>
    @stop

    @stop
