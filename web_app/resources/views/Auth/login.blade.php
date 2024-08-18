@extends('components.auth-layout')

@section('content')

<main class="login-bg">

    <div class="login-form-area">
        <div class="login-form">

            <div class="login-heading">
                <span>Login</span>
                <p>Enter Login details to get access</p>
            </div>
        <form action="{{ route('login-post') }}" id="login_formm" method="post">


            <div class="input-box">
                <div class="single-input-fields">
                    <label>Username or Email Address</label>
                    <input type="text" name="user" required placeholder="Username / Email address" >
                </div>
                <div class="single-input-fields">
                    <label>Password</label>
                    <input type="password" required placeholder="Enter Password" name="password">
                </div>
                <div class="single-input-fields login-check">
                    <input type="checkbox" id="fruit1" name="keep-log">
                    <label for="fruit1">Keep me logged in</label>
                    <a href="#" class="f-right">Forgot Password?</a>
                </div>
            </div>

            <div class="login-footer">
                <p>Don’t have an account? <a href="{{ route('register') }}">Sign Up</a> here</p>
                <button type="submit" class="submit-btn3">Login</button>
            </div>
        </form>
        </div>
    </div>

</main>

@endsection
