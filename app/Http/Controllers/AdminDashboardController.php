<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;

class AdminDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalCompanies = Company::count();
        $companies = Company::with('employees')->get();
        $recentCompanies = Company::orderBy('created_at', 'desc')->take(5)->get();


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

        $recentLogins = $this->getRecentLogins();

        return view('admin.dashboard', compact('totalEmployees', 'totalCompanies', 'companies', 'recentCompanies', 'chartLabels', 'chartDataCompanies', 'chartDataEmployees', 'recentLogins'));
    }

    /**
     * Fetch recent logins data.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function getRecentLogins()
    {
        // Fetch recent logins from the users table
        return User::orderBy('last_login_at', 'desc')->take(1)->get(['first_name', 'last_login_at', 'device', 'browser']);
    }
}
