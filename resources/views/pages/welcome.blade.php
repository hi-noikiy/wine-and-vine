@extends('layouts.master')

@section('content')
    @foreach($countries as $country)
        <p class="ml-3"><span class="flag-icon flag-icon-{{ strtolower($country->cca2) }}"></span> {{ $country->name->common }}</p>
    @endforeach
@endsection