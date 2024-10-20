@extends('layouts.app')

@section('title', 'Featured Courses')

@section('content')

@include('partials.header', ['user' => $user])
<div class="main featured">
    <h1>Featured Courses</h1>
    <!-- Serach bar start -->
    <form action="" method="get">
        <div class="search_bar">
            <input type="search" name="q" id="" placeholder="Search any course..">
            <button type="submit">Search</button>
        </div>
    </form>
    @foreach( $data['courses'] as $course )
    <!-- Featured course card start -->
    <div class="card" id="course_{{$course['course_id']}}">
        <!-- Card header start -->
        <div class="card-header">
            <img src="./public/assets/images/placeholder.jpg" alt="">
        </div>
        <!-- Card body start -->
        <div class="card-body">
            <h1>{{$course['name']}}</h1>
            <p>{{$course['description']}}</p>
        </div>
        <!-- Card footer start -->
        <div class="card-footer">
            <div class="rating flex">
                <svg width="70" height="70" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.3646 0.77312L7.5304 6.51965L1.18926 7.44413C0.052104 7.60906 -0.403625 9.01097 0.421028 9.81392L5.0087 14.2844L3.92363 20.5995C3.72832 21.741 4.93058 22.596 5.93752 22.0622L11.6103 19.0804L17.283 22.0622C18.29 22.5917 19.4922 21.741 19.2969 20.5995L18.2118 14.2844L22.7995 9.81392C23.6242 9.01097 23.1684 7.60906 22.0313 7.44413L15.6901 6.51965L12.8559 0.77312C12.3481 -0.251186 10.8768 -0.264207 10.3646 0.77312Z" fill="#FFB109" />
                </svg>
                <span class="rating_text">{{$course['rating']}}</span>
            </div>
            <!-- <h1 class="reviews">12.3k Reviews</h1> -->
            <a href="#" data-action="add" data-id="{{$course['course_id']}}" data-name="{{$course['name']}}" class="cart">Add to Cart</a>
        </div>
    </div>
    @endforeach
    <div class="pagination flex">
        @if($data['page'] - 1 >= 1)
        <a href="./courses?page={{$data['page'] - 1}}">Prev</a>
        @endif
        @if($data['page'] + 1 <= $data['totalPages'])
            <a style="margin-left:auto" href="./courses?page={{$data['page'] + 1}}">Next</a>
            @endif
    </div>
    <a href="./cart" class="continue_btn">Continue to Cart ( <span></span> )</a>
</div>
@endsection