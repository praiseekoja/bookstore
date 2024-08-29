@extends('components.cart-checkout')

@section('content')
    <main>

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>Cart</h2>
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
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-total">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $item)
                                        @php
                                            $total += $item->price * $item->qty;
                                        @endphp <tr>
                                            <td class="product-thumbnail">
                                                <img src="{{ url($item->thumbnail) }}" alt="Image" width="30%"
                                                    class="img-fld" />
                                            </td>
                                            <td class="product-name">
                                                <h2 class="h5 text-black">{{ $item->title }}</h2>
                                            </td>
                                            <td id="unit-{{ $item->id }}">₦{{ number_format($item->price, 2) }}</td>
                                            <td>
                                                <div class="quantity">
                                                    <button type="button"
                                                        style="margin: 10px; font-weight: 900; border: 0px; background-color: white; color:black;"
                                                        class="decr" data-id="item-{{ $item->id }}">-</button>

                                                    <span class="prod-qty"
                                                        id="item-{{ $item->id }}">{{ $item->qty }}</span>

                                                    <button
                                                        style="margin: 10px; font-weight: 900; border: 0px; background-color: white; color:black;"
                                                        type="button" class="incr"
                                                        data-id="item-{{ $item->id }}">+</button>
                                                </div>
                                            </td>
                                            <td id="subbTotal-{{ $item->id }}">₦{{ number_format($item->price * $item->qty, 2) }}</td>
                                            
                                            <td><button class="remove-item" data-id="{{ $item->id }}"
                                                style="margin: 10px; font-weight: 900; border: 0px; background-color: white; color:black;"
                                                type="button">X</button></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-5">
                            {{-- <div class="col-md-6 mb-3 mb-md-0">
                            <button class="btn btn-black btn-sm btn-block">
                                Update Cart
                            </button>
                        </div> --}}
                            <div class="col-md-6">
                                <button class="btn btn-outline-black btn-sm btn-block"
                                    onclick="window.location='{{ route('store') }}'">
                                    Continue Shopping
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-5">
                        <div class="row justify-content-end">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-12 text-right border-bottom mb-5">
                                        <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <span class="text-black">Subtotal</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong id="sub-price" class="text-black">₦{{ number_format($total, 2) }}</strong>
                                    </div>
                                </div>
                                <div class="row mb-5">
                                    <div class="col-md-6">
                                        <span class="text-black">Total</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <strong id="total-price" class="text-black">₦{{ number_format($total, 2) }}</strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <button class="btn btn-black btn-lg py-3 btn-block"
                                            onclick="window.location='{{ route('checkout') }}'">
                                            Proceed To Checkout
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
