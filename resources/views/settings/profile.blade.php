@extends('adminlte::page')

@section('title', __('profile.title'))

@section('content_header')
    <h1>{{ __('profile.title') }}</h1>
@stop

@section('content')
    <div class="container" style="min-height: 80vh;">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3" style="border: 1px solid #ddd;">
                    <div class="card-header" style="background-color: white;">
                        <h3 class="card-title"><strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong></h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 text-center" style="border-right: 1px solid #ddd;">
                                <h4>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                                <div class="form-group">
                                    <img src="{{ Auth::user()->profile_photo_url ?? asset('img/user.jpg') }}" alt="User profile picture" class="img-circle elevation-2" style="width: 150px; height: 150px;">
                                </div>
                                <!-- <div class="form-group">
                                    <label for="profile_photo">{{ __('profile.profile_photo') }}</label>
                                    <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                </div> -->
                                <div class="form-group">
                                    <label for="bio">{{ __('profile.bio') }}</label>
                                    <p>{{ Auth::user()->bio }}</p> <!-- Display the bio text here -->
                                </div>
                            </div>
                            <div class="col-md-8">
                                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name">{{ __('profile.first_name') }}</label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="last_name">{{ __('profile.last_name') }}</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{ __('profile.email') }}</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">{{ __('profile.phone') }}</label>
                                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ Auth::user()->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">{{ __('profile.address') }}</label>
                                        <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="bio">{{ __('profile.bio') }}</label>
                                        <textarea class="form-control" id="bio" name="bio">{{ Auth::user()->bio }}</textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">{{ __('profile.update') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
