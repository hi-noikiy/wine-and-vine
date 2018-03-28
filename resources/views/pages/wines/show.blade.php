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
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('wines.index') }}">Browse</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $wine->name }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-4 py-2">
                <img class="mx-auto img-thumbnail rounded d-block" src="{{ $wine->thumbnail_cover }}" alt="{{ $wine->name }}">
            </div>
            <div class="col-sm-8 py-2">
                <div class="p-3 bg-white rounded box-shadow">
                    <h4 class="border-bottom border-gray pb-3 mb-0">{{ $wine->name }}</h4>
                    {{--Winery--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 border-bottom border-gray">
                            <strong class="text-gray-dark">Winery</strong> <a href="#">{{ $wine->winery->name }}</a>
                        </div>
                    </div>
                    {{--Region--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="text-gray-dark"><strong>Region</strong> {{ $wine->winery->region_name }}</span>
                                <a href="#">All wines from {{ $wine->winery->region_name }}</a>
                            </div>
                        </div>
                    </div>
                    {{--Region--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="text-gray-dark"><strong>Country</strong>
                                    <span class="flag-icon flag-icon-{{ strtolower($wine->winery->country->cca2) }}"></span>
                                    {{ $wine->winery->country_name }}</span>
                                <a href="#">All wines from {{ $wine->winery->country_name }}</a>
                            </div>
                        </div>
                    </div>
                    {{--Year--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="text-gray-dark"><strong>Year</strong> {{ $wine->year }}</span>
                                <a href="#">All wines from {{ $wine->year }}</a>
                            </div>
                        </div>
                    </div>
                    {{--Rating--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                {{--Show only md and below--}}
                                <div class="d-block d-lg-none">
                                    <span class="text-gray-dark"><strong>Rating</strong> {{ $wine->rating }}</span>
                                </div>
                                {{--Show only lg and above--}}
                                <div class="d-none d-lg-block">
                                    <span class="text-gray-dark"><strong>Average Rating</strong> {{ $wine->rating }}</span>
                                </div>
                                <a href="#">All wines above {{ floor($wine->rating) }} rating</a>
                            </div>
                        </div>
                    </div>
                    {{--Denomination--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                {{--Show only lg and below--}}
                                <div class="d-block d-xl-none">
                                    <span class="text-gray-dark"><strong>Denomination</strong> {{ $wine->denomination->short_name }}</span>
                                </div>
                                {{--Show only xl--}}
                                <div class="d-none d-xl-block">
                                    <span class="text-gray-dark"><strong>Denomination</strong> {{ $wine->denomination->name }}</span>
                                </div>
                                <a href="#">All {{ $wine->denomination->short_name }} wines</a>
                            </div>
                        </div>
                    </div>
                    {{--Recommended Temperature--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                {{--Show only md and below--}}
                                <div class="d-block d-lg-none">
                                    <strong class="text-gray-dark pr-1">Temperature </strong>{{ $wine->temperature }} ºC
                                </div>
                                {{--Show only lg and above--}}
                                <div class="d-none d-lg-block">
                                    <strong class="text-gray-dark pr-1">Recommended Temperature </strong>{{ $wine->temperature }} ºC
                                </div>
                                <a class="ml-auto" href="#">All with {{ $wine->temperature }} ºC</a>
                            </div>
                        </div>
                    </div>
                    {{--Type--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="text-gray-dark pr-1">Type </strong>{{ $wine->type->name }}
                                <a class="ml-auto" href="#">All {{ $wine->type->name }} wines</a>
                            </div>
                        </div>
                    </div>
                    {{--Castes--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <strong class="text-gray-dark">Castes</strong>
                            @forelse($wine->castes as $caste)
                                @if($loop->last)
                                    <a href="#">{{ $caste->name }}</a>.
                                @else
                                    <a href="#">{{ $caste->name }}</a>,
                                @endif
                            @empty
                                {{ $wine->name }} has no castes.
                            @endforelse
                        </div>
                    </div>
                    {{--Food Pairing--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <strong class="text-gray-dark">Combines well with</strong>
                            @forelse($wine->food_pairing as $pairing)
                                @if($loop->last)
                                    <a href="#">{{ $pairing->name }}</a>.
                                @else
                                    <a href="#">{{ $pairing->name }}</a>,
                                @endif
                            @empty
                                {{ $wine->name }} has no food pairs.
                            @endforelse
                        </div>
                    </div>
                    {{--Acidity/Body/Color--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 border-bottom">
                            <div class="d-flex justify-content-around w-100">
                                <div class="d-flex flex-column justify-content-around align-items-center">
                                    <span class="small pb-2 text-secondary text-center">Acidity Level</span>
                                    <img src="{{ asset($wine->acidity->thumbnail) }}" alt="{{ $wine->acidity->name }}">
                                    <span class="small text-center pt-2 text-secondary">{{ $wine->acidity->name }}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-around align-items-center">
                                    <span class="small pb-2 text-secondary text-center">Body Type</span>
                                    <img class="text-center" src="{{ asset($wine->body->thumbnail) }}" alt="{{ $wine->body->name }}">
                                    <span class="small text-center pt-2 text-secondary">{{ $wine->body->name }}</span>
                                </div>
                                <div class="d-flex flex-column justify-content-around align-items-center">
                                    <span class="small pb-2 text-secondary text-center">Color</span>
                                    <img src="{{ asset($wine->color->thumbnail) }}" alt="{{ $wine->color->name }}">
                                    <span class="small text-center pt-2 text-secondary">{{ $wine->color->name }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--Description--}}
                    <div class="media text-muted pt-3">
                        <div class="media-body pb-3 mb-0 lh-125 border-bottom border-gray">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="text-gray-dark"><strong>Description</strong> {{ $wine->description }}</span>
                            </div>
                        </div>
                    </div>
                    {{--All wines from winery--}}
                    <small class="d-block text-right mt-3">
                        <a href="#">See all wines from {{ $wine->winery->name }}</a>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection