@extends('components.cart-checkout')

@section('content')
    <main>

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>Transaction Details</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="untree_co-section before-footer-section">
            <div class="container">
                <div class="row mb-5">
                    <form class="col-md-12" method="post">
                        <div class="site-blocks-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Item</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-quantity">Cost</th>
                                        <th class="product-quantity">Format</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (json_decode($carts->details) as $item)
                                    <tr>
                                        <td class="product-thumbnail">
                                            <img src="{{ url($item->thumbnail) }}" alt="Image" width="30%"
                                                class="img-fld" />
                                        </td>
                                        <td class="product-name">
                                            <h2 class="h5 text-black">{{ $item->title }}</h2>
                                        </td>
                                        <td>
                                            <div class="quantity">

                                                <span class="prod-qty"
                                                    id="item-{{ $item->id }}">{{ $item->qty }}</span>
                                            </div>
                                        </td>
                                        @if($item->format == 'hard')
                                            <td>{{number_format($item->price2 * $item->qty, 2)}}</td>
                                        @else
                                        <td>{{number_format($item->price, 2)}}</td>
                                        @endif
                                        <td>{{ucfirst($item->format)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(!empty($carts->shipping_details))
                            @php
                                $user = json_decode($carts->shipping_details);
                            @endphp
                            <h2>Shipping Details</h2>
                            <h6>First Name: <span>{{$user->first_name}}</span></h6>
                            <h6>Last Name: <span>{{$user->last_name}}</span></h6>
                            <h6>Email Address: <span>{{$user->email}}</span></h6>
                            <h6>Mobile Number: <span>{{$user->phone}}</span></h6>
                            <h6>Address: <span>{{$user->address}}</span></h6>
                        <h6>State: <span>{{$user->state}}</span></h6>
                        <h6>Company: <span>{{$user->company}}</span></h6>
                        <h6>Country: <span>Nigeria</span></h6>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
