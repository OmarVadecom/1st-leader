@extends('site.layouts.default')
@section('content')
<br>
<h2 style="text-align:center">Style 1</h1>
    <div class="graphic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="graphic-content">
                                <h1>Title</span></h1>
                                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ad aspernatur expedita incidunt accusantium cumque.</p>
                        <a href="#" class="btn">Button</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <h2 style="text-align:center">Style 2</h1>
            <div class="marketing-page">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6" style="margin:auto">
                                        <img style="margin:auto; display:block; width:400px;" src="{{asset('site/img/bg-marketing.png')}}" alt="" class="img-fluid slider wow slideInLeft" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: slideInLeft;">
                            </div>
                            <div class="col-lg-6">
                                <div class="content content-slider" style="margin-top: 0%">
                                    <h2>Lorem ipsum dolor</h2>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ad aspernatur expedita incidunt accusantium cumque.</p>
                                    <a href="#" class="btn">Button</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<br>

<h2 style="text-align:center">Style 3</h1>
    <div class="portfolio-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner text-center">
                            <img src="{{asset('site/img/bg-marketing.png')}}" width="350px" alt="">
                            <h1><span>See</span> Lorem ipsum dolor </h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ad aspernatur expedita incidunt accusantium cumque.</p>
                        <a href="#" class="btn">Button</a>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <br>
    <h2 style="text-align:center">Style 4</h1>
        <div class="host text-center">
                <div class="container">
                    <div class="row reverse-mobile">
                        <div class="col-lg-7">
                        <div class="hosting-content wow slideInLeft" data-wow-duration="1s">
                            <h3>Lorem ipsum dolor sit ametads sad aqw </h3>
                             <p>Lorem ipsum dolor sit amet ametads sad aqw</p>
                             <p>Lorem ipsum dolor sit amet ametads sad aqw</p>
                             <p>Lorem ipsum dolor sit amet ametads sad aqw</p>
                             <p>Lorem ipsum dolor sit amet ametads sad aqw</p>
                             <p>Lorem ipsum dolor sit amet ametads sad aqw</p>




                            <a href="#" class="btn btn-1 mb-1">Button</a>
                        </div>
                    </div>
                    <div class="col-lg-5" style="margin:auto">
                            <img style="margin:auto; display:block; width:400px;" src="{{asset('site/img/bg-marketing.png')}}" alt="" class="img-fluid img-banner wow slideInRight" data-wow-duration="1s">
                    </div>
                </div>
            </div>
            </div>

<br>
<h2 style="text-align:center">Style 5</h1>

<div class="graphictwo">
    <img src="/filemanager/photos/1/5d9c69c0549fa.jpg" class="backgraphics" />
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="graphic-content">
                            <h1 style="font-family: 'Righteous', cursive;">Lorem ipsum dolor</span></h1>
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus ad aspernatur expedita incidunt accusantium cumque.</p>
                    <a href="#" class="btn">Button Title</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection