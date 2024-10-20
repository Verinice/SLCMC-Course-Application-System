@extends('layouts.app')

@section('title', 'My Dashboard')

@section('content')

@include('partials.header', ['user' => $user])

<div class="dashboard">
    <div class="profile_header">
        <div class="dp"><img src="./public/assets/images/placeholder.jpg" alt=""></div>
        <h1>{{ $user['full_name'] }}</h1>
    </div>
    <div class="main">
        <h1>Certificates & Skills</h1>
        <div class="card" id="kcpe_card">
            <div class="card-header"><img src="./public/assets/images/placeholder.jpg" alt=""></div>
            <div class="card-body">
                <h1>Kenya Council of Primary Education</h1>
                @if( $user['kcpe_score'] )
                <div id="score">Score: {{ $user['kcpe_score'] }} marks</div>
                @else
                <span class="update_badge" data-id="kcpe_score" data-adm="{{ $user['admission_number'] }}">+ Update</span>
                @endif
            </div>
        </div>
        <div class="card" id="kcse_card">
            <div class="card-header"><img src="./public/assets/images/placeholder.jpg" alt=""></div>
            <div class="card-body">
                <h1>Kenya Council of Primary Education</h1>
                @if( $user['kcse_score'] )
                <div id="score">Score: {{ $user['kcse_score'] }} points</div>
                @else
                <span class="update_badge" data-id="kcse_score" data-adm="{{ $user['admission_number'] }}">+ Update</span>
                @endif
            </div>
        </div>
        <h1>My Applications ({{ count($user['total_courses']) }})</h1>
        <div id="#applications"></div>
        @foreach($user['total_courses'] as $key => $course)
        <div class="list" id="{{$course['course_id']}}">
            <h1>{{$course['name']}}</h1>
            <!-- <div class="vii_info"><span>Status</span><span class="active">Active</span></div> -->
            <hr />
            <!-- <div class="vii_info"><span>Current module</span><span>2</span></div> -->
            <!-- <hr /> -->
        </div>
        @endforeach
    </div>
</div>

@endsection