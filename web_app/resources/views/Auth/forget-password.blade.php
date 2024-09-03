@extends('components.auth-layout')

@section('content')

<main class="login-bg">

    <div class="login-form-area">
        <div class="login-form">

            <div class="login-heading">
                <span>Forget Password</span>
                <p>Enter email or username to get an OTP to reset your password</p>
            </div>
        <form action="" id="forget_formm" method="post">


            <div class="input-box">
                <div class="single-input-fields">
                    <label>Username or Email Address</label>
                    <input type="text" name="user" required placeholder="Username / Email address" >
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
