@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first-name" class="col-md-4 col-form-label text-md-right">First Name</label>

                                <div class="col-md-6">
                                    <input id="first-name"
                                           type="text"
                                           class="form-control{{ $errors->has('first-name') ? ' is-invalid' : '' }}"
                                           name="first-name"
                                           value="{{ old('first-name') }}"
                                           required
                                           autofocus>

                                    @if ($errors->has('first-name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('first-name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last-name" class="col-md-4 col-form-label text-md-right">Last Name</label>

                                <div class="col-md-6">
                                    <input id="last-name"
                                           type="text"
                                           class="form-control{{ $errors->has('last-name') ? ' is-invalid' : '' }}"
                                           name="last-name"
                                           value="{{ old('last-name') }}"
                                           required>

                                    @if ($errors->has('last-name'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last-name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email"
                                           value="{{ old('email') }}"
                                           required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                    <input id="password"
                                           type="password"
                                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password"
                                           required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm"
                                           type="password"
                                           class="form-control"
                                           name="password_confirmation"
                                           required>
                                </div>
                            </div>

                            {{--TODO: Change country to a SELECT--}}
                            <div class="form-group row">
                                <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>

                                <div class="col-md-6">
                                    <input id="country"
                                           type="text"
                                           class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}"
                                           {{--name="country"--}}
                                           value="{{ old('country') }}"
                                           {{--required--}}
                                    >

                                    @if ($errors->has('country'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right">Who can see your ratings</label>

                                <div class="col-md-6">
                                    @foreach($ratings as $rating)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="rating-visibility"
                                                   id="rating-visibility-{{ $rating->id }}"
                                                   value="{{ $rating->id }}"
                                                   required
                                                   {{ $rating->id === 1 || $rating->name === 'Public' ? 'checked' : '' }}
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

                            <div class="form-group row">
                                <label for="newsletter" class="col-md-4 col-form-label text-md-right">Want to receive
                                    newsletter?</label>

                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="newsletter"
                                               id="newsletter-yes"
                                               value="1"
                                               required
                                               checked
                                        >
                                        <label class="form-check-label" for="newsletter-yes">Yes</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="newsletter"
                                               id="newsletter-no"
                                               value="0"
                                               required
                                        >
                                        <label class="form-check-label" for="newsletter-no">No</label>
                                    </div>

                                    @if ($errors->has('newsletter'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('newsletter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email_offers" class="col-md-4 col-form-label text-md-right">Want to receive
                                    offers?</label>

                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="email-offers"
                                               id="email-offers-yes"
                                               value="1"
                                               required
                                               checked
                                        >
                                        <label class="form-check-label" for="email-offers-yes">Yes</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               type="radio"
                                               name="email-offers"
                                               id="email-offers-no"
                                               value="0"
                                               required
                                        >
                                        <label class="form-check-label" for="email-offers-no">No</label>
                                    </div>

                                    @if ($errors->has('email_offers'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email_offers') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
