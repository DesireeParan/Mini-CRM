@extends('adminlte::page')

@section('title', __('profile.title'))

@section('content_header')
    <h1>{{ __('profile.title') }}</h1>

@stop

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('profile.user_profile') }}</h3>
                </div>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="first_name">{{ __('profile.first_name') }}</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}">
                        </div>
                        <div class="form-group">
                            <label for="last_name">{{ __('profile.last_name') }}</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}">
                        </div>
                        <div class="form-group">
                            <label for="company_id">{{ __('profile.company') }}</label>
                            <input type="number" class="form-control" id="company_id" name="company_id" value="{{ Auth::user()->company_id }}" readonly>
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
                            <button type="submit" class="btn btn-primary">{{ __('profile.update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
