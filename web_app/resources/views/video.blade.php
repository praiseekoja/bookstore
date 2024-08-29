@extends('components.store-layout')

@section('content')
    <main>

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>Video Library</h2>
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
                        {{-- <div class="row justify-content-end">
                            <div class="col-xl-4">
                                <div class="product_page_tittle">
                                    <div class="short_by">
                                        <select name="#" id="product_short_list">
                                            <option>Browse by popularity</option>
                                            <option>Name</option>
                                            <option>NEW</option>
                                            <option>Old</option>
                                            <option>Price</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="best-selling p-0">
                            <div class="row">
                                @foreach ($videos as $video)
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
                                @endforeach

                                {{-- <div class="row">
                                    <div class="col-xl-12">
                                        <div class="more-btn text-center mt-15">
                                            <a href="#" class="border-btn border-btn2 more-btn2">Browse More</a>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <x-newsletter></x-newsletter>

    </main>
@endsection
