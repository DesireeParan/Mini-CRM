@extends('adminlte::page')

@section('title', __('password.title'))

@section('content_header')
    <h1>{{ __('profile.title') }}</h1>

@stop

@section('content')
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('password.title') }}</h3>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="current_password">{{ __('password.current_password') }}</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        <div class="form-group">
                            <label for="new_password">{{ __('password.new_password') }}</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">{{ __('password.confirm_password') }}</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">{{ __('password.update') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
