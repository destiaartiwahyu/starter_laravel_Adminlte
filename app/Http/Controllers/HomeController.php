<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Employees;

class HomeController extends Controller
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
        $com = Company::get();
        $emp = Employees::with('Company')->get();
        $company = $com->take(5);
        $employee = $emp->take(5);
        $company_count = $com->count();
        $employee_count = $emp->count();
        return view('user.home', compact('company', 'employee', 'company_count', 'employee_count'));
    }
}
