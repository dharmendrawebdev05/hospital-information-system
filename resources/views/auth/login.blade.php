@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header')
<div class="text-center mb-3">
<h1 class="text-white font-weight-bold">HIS</h1>
<p class="text-white-50">Hospital Information System</p>
</div>
@stop

@section('auth_body')

<style>
body {
background: url('https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=1400&q=80')
no-repeat center center fixed;
background-size: cover;
}

/* DARK OVERLAY FIX */
.login-page::before {
content: "";
position: fixed;
top:0;
left:0;
width:100%;
height:100%;
background: rgba(0,0,0,0.65);
z-index:0;
}

/* BOX */
.login-box {
position: relative;
z-index: 2;
width: 420px;
}

/* CARD GLASS EFFECT */
.card {
border-radius: 15px;
backdrop-filter: blur(12px);
background: rgba(255,255,255,0.12);
border: 1px solid rgba(255,255,255,0.25);
box-shadow: 0 15px 40px rgba(0,0,0,0.4);
}

/* TEXT FIX */
.card-body {
color: #fff;
}

/* INPUT STYLE */
.form-control {
background: rgba(255,255,255,0.9) !important;
border-radius: 8px;
}

/* BUTTON */
.btn-primary {
border-radius: 8px;
}

/* HIDE DEFAULT LOGO */
.login-logo {
display: none;
}

</style>

<form action="{{ route('login') }}" method="post">
@csrf

{{-- EMAIL --}}
<div class="input-group mb-3">
<input type="email"
name="email"
class="form-control"
placeholder="Enter Email"
required>

<div class="input-group-append">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
</div>
</div>

{{-- PASSWORD --}}
<div class="input-group mb-2">
<input type="password"
name="password"
class="form-control"
placeholder="Enter Password"
required>

<div class="input-group-append">
<div class="input-group-text">
<i class="fas fa-lock"></i>
</div>
</div>
</div>

{{-- OPTIONS --}}
<div class="row mb-3">

{{-- REMEMBER ME --}}
<div class="col-6">
<div class="icheck-primary">
<input type="checkbox" id="remember" name="remember">
<a href="#">Remember Me</a></div>
</div>

{{-- FORGOT PASSWORD (SAFE) --}}
<div class="col-6 text-right">
@if (Route::has('password.request'))
<a href="{{ route('password.request') }}">
Forgot Password?
</a>
@endif
</div>

</div>

{{-- LOGIN BUTTON --}}
<button type="submit" class="btn btn-primary btn-block btn-lg">
<i class="fas fa-sign-in-alt"></i> Login
</button>

</form>

@stop