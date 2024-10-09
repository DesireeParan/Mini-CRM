@extends('adminlte::page')

@section('title', __('Dashboard'))

@section('content_header')
    <h1>{{ __('Dashboard') }}</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalCompanies }}</h3>
                            <p>{{ __('Total Companies') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <a href="{{ route('companies.index') }}" class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>{{ $totalEmployees }}</h3>
                            <p>{{ __('Total Employees') }}</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('employees.index') }}" class="small-box-footer">{{ __('More info') }} <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-12">
                    <h6>{{ __('Login details') }}</h6>
                    <div class="small-box bg-white ">
                        <div class="inner">
                            <p class="text-center">
                                @foreach($recentLogins as $login)
                                    <div>
                                        Device: {{ $login->device }}<br>
                                        Browser: {{ $login->browser }}<br>
                                        Date: {{ $login->last_login_at }}
                                    </div>
                                @endforeach
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <!-- Line chart -->
            <div class="small-box bg-white p-2">
                <div class="inner">
                    <h6 class="text-center">{{ __('Employees and Companies Over Time') }}</h6>
                    <canvas id="lineChart" style="height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h6>{{ __('Companies') }}</h6>
            <div class="row">
                @foreach($companies as $company)
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-white p-2" data-toggle="modal" data-target="#companyModal{{ $company->id }}" style="cursor: pointer;">
                            <div class="inner text-center">
                                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                                    @if($company->logo)
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }} Logo" style="max-width: 90px; max-height: 90px; object-fit: cover;">
                                    @else
                                        <div style="width: 80px; height: 80px; background-color: white;"></div>
                                    @endif
                                </div>
                                <h5 style="margin-bottom: 10px; font: bold;">{{ $company->name }}</h5>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="companyModal{{ $company->id }}" tabindex="-1" role="dialog" aria-labelledby="companyModalLabel{{ $company->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="background-color: white; color: black;">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="companyModalLabel{{ $company->id }}">{{ $company->name }} {{ __('Employees') }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <ul>
                                            @foreach($company->employees as $employee)
                                                <li>{{ $employee->first_name }} {{ $employee->last_name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h6>{{ __('Recently Added') }}</h6>
            <div class="card">
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($recentCompanies as $company)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $company->name }}
                                <span class="badge badge-primary badge-pill">{{ $company->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var lineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [
                    {
                        label: '{{ __('Employees') }}',
                        data: {!! json_encode($chartDataEmployees) !!},
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    },
                    {
                        label: '{{ __('Companies') }}',
                        data: {!! json_encode($chartDataCompanies) !!},
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1,
                        fill: false
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@stop
