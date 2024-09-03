@extends('components.auth-layout')

@section('content')

<main class="login-bg">

    <div class="login-form-area">
        <div class="login-form">

            <div class="login-heading">
                <span>One-Time Password OTP</span>
                <p>Enter code sent to your email</p>
            </div>
        <form action="" id="otp_formm" method="post">

            <div class="input-box">
                <div class="single-input-fields">
                    <label>OTP Code</label>
                    <input type="text" name="otp" required placeholder="Enter OTP code" >
                </div>

            </div>

            <div class="login-footer">
                <button type="submit" class="submit-btn3">Submit</button>
            </div>
        </form>
        </div>
    </div>

</main>


@endsection
