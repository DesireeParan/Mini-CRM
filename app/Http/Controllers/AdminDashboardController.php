<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalCompanies = Company::count();
        $totalEmployees = Employee::count();
        $companies = Company::with('employees')->get();
        $recentCompanies = Company::orderBy('created_at', 'desc')->take(5)->get();

        // Prepare data for the line chart
        $chartLabels = Company::selectRaw('DATE(created_at) as date')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('date');

        $chartDataCompanies = Company::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count');

        $chartDataEmployees = Employee::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('count');

        return view('admin.dashboard', compact('totalCompanies', 'totalEmployees', 'companies', 'recentCompanies', 'chartLabels', 'chartDataCompanies', 'chartDataEmployees'));
    }
}
