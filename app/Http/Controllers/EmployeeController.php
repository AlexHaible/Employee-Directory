<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function getEmployees()
    {
        return Employee::all();
    }

    public function getPositions()
    {
        return Position::all();
    }

    public function submitNewEmployee(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:200',
            'email'     => 'required|email|unique:employees',
            'phone'     => 'required|integer|min:8',
            'position'  => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $validated = (object) $validator->validated();

        $employeeName       = $validated->name;
        $employeeEmail      = $validated->email;
        $employeePhone      = $validated->phone;
        $employeePosition   = $validated->position;

        $employee = new Employee([
            'name' => $employeeName,
            'email' => $employeeEmail,
            'phone' => $employeePhone,
            'position_id' => $employeePosition,
        ]);
        $employee->save();

        return response()->json(['status' => 'success'], 200);
    }
}
