@extends('layouts.master')
@section('left-content')
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci amet architecto debitis delectus doloremque doloribus excepturi facilis, fugiat laboriosam maiores neque, nihil nisi obcaecati odit quia quos rerum saepe ullam!
@endsection

@section('breadcrumb')
    {{--<nav aria-label="breadcrumb">--}}
        {{--<ol class="breadcrumb">--}}
            {{--<li class="breadcrumb-item"><a href="{{ to('welcome') }}">Home</a></li>--}}
            {{--<li class="breadcrumb-item">Browse</li>--}}
        {{--</ol>--}}
    {{--</nav>--}}
@endsection

@section('content')
    <wines-list></wines-list>
@endsection

@section('right-content')
    <div class="fixed w-1/4">
        <wav-shopping-cart></wav-shopping-cart>
    </div>
@endsection