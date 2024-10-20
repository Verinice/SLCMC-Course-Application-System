@extends('layouts.app')

@section('title', 'Apply for a Course')

@section('content')
<div class="main">
    <form class="register" action="/" method="post">
        <h1>Application Form</h1>
        <input type="text" name="name" id="name" required placeholder="Enter your full name">
        <input type="email" name="email" id="email" required placeholder="Enter your email address">
        <input type="text" name="phone" id="phone" required placeholder="Enter your phone number">
        <input type="password" name="password" id="password" required placeholder="Enter your password">
        <input type="password" name="conf_password" id="conf_password" required placeholder="Confirm your password">
        <!-- <input type="text" name="dob" id="dob" required placeholder="Enter you date of birth"> -->
        <div class="accept_terms">
            <input class="check" type="checkbox" name="terms" id="terms">
            <p>Read terms and conditions of use?</p>
        </div>
        <button type="submit">Submit</button>
        <p>Already have an account? <a href="./login">login</p></a>
    </form>
</div>
@endsection