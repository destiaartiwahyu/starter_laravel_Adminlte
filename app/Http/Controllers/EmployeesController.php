<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeesRequest;
use App\Http\Requests\UpdateEmployeesRequest;
use Illuminate\Http\Request;
use App\Models\Employees;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         //medapatkan semua data employee dan company yang berkaitan
         $employee = Employees::with('Company');
         //jika ada request ajax maka yang direturn adalah datatables
         if ($request->ajax()) {
             return Datatables::of($employee)
                 ->addColumn('company_name', function($employee)
                 {
                    return $employee->Company->name;
                 })
                 ->addIndexColumn()
                 ->addColumn('action', function ($row) {
                     //button, edit dan hapus                
                     $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" value="' . $row->id . '" class="mr-1 edit btn btn-primary btn-sm editEmployee"><i class="fa fa-edit"></i></a>';
 
                     $btn = $btn . ' <a href="javascript:void(0)" data-id="' . $row->id . '" value="' . $row->id . '" class="btn btn-danger btn-sm deleteEmployee"><i class="fa fa-trash"></i></a>';
 
                     return $btn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
         }
         $company = Company::get();

         return view('user.employee.employee', compact('employee', 'company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_nm'=>'required',
            'last_nm'=>'required',
            // 'email'=>'email',
        ]);
        $company = Employees::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'first_nm' => $request->input('first_nm'),
                'last_nm' => $request->input('last_nm'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'company_id' => $request->input('company_id'),
            ]
        );
       
        return response()->json(['success' => 'Employee saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee_detail = Employees::find($id);
        return response()->json($employee_detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeesRequest  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeesRequest $request, Employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Employees::where('id', $id)->firstOrFail();
        $data->find($id)->delete();
        return response()->json(['success'=>'Employee deleted successfully.']);
    }
}
