<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeePatchRequest;
use App\Http\Requests\Employee\EmployeePostRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EmployeeResource::collection(
            Employee::paginate(10)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeePostRequest $request)
    {
        $employee = Employee::create(
            $request->validated()
        );

        if ($employee) {
            return new EmployeeResource($employee);
        }

        return \response()->json([
            'status' => false
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeePatchRequest $request, Employee $employee)
    {
        $employee->update(
            $request->validated()
        );

        if ($employee) {
            return new EmployeeResource($employee->refresh());
        }

        return \response()->json([
            'status' => false
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $status = $employee->delete();

        return response()->json(
            [
                'status' => $status
            ],
            $status ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
