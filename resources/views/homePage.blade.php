@extends('layouts/customer/app') 

@section('content')
    <div class="media-icons">
        <a href=""><i class="uil uil-facebook-f"></i></a>
        <a href=""><i class="uil uil-instagram"></i></a>
        <a href=""><i class="uil uil-whatsapp"></i></a>
    </div>

    <div class="swiper bg-slider">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <img src="{{ asset('images/spring.jpg') }}" alt="">
                   <!-- <div class="text-content">
                    <h2 class="title">Spring <span>Season</span></h2>
                    <p>Spring is the time when the world awakens, and your journey should be no different. Pack your bags, set forth on a blooming adventure, and experience the splendor of this season's travel possibilities.</p>
                    <button class="choose-btn">Travel Now <i class="uil uil-arrow-right"></i></button>
                </div> -->
            </div>

            <div class="swiper-slide dark-layer">
                <img src="{{ asset('images/summer.jpeg') }}" alt="">
                <!-- <div class="text-content">
                    <h2 class="title">Summer <span>Season</span></h2>
                    <p>Embrace the warmth of the sun, the cool breeze, and the endless adventures. Summer is the perfect time to explore new places, create unforgettable memories, and bask in the beauty of the world.</p>
                    <button class="choose-btn"> Travel Now <i class="uil uil-arrow-right"></i></button>
                </div> -->
            </div>

            <div class="swiper-slide dark-layer">
                <img src="{{ asset('images/autumn.jpeg') }}" alt="">
                <!-- <div class="text-content">
                    <h2 class="title">Autumn <span>Season</span></h2>
                    <p>This is the season for capturing photographs that encapsulate the essence of autumn's splendor, for sharing stories around bonfires, and for exploring the cozy corners of the world. Let the beauty of autumn be your guide to memorable journeys.</p>
                    <button class="choose-btn"> Travel Now <i class="uil uil-arrow-right"></i></button>
                </div> -->
            </div>

            <div class="swiper-slide">
                <img src="{{ asset('images/winter.jpeg') }}" alt="">
                <!-- <div class="text-content">
                    <h2 class="title">Winter <span>Season</span></h2>
                    <p>Winter travel is a symphony of cozy moments, frosty landscapes, and the magic of the season.  Let's wander where the snowflakes kiss the earth.</p>
                    <button class="choose-btn"> Travel Now <i class="uil uil-arrow-right"></i></button>
                </div> -->
            </div>
        </div>
    </div>

    <div class="bg-slider-thumbs">
        <div class="swiper-wrapper thumbs-container">
            <img src="{{ asset('images/spring.jpg') }}" class="swiper-slide" alt="">
            <img src="{{ asset('images/summer.jpeg') }}" class="swiper-slide" alt="">
            <img src="{{ asset('images/autumn.jpeg') }}" class="swiper-slide" alt="">
            <img src="{{ asset('images/winter.jpeg') }}" class="swiper-slide" alt="">
        </div>
    </div>
@endsection
