@extends('components.auth-layout')

@section('content')


<main class="login-bg">

<div class="register-form-area">
<div class="register-form text-center">

<div class="register-heading">
<span>Sign Up</span>
<p>Create your account to get full access</p>
</div>
<form action="{{ route('register') }}" method="post">


<div class="input-box">
<div class="single-input-fields">
<label>Full name</label>
<input type="text" placeholder="Enter full name" name="name">
</div>
<div class="single-input-fields">
<label>Email Address</label>
<input type="email" placeholder="Enter email address" name="email">
</div>
<div class="single-input-fields">
<label>Password</label>
<input type="password" placeholder="Enter Password" name="password">
</div>
<div class="single-input-fields">
<label>Confirm Password</label>
<input type="password" placeholder="Confirm Password" name="cpassword">
</div>
</div>

<div class="register-footer">
<p> Already have an account? <a href="{{ route('login') }}"> Login</a> here</p>
<button class="submit-btn3">Sign Up</button>
</div>
</form>


</div>
</div>

</main>
