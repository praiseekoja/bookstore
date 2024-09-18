@extends('components.cart-checkout')

@php
    function generateOrderNumber($prefix = 'hfb-', $length = 8): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        // Generate random characters
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        // Combine prefix with random characters
        return $prefix . $randomString;
    }
@endphp

@section('content')
    <main>

        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="slider-area">
                        <div class="slider-height2 slider-bg5 d-flex align-items-center justify-content-center">
                            <div class="hero-caption hero-caption2">
                                <h2>Checkout</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="untree_co-section">
            <div class="container">

                <div class="row">
                        <div class="col-md-6 mb-5 mb-md-0">
                            <h2 class="h3 mb-3 text-black">Billing Details</h2>
                            <form id="order-form" method="post">
                                <input type="hidden" name="ref" value="{{ generateOrderNumber() }}">
                            <div class="p-3 p-lg-5 bg-white">
                                <div class="form-group">
                                    <label for="country" class="text-black">Country <span
                                            class="text-danger">*</span></label>
                                    <select id="country" class="form-control">
                                        <option value="Nigeria">Nigeria</option>
                                    </select>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="c_fname" class="text-black">First Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="first_name"
                                            value="{{ $profile->first_name }}" name="first_name" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_lname" class="text-black">Last Name <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="c_lname"
                                            value="{{ $profile->last_name }}" name="last_name" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_companyname" class="text-black">Company Name
                                        </label>
                                        <input type="text" class="form-control" id="c_companyname" name="company" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_address" class="text-black">Address <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $profile->addr }}"
                                            id="c_address" name="address" placeholder="Street address" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="c_state_country" class="text-black">State <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="state" name="state" />
                                    </div>
                                </div>

                                <div class="form-group row mb-5">
                                    <div class="col-md-6">
                                        <label for="c_email_address" class="text-black">Email Address <span
                                                class="text-danger">*</span></label>
                                        <input type="email" value="{{ $user->email }}" class="form-control"
                                            id="c_email_address" name="email" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="c_phone" class="text-black">Phone <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{ $profile->tel }}"
                                            id="c_phone" name="phone" placeholder="Phone Number" />
                                    </div>
                                </div>

                            </div></form>
                        </div>


                    <div class="col-md-6">

                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Your Order</h2>
                                <div class="p-3 p-lg-5 bg-white">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </thead>
                                        @php
                                            $total = 0;
                                        @endphp
                                        <tbody>
                                            @foreach ($carts as $item)
                                                @php
                                                    if ($item->format == 'hard') {
                                                if ($item->price2 > 0) {
                                                    $total += $item->price2 * $item->qty;
                                                }
                                            } else {
                                                if ($item->price > 0) {
                                                    $total += $item->price * $item->qty;
                                                }
                                            }
                                                @endphp
                                                <tr>
                                                    <td>
                                                        {{ $item->title }} <strong class="mx-2">x</strong>
                                                        {{ $item->qty }}
                                                    </td>
                                                    @if ($item->format == 'hard')
                                                    <td>₦{{ number_format($item->price2 * $item->qty, 2) }}</td>
                                                    @else
                                                    
                                                    <td>₦{{ number_format($item->price * $item->qty, 2) }}</td>
                                                    @endif
                                                    
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td class="text-black font-weight-bold">
                                                    <strong>Cart Subtotal</strong>
                                                </td>
                                                <td class="text-black">₦{{ number_format($total, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold">
                                                    <strong>Order Total</strong>
                                                </td>
                                                <td class="text-black font-weight-bold">
                                                    <strong>₦{{ number_format($total, 2) }}</strong>
                                                </td>
                                                <input type="hidden" id="total-pr" value="{{ $total }}">
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group">
                                        <button class="btn btn-black btn-lg py-3 btn-block" onclick="makePayment()">
                                            Proceed to Payment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </main>
@endsection
