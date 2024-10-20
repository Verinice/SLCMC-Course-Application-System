@extends('layouts.app')

@section('title', 'Apply Selected Courses')

@section('content')

@include('partials.header', ['user' => $user])

<div class="main cart">
    <div class="header_info">
        <h1>Hi, {{ $user['full_name'] }}</h1>
        <p>You have <span class="counter"></span> course(s) in your cart</p>
    </div>
    <div class="list"></div>
    <button class="apply">Apply</button>
</div>

@endsection