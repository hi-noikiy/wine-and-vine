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
            <li class="breadcrumb-item active" aria-current="page">{{ $profile_user->username }}</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        {{--Left side--}}
        <div class="col-sm-4 py-2">
            {{--Settings--}}
            <div class="card">
                <div class="card-header">Settings</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="clickable pt-0 list-group-item {{ set_active('user/@'.$profile_user->username, 'text-primary') }}">
                            Profile
                        </li>
                        <li class="clickable pb-0 list-group-item">Security</li>
                    </ul>
                </div>
            </div>

            {{--Billing--}}
            <div class="card mt-3">
                <div class="card-header">Billing</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="clickable pt-0 list-group-item">Payment Method</li>
                        <li class="clickable mb-0 list-group-item">Invoices</li>
                    </ul>
                </div>
            </div>
        </div>

        {{--Right Side--}}
        <div class="col-sm-8 py-2">
            {{--Profile Photo--}}
            <div class="card">
                <div class="card-header">Profile Photo</div>
                <div class="card-body text-center">
                    <img src="{{ asset($profile_user->avatar) }}" class="rounded-circle img-thumbnail">
                </div>
            </div>

            {{--Contact Information--}}
            <div class="card mt-3">
                <div class="card-header">Contact Information</div>
                <div class="card-body">
                    <form>
                        @csrf

                        {{--First Name--}}
                        <div class="row form-group">
                            <div class="col-sm-4 col-form-label text-md-right">
                                <label for="first-name">First Name</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="first-name"
                                       id="first-name"
                                       aria-describedby="first-name-help"
                                       value="{{ $profile_user->first_name }}"
                                       required
                                >
                                @if ($errors->has('first-name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--Last Name--}}
                        <div class="row form-group">
                            <div class="col-sm-4 col-form-label text-md-right">
                                <label for="last-name">Last Name</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="text"
                                       class="form-control"
                                       name="last-name"
                                       id="last-name"
                                       aria-describedby="last-name-help"
                                       value="{{ $profile_user->last_name }}"
                                       required
                                >
                                @if ($errors->has('last-name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--Email Name--}}
                        <div class="row form-group">
                            <div class="col-sm-4 col-form-label text-md-right">
                                <label for="email">Email</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="email"
                                       class="form-control"
                                       name="email"
                                       id="email"
                                       aria-describedby="email-help"
                                       value="{{ $profile_user->email }}"
                                       required
                                >
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{--Username--}}
                        <div class="row form-group">
                            <div class="col-sm-4 col-form-label text-md-right">
                                <label for="username">Username</label>
                            </div>
                            <div class="col-sm-8">
                                <input type="email"
                                       class="form-control"
                                       name="username"
                                       id="username"
                                       aria-describedby="email-help"
                                       value="{{ $profile_user->username }}"
                                       required
                                >
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{--Other Information--}}
            <div class="card mt-3">
                <div class="card-header">Other Information</div>
                <div class="card-body">
                    <form>
                        @csrf

                        @if($profile_user->description)
                            {{--Description--}}
                            <div class="form-group row">
                                <div class="col-sm-4 col-form-label text-md-right">
                                    <label for="description">Description</label>
                                </div>
                                <div class="col-sm-8">
                                <textarea name="description"
                                          id="description"
                                          rows="3"
                                          class="form-control"
                                >{{ $profile_user->description }}</textarea>

                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{--Ratings--}}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-md-right">Who can see your ratings</label>

                            <div class="col-md-6">
                                @foreach($ratings as $rating)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="rating-visibility"
                                               id="rating-visibility-{{ $rating->id }}"
                                               value="{{ $rating->id }}"
                                               required
                                                {{ $rating->id === $profile_user->rating->id ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label"
                                               for="rating-visibility-{{ $rating->id }}">{{ $rating->name }}</label>
                                    </div>
                                @endforeach

                                @if ($errors->has('rating-visibility'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('rating-visibility') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection