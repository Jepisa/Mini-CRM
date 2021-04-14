<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('created_at', 'desc')->paginate(10);
        return view('employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();

        if($companies->count() > 0)
        {
            return view('employee.create', compact('companies'));
        }
        else
        {
            $notification = "There are no companies yet, you need to create at least one";
            session()->flash('notification', $notification);

            return redirect()->route('company.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|',
            'lastname' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => 'required|email|unique:employees,email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:16',
        ]);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->lastname = $request->lastname;
        $employee->company_id = $request->company_id;
        $employee->slug = Str::slug($employee->name.' '.$employee->lastname);
        $employee->email = $request->email;
        $employee->phone = $request->phone;

        $employee->save();

        return redirect()->route('employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($employeeName)
    {
        $employee = Employee::firstWhere('slug', $employeeName);
        
        return view('employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeName)
    {
        $employee = Employee::firstWhere('slug', $employeeName);
        $companies = Company::all();
        return view('employee.edit', compact('employee', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $employeeName)
    {
        $employee = Employee::where('slug', $employeeName)->firstOrFail();
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => 'required|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'email' => ['required', 'email', Rule::unique('employees')->ignore($employee->id)],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:17',
        ]);

        
        
        $employee->name = $request->name;
        $employee->lastname = $request->lastname;
        $employee->slug = Str::slug($employee->name.' '.$employee->lastname);
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->phone = $request->phone;

        $employee->update();

        return redirect()->route('employee.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeName)
    {
        $employee = Employee::firstWhere('slug', $employeeName);

        $employee->delete();

        return redirect()->back();
    }
}
