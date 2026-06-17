@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('auth_header')
<div class="text-center">
<h3 class="text-white font-weight-bold">Forgot Password</h3>
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

.login-box {
position: relative;
z-index: 2;
width: 420px;
}

.card {
border-radius: 15px;
backdrop-filter: blur(12px);
background: rgba(255,255,255,0.12);
border: 1px solid rgba(255,255,255,0.25);
box-shadow: 0 15px 40px rgba(0,0,0,0.4);
}

.card-body {
color: #fff;
}

.form-control {
background: rgba(255,255,255,0.9) !important;
border-radius: 8px;
}

.btn-primary {
border-radius: 8px;
}

.login-logo {
display: none;
}
</style>

{{-- INFO TEXT --}}
<div class="mb-3 text-white">
<small>
Enter your email address and we will send you a password reset link.
</small>
</div>

{{-- STATUS --}}
@if (session('status'))
<div class="alert alert-success">
{{ session('status') }}
</div>
@endif

{{-- FORM --}}
<form method="POST" action="{{ route('password.email') }}">
@csrf

{{-- EMAIL --}}
<div class="input-group mb-3">

<input type="email"
name="email"
class="form-control"
placeholder="Enter Email Address"
value="{{ old('email') }}"
required autofocus>

<div class="input-group-append">
<div class="input-group-text">
<i class="fas fa-envelope"></i>
</div>
</div>

</div>

{{-- ERROR --}}
@error('email')
<div class="text-danger mb-2">
{{ $message }}
</div>
@enderror

{{-- BUTTON --}}
<button type="submit" class="btn btn-primary btn-block btn-lg">
<i class="fas fa-paper-plane"></i> Send Reset Link
</button>

{{-- BACK LOGIN --}}
<div class="text-center mt-3">
<a href="{{ route('login') }}" >
Back to Login
</a>
</div>

</form>

@stop