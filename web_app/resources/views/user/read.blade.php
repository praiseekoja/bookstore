@extends('components.read-layout')

@section('content')

<main>

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>{{ $book->title }}</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="listing-area pt-50 pb-50">
            <div class="container">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        
                        <div class="best-selling p-0">
                            <div class="row">
                                <div>
                                    <button class="border-btn border-btn2 more-btn2" id="prev">Previous</button>
                                    <button class="border-btn border-btn2 more-btn2" id="next">Next</button>
                                    &nbsp; &nbsp;
                                    <span>Page: <span id="page_num"></span> / <span id="page_count"></span></span>
                                </div>
                            
                                <canvas id="the-canvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <x-newsletter></x-newsletter>
</main>
    
@endsection
