@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="main">
    <form class="login" action="/" method="post">
        <h1>Login</h1>
        <input type="email" name="email" id="email" placeholder="Enter your email address" required>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>
        <button type="submit">Submit</button>
        <p>Don't have an account yet? <a href="./register">register</p></a>
    </form>
</div>

@endsection