<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = Employee::latest()->paginate(5);
    
        return view('employees.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //employee input validation
        $request->validate([
            'emp_name' => 'required',
            'emp_email' => 'required|unique:employees|email',
            'emp_phone' => 'required|unique:employees|digits_between:9,10',
            'emp_route' => 'required',
            'emp_joined_at' => 'required',            
        ],[
            'emp_name.required' => 'Name field is required.',
            'emp_email.required' => 'Email field is required.',
            'emp_email.email' => 'Email field must be email address.',
            'emp_email.unique' => 'Email already exsits.',
            'emp_phone.required' => 'Phone field is required.',
            'emp_phone.unique' => 'Telephone no already exsits.',
            'emp_phone.numeric' => 'Phone field must contain 10 digits.',
            'emp_phone.digits_between' => 'Phone field must contain 10 digits.',            
            'emp_route.required' => 'Please select a route.',
            'emp_joined_at.required' => 'Please select joined date.',
        ]);
    
        $data = $request->all();

        //Changing date format
        $data['emp_joined_at'] = Carbon::createFromFormat('d-m-Y', $request->emp_joined_at)->format('Y/m/d');

        Employee::create($data);
     
        return redirect()->route('employees.index')
                        ->with('success','Employee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
             
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //employee input validation and custom error messages
        $request->validate([
            'emp_name' => 'required',
            'emp_email' => 'required|email|unique:employees,emp_email,'.$employee->id.',id',
            'emp_phone' => 'required|digits_between:9,10|unique:employees,emp_phone,'.$employee->id.',id',
            'emp_route' => 'required',
            'emp_joined_at' => 'required',            
        ],[
            'emp_name.required' => 'Name field is required.',
            'emp_email.required' => 'Email field is required.',
            'emp_email.email' => 'Email field must be email address.',
            'emp_email.unique' => 'Email already exsits.',
            'emp_phone.required' => 'Telphone field is required.',
            'emp_phone.unique' => 'Telephone no already exsits.',
            'emp_phone.numeric' => 'Telephone field must contain 10 digits.',
            'emp_phone.digits_between' => 'Telephone field must contain 10 digits.',            
            'emp_route.required' => 'Please select a route.',
            'emp_joined_at.required' => 'Please select joined date.',
        ]);
    

        $data = $request->all();

        //Changing date format
        $data['emp_joined_at'] = Carbon::createFromFormat('d-m-Y', $request->emp_joined_at)->format('Y/m/d');

        $employee->update($data);
    
        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
    
        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }

    /**
     * Retrive the specified resource.
     * @param $id;
     * @return json response api
     */
    public function find($id){

        $employee = Employee::find($id);

        if(empty($employee)){
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        //Change the date format as per view
        return response()
            ->json([
                'id' => $employee->id,
                'emp_name' => $employee->emp_name, 
                'emp_email' => $employee->emp_email,
                'emp_phone' => $employee->emp_phone,
                'emp_route' => $employee->emp_route,
                'emp_joined_at' => Carbon::createFromFormat('Y-m-d', $employee->emp_joined_at)->format('d-M-Y'),
                'emp_comment' => $employee->emp_comment,
            ], 200);

    }
}
