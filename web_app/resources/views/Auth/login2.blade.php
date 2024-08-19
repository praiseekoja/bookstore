@extends('components.auth-layout')

@section('content')

<main class="login-bg">

    <div class="login-form-area">
        <div class="login-form">

            <div class="login-heading">
                <span>Login</span>
                <p>Enter Login details to get access</p>
            </div>
        <form action="" id="loginn_formm" method="post">


            <div class="input-box">
                <div class="single-input-fields">
                    <label>Username / Email</label>
                    <input type="text" name="user" required placeholder="Username / Email" >
                </div>
                <div class="single-input-fields">
                    <label>Password</label>
                    <input type="password" required placeholder="Enter Password" name="password">
                </div>
            </div>

            <div class="login-footer">
                <button type="submit" class="submit-btn3">Login</button>
            </div>
        </form>
        </div>
    </div>

</main>

@endsection
