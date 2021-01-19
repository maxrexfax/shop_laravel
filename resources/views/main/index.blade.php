@extends('layouts.app')
@section('content')
<div class="gray-section">
    <section>
        <div class="text-center"><b>Slider</b></div>
    </section>
    @include('main.partials._slider')
    <section>
        <div class="text-center mt-3 mb-3">
            <div class="container">
                <div class="col-sm-10">
                    <h3><b>Looking for quality vitamins from a supplier you can trust?</b></h3>
                    <p>You've come to the right place!</p>
                    <p>Beyond Health exists to support you in achieving a level of health beyond what you may have thought possible.</p>
                    <p>These high-quality products cost more to manufacture, but they yield more biologically-active nutrients without contaminants. This makes our supplements many times more effective than comparable products, and the best supplement value you can buy.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="half-down">
        <div class="container text-center mt-3 mb-3">
            <div class="row">
                <div class="col-sm col-lg-4">
                    <div class="col-sm mini-banner-div">
                        <img class="float-left" src="{{ asset('/img/serviceimages/feature01.png')}}"/>
                        <p class="first-paragraph"><b>All Natural,</b></p><p><b>No Synthetics</b></p>
                    </div>
                </div>
                <div class="col-sm col-lg-4">
                    <div class="col-sm mini-banner-div">
                        <img class="float-left" src="{{ asset('/img/serviceimages/feature02.png')}}"/>
                        <p class="first-paragraph"><b>Dedicated,</b></p><p><b>To Your Health</b></p>
                    </div>
                </div>
                <div class="col-sm col-lg-4">
                    <div class="col-sm mini-banner-div">
                        <img class="float-left" src="{{ asset('/img/serviceimages/feature03.png')}}"/>
                        <p class="first-paragraph"><b>30 Days Money,</b></p><p><b>Back Guarantee**</b></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<section class="place-holder">
</section>
<section>
    <div class="text-center mt-3 mb-5">
        <h2><b>Our bestsellers</b></h2>
    </div>
    @include('main.partials._bestsellers')
</section>
<section class="gray-section">
    <div class="mt-3 mb-3 pt-5 pb-5">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
                <h2><b>Why Choose Us</b></h2>
            </div>
            <div class="col-sm-7">
                <p class="">Most vitamin products are made from synthetic chemicals that the body doesn't recognize and is unable to process, and from minerals in forms that the body can't use.</p>
                <span class="btn btn-primary">Learn more...</span>
            </div>
            <div class="col-sm-1"></div>
        </div>
    </div>
</section>
<section>
    <div class="text-center mt-3 mb-3">
    </div>
    @include('main.partials._banners_in_bottom')
</section>
<section>
    <div class="text-center mt-6">
        <h2><b>What Our Customers Say</b></h2>
<a href="#"><p>Read all reviews here...</p></a>
    </div>
</section>


@endsection
