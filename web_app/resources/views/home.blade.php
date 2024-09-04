@extends('components.store-layout')

@section('content')
    <main>

        <div class="slider-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="slider-active dot-style">
                            @foreach ($newBooks as $book)
                            <div class="single-slider slider-height d-flex align-items-center" style="background-image: url({{ $book->thumbnail }})">
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-xxl-4 col-xl-4 col-lg-5 col-md-6 col-sm-7">
                                            <div class="hero-caption text-center">
                                                <span data-animation="fadeInUp" data-delay=".2s">{{ $book->class_name }}</span>
                                                <h1 data-animation="fadeInUp" data-delay=".4s">{{ $book->title }}
                                                </h1>
                                                <a href="{{ route('books', $book->book_id) }}" class="btn hero-btn" data-animation="bounceIn"
                                                    data-delay=".8s">Browse Store</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="best-selling section-bg">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-8">
                        <div class="section-tittle text-center mb-55">
                            <h2>Best Selling Books Ever</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="selling-active">

                            @foreach ($bestSelling as $best)
                            <div class="properties pb-20">
                                <div class="properties-card">
                                    <div class="properties-img">
                                        <a href="{{ route('books', $best->book_id) }}"><img src="{{ $best->thumbnail }}" alt></a>
                                    </div>
                                    <div class="properties-caption">
                                        <h6><a href="{{ route('books', $best->book_id) }}">{{ $best->title }}</a></h6>
                                        <p>{{ $best->class_name }}</p>
                                        <div class="properties-footer d-flex justify-content-between align-items-center">
                                            <div class="review">
                                                <p>{{ $best->subject_name }}</p>
                                            </div>
                                            <div class="price">
                                                <span>₦{{ abbreviateNumber($best->price) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="services-area2 top-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="section-tittle d-flex justify-content-between align-items-center mb-40">
                                    <h2 class="mb-0">Featured This Week</h2>
                                    <a href="{{ route('store') }}" class="browse-btn">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="services-active">
                                    @foreach ($videos as $video)
                                    <div class="single-services d-flex align-items-center">
                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6" style="margin-right: 200px;">
                                            <div class="properties pb-30">
                                                <div class="properties-card">
                                                    <iframe width="460" height="315"
                                                        src="{{ $video->video_link }}"
                                                        frameborder="0"
                                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-9">

                        <div class="google-add">
                            <img src="assets/img/image.jpg" alt class="w-100">
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="our-client section-padding best-selling">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-5 col-lg-5 col-md-12">

                        <div class="section-tittle  mb-40">
                            <h2>Latest Published items</h2>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="nav-button mb-40">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" href="#nav-one"
                                        role="tab" aria-controls="nav-one" aria-selected="true">All</a>
                                    {{-- <a class="nav-link" id="nav-two-tab" data-bs-toggle="tab" href="#nav-two"
                                        role="tab" aria-controls="nav-two" aria-selected="false">Horror</a>
                                    <a class="nav-link" id="nav-three-tab" data-bs-toggle="tab" href="#nav-three"
                                        role="tab" aria-controls="nav-three" aria-selected="false">Thriller</a>
                                    <a class="nav-link" id="nav-four-tab" data-bs-toggle="tab" href="#nav-four"
                                        role="tab" aria-controls="nav-four" aria-selected="false">Science Fiction</a>
                                    <a class="nav-link" id="nav-five-tab" data-bs-toggle="tab" href="#nav-five"
                                        role="tab" aria-controls="nav-five" aria-selected="false">History</a> --}}
                                </div>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container">

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-one" role="tabpanel" aria-labelledby="nav-one-tab">

                        <div class="row">
                                @foreach ($bestSelling as $book)
                                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                                    <div class="properties pb-30">
                                        <div class="properties-card">
                                            <div class="properties-img">
                                                <a href="{{ route('books', $book->book_id) }}"><img src="{{ $book->thumbnail }}"
                                                        alt></a>
                                            </div>
                                            <div class="properties-caption properties-caption2">
                                                <h6><a href="{{ route('books', $book->book_id) }}">{{ $book->title }}</a></h6>
                                                <p>{{ $book->class_name }}</p>
                                                <div
                                                    class="properties-footer d-flex justify-content-between align-items-center">
                                                    {{-- <div class="review">
                                                        <p>{{ $book->subject_name }}</p>
                                                    </div> --}}
                                                    <div class="price">
                                                        <span>₦{{ abbreviateNumber($book->price) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach


                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-xl-12">
                        <div class="more-btn text-center mt-15">
                            <a href="{{ route('store') }}" class="border-btn border-btn2 more-btn2">Browse More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-newsletter></x-newsletter>

    </main>
@endsection
