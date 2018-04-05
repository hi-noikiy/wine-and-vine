@extends('layouts.master')
@section('left-content')
    Filters
@endsection

@section('right-content')
    <wav-shopping-cart></wav-shopping-cart>
@endsection

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ to('welcome') }}">Home</a></li>
            <li class="breadcrumb-item">Browse</li>
        </ol>
    </nav>
@endsection

@section('content')
    <wines-list class="mt-3"></wines-list>
@endsection