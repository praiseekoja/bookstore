@extends('components.store-layout')

@section('content')
    <main>

        <div class="services-area2">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-xl-12">

                                <div class="single-services d-flex align-items-center mb-0">
                                    <div class="features-img">
                                        <img src="{{ url($book->thumbnail) }}" alt>
                                    </div>
                                    <div class="features-caption">
                                        <h3>{{ $book->title }}</h3>
                                        <p>{{ $book->class_name }}</p>
                                        <div class="price">
                                            <span>₦{{ abbreviateNumber($book->price) }} <small style="font-size: 15px">softcopy</small></span>
                                        </div>
                                        <br>
                                        <div class="price">
                                            <span>₦{{ abbreviateNumber($book->price2) }} <small style="font-size: 15px">hardtcopy</small></span>
                                        </div>
                                        <div class="review">
                                            <p>{{ $book->subject_name }}</p>
                                        </div>
                                        <a href="#" class="white-btn mr-10" id="add_to_cart">Add to Cart</a>
                                        <input type="hidden" name="bookId" value="{{ $book->book_id }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="our-client section-padding best-selling">
            <div class="container">
                <div class="row">
                    <div class="offset-xl-1 col-xl-10">
                        <div class="nav-button f-left">

                            <nav>
                                <div class="nav nav-tabs " id="nav-tab" role="tablist">
                                    <a class="nav-link active" id="nav-one-tab" data-bs-toggle="tab" href="#nav-one"
                                        role="tab" aria-controls="nav-one" aria-selected="true">Description</a>
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
                            <div class="offset-xl-1 col-lg-9">
                                <p>{{ $book->descr }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <x-newsletter></x-newsletter>

    </main>
@endsection
