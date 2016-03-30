
@extends('userLayout')

    @section('custom-js')
        <!-- Responsive Tabs JS -->
        <script src="/assets/frontend/js/jquery.responsiveTabs.js" type="text/javascript"></script>

    @stop

    @section('content')
        <div class="container">
            <div class="inside">
                <div class="row">
                    <div class="col-xs-10 col-xs-offset-1 search-page">

                        <div class="col-xs-12">
                            <div class="home-search-container">
                                <input type="text" class="home-search" id="search_text" placeholder="Search" value="{{ str_replace('-', ' ', $keyword) }}">
                                <a href="javascript:;" onclick="search_files();"><img src="/assets/frontend/images/bg-magnify.png" alt="" class="bg-magnify hidden-xs hidden-sm"></a>
                            </div>
                        </div>

                        <div class="search-results">
                            <h2>Search Results</h2>
                            <hr>

                            <div class="results-table">
                                @if($fileList)
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>TITLE</th>
                                        <th>FILE SIZE</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($fileList as $item)
                                        <tr>
                                            <th scope="row"><a href="{{ URL::route('user.details.details', array($item->parent_slug, $item->category_slug, $item->slug, 'details')) }}" class="file_title">{{ $item->title }}</a></th>
                                            <td>{{ ($item->file_size / 1024 / 1024 > 0.1)? number_format($item->file_size / 1024 / 1024, 1) . 'MB' : number_format($item->file_size / 1024, 1) . 'KB' }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <hr>

                                <div class="page-control text-center">
                                    <?php echo $fileList->render(); ?>
                                </div>
                            @endif
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
                $( ".small-search-input" ).fadeToggle( "slow", function() {
                    // Animation complete.
                });
            });

            function search_files(){
                var keyword = $('#search_text').val();
                keyword = keyword.replace(' ', '-');
                keyword = keyword.replace('.', '');
                keyword = keyword.replace(',', '');
//                keyword = keyword.replace(/[^\w\s]/gi, '');
                if(!keyword){
                    bootbox.alert("Please insert valid search keyword.");
                    $('#search_text').val('');
                    return false;
                }
                var url = '/searchResult/' + keyword;
                location.href = url;
            }

        </script>
    @stop

    @stop
