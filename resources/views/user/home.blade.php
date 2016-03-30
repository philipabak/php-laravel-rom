
@extends('userLayout')

    @section('content')
        <div class="container home">
            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
                <div class="row">
                    <div class="col-xs-12 text-center">
                        <img src="/assets/frontend/images/logo-romU.png" alt="" class="main-logo">
                        <p class="intro-text">the best <span>rom</span> repository in the universe.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="home-search-container">
                            <input type="text" class="home-search" placeholder="What are you looking for?">
                            <img src="/assets/frontend/images/bg-magnify.png" alt="" class="bg-magnify">
                            <a href="#"><img class="bg-help" src="/assets/frontend/images/bg-help.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @stop

@stop
