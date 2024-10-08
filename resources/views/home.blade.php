@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <p>Welcome to the user dashboard. Here you can find all the information you need.</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-user"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Profile</span>
                                        <span class="info-box-number">View and edit your profile</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fas fa-cog"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Settings</span>
                                        <span class="info-box-number">Manage your settings</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="info-box">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-bell"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Notifications</span>
                                        <span class="info-box-number">Check your notifications</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p>Need help? <a href="#">Contact support</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .info-box {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .info-box-icon {
            font-size: 2rem;
            padding: 10px;
        }
        .info-box-content {
            margin-left: 10px;
        }
    </style>
@stop
