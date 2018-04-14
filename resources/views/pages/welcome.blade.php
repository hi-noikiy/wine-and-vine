@extends('layouts.master')

@section('left-content')
Left
@endsection

@section('content')
    <div class="">
        <button class="text-white py-2 px-4 rounded-lg bg-teal" @click="$modal.show('shopping-cart')">Open Modal</button>
    </div>
@endsection

@section('right-content')

@endsection