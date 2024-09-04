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
                                        <th class="product-name">Item</th>
                                        <th class="product-quantity">Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $item)
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

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
