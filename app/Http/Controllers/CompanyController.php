<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use App\Models\Company;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
          //medapatkan semua data company
          $company = Company::all();
          //jika ada request ajax maka yang direturn adalah datatables
          if ($request->ajax()) {
              return Datatables::of($company)
                  ->addIndexColumn()
                  ->addColumn('action', function ($row) {
                      //button edit dan hapus
                      $btn = '<a href="javascript:void(0)" data-id="' . $row->id . '" value="' . $row->id . '" class="mr-1 edit btn btn-primary btn-sm editCompany"><i class="fa fa-edit"></i></a>';
  
                      $btn = $btn . ' <a href="javascript:void(0)" data-id="' . $row->id . '" value="' . $row->id . '" class="btn btn-danger btn-sm deleteCompany"><i class="fa fa-trash"></i></a>';
  
                      return $btn;
                  })
                  ->rawColumns(['action'])
                  ->make(true);
          }
  
          return view('user.company.company', compact('company'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            // 'email'=>'email'
        ]);
        $company = Company::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'address' => $request->input('address')
            ]
        );
       
        return response()->json(['success' => 'Company saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company_detail = Company::find($id);
        return response()->json($company_detail);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Company::where('id', $id)->firstOrFail();
        $data->find($id)->delete();
        return response()->json(['success'=>'Company deleted successfully.']);
    }
}
