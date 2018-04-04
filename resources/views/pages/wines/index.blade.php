@extends('layouts.master')
@section('left-content')
    Filters
@endsection

@section('right-content')
    Shopping Cart
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
    <div class="row">
        @foreach($wines as $wine)
            <div class="col-xs-12 col-sm-6 col-lg-4 col-xl-3 mb-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $wine->thumbnail_cover }}" alt="{{ $wine->name }}">
                    <div class="card-body">
                        <h5><a class="card-title" href="{{ to('user.profile.show', $wine) }}">{{ $wine->name }}</a></h5>
                        <p class="card-text text-truncate">{{ $wine->description }}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><small>Price</small> {{ $wine->price }}</li>
                        <li class="list-group-item"><small>Region</small> {{ $wine->region->name }}</li>
                        <li class="list-group-item"><small>Country</small> <span class="flag-icon flag-icon-{{ strtolower($wine->winery->country->cca2) }}"></span> {{ $wine->winery->country_name }}</li>
                        <li class="list-group-item"><small>Average Rating</small> {{ $wine->rating }}</li>
                        <li class="list-group-item"><small>Year</small> {{ $wine->year }}</li>
                    </ul>
                    <div class="card-body">
                        <a href="#" class="card-link">Add to Wishlist</a>
                        <a href="#" class="card-link">Add to Cart</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="mx-auto">
            {{ $wines->links() }}
        </div>
    </div>
@endsection