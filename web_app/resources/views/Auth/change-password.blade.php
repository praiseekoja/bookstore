@extends('components.auth-layout')

@section('content')

<main class="login-bg">

    <div class="login-form-area">
        <div class="login-form">

            <div class="login-heading">
                <span>Forget Password</span>
                <p>Change your password</p>
            </div>
        <form action="" id="psw_formm" method="post">


            <div class="input-box">
                <div class="single-input-fields">
                    <label>Password</label>
                    <input type="password" name="password" required placeholder="Enter password atleast 8 characters" >
                </div>

                <div class="single-input-fields">
                    <label>Re-type Password</label>
                    <input type="password" name="password_confirmation" required placeholder="Enter password atleast 8 characters" >
                </div>

            </div>

            <div class="login-footer">
                <button type="submit" class="submit-btn3">Change Password</button>
            </div>
        </form>
        </div>
    </div>

</main>

@endsection
