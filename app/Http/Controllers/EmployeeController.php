<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('admin.employees.create', compact('companies'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        Employee::create($request->all());

        return redirect()->route('employees.index')
                         ->with('success', 'Employee created successfully.');
    }

    public function show(string $id)
    {
        $employee = Employee::with('company')->findOrFail($id);
        return view('admin.employees.show', compact('employee'));
    }

    public function edit(string $id)
    {
        $employee = Employee::findOrFail($id);
        $companies = Company::all();
        return view('admin.employees.edit', compact('employee', 'companies'));
    }

    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return redirect()->route('employees.index')
                         ->with('success', 'Employee updated successfully.');
    }

    public function destroy(string $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()->route('employees.index')
                         ->with('success', 'Employee deleted successfully.');
    }
}
