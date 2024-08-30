@extends('components.auth-layout')

@section('content')


    <main class="login-bg">

        <div class="register-form-area">
            <div class="register-form text-center">

                <div class="register-heading">
                    <span>Sign Up</span>
                    <p>Create your account to get full access</p>
                </div>
                <form action="{{ route('register-post') }}" id="register_formm" method="post">


                    <div class="input-box">
                        <div class="single-input-fields">
                            <label>First name</label>
                            <input type="text" required placeholder="Enter first name" name="first_name">
                        </div>
                        <div class="single-input-fields">
                            <label>Last name</label>
                            <input type="text" required placeholder="Enter last name" name="last_name">
                        </div>

                        <div class="single-input-fields">
                            <label>Username</label>
                            <input type="text" required placeholder="Enter username" name="user">
                        </div>

                        <div class="single-input-fields">
                            <label>Email Address</label>
                            <input type="email" required placeholder="Enter email address" name="email">
                        </div>
                        <div class="single-input-fields">
                            <label>Password</label>
                            <input type="password" required placeholder="Enter Password" name="password">
                        </div>
                        <div class="single-input-fields">
                            <label>Confirm Password</label>
                            <input type="password" required placeholder="Confirm Password" name="cpassword">
                        </div>
                    </div>

                    <div class="register-footer">
                        <p> Already have an account? <a href="{{ route('login') }}"> Login</a> here</p>
                        <button type="submit" class="submit-btn3">Sign Up</button>
                    </div>
                </form>


            </div>
        </div>

    </main>
