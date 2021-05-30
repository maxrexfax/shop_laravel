@extends('layouts.app')
@section('content')
<div class="">
    <section class="class-color-transparent">
        <div class="text-center text-light">
            <h1 class="">{{__('The Highest Quality Supplements and Health-Supporting Products')}}</h1>
        </div>
    </section>
    @include('main.partials._slider')
    <section>
        <div class="text-center mt-3 mb-3">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-lg-2"></div>
                    <div class="col-md-8 col-lg-8">
                        <h3 class="font-weight-bold">{{__('Looking for quality vitamins from a supplier you can trust?')}}</h3>
                        <h3 class="font-weight-bold">{{__('You\'ve come to the right place!')}}</h3>
                        <br>
                        <p>{{__('Beyond Health exists to support you in achieving a level of health beyond what you may have thought possible. These high-quality products cost more to manufacture, but they yield more biologically-active nutrients without contaminants. This makes our supplements many times more effective than comparable products, and the best supplement value you can buy.')}}</p>
                    </div>
                    <div class="col-md-2 col-lg-2"></div>
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
                        <p class="first-paragraph font-weight-bold">{{__('All Natural')}}</p><p class="font-weight-bold">{{__('No Synthetics')}}</p>
                    </div>
                </div>
                <div class="col-sm col-lg-4">
                    <div class="col-sm mini-banner-div">
                        <img class="float-left" src="{{ asset('/img/serviceimages/feature02.png')}}"/>
                        <p class="first-paragraph font-weight-bold">{{__('Dedicated')}}</p><p class="font-weight-bold">{{__('To Your Health')}}</p>
                    </div>
                </div>
                <div class="col-sm col-lg-4">
                    <div class="col-sm mini-banner-div">
                        <img class="float-left" src="{{ asset('/img/serviceimages/feature03.png')}}"/>
                        <p class="first-paragraph font-weight-bold">{{__('30 Days Money')}}</p><p class="font-weight-bold">{{__('Back Guarantee**')}}</p>
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
        <h2 id="bestsellers" class="font-weight-bold">{{__('Our bestsellers')}}</h2>
    </div>
    @include('main.partials._bestsellers')
</section>
<section class="gray-section">
    <div class="mt-3 mb-3 pt-5 pb-5">
        <div class="row">
            <div class="col-sm-1"></div>
            <div class="col-sm-3">
                <h2 id="resources" class="font-weight-bold">{{__('Why Choose Us')}}</h2>
            </div>
            <div class="col-sm-7">
                <p class="">{{__('Most vitamin products are made from synthetic chemicals that the body doesn\'t recognize and is unable to process, and from minerals in forms that the body can\'t use.')}}</p>
                <span class="btn btn-primary">{{__('Learn more...')}}</span>
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
        <h2 id="about_us" class="font-weight-bold">{{__('What Our Customers Say')}}</h2>
        <a href="#"><p>{{__('Read all reviews here...')}}</p></a>
    </div>
</section>
<section class="place-holder"></section>

@endsection
