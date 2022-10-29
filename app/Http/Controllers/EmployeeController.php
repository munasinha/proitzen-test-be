<?php

namespace App\Http\Controllers;

use Exception;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployeeRequest;
use App\Services\EmployeeManagementService;
use App\Http\Requests\UpdateEmployeeRequest;

class EmployeeController extends Controller
{
    use ApiResponser;
    /**
     * @var EmployeeManagementService
     */
    private $employeeService;


    public function __construct(
        EmployeeManagementService $employeeService
    ) {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        try {
            $employees =  $this->employeeService->getAllEmployees();
            return $this->successResponse($employees);
        } catch (Exception $e) {
            return $this->errorResponse('Something went wrong while getting data!',500, $e->getMessage());
        }
    }

    public function employeeDetails($id)
    {
        try {
            $employee =  $this->employeeService->getEmployeeDetails($id);
            return $this->successResponse($employee);
        } catch (Exception $e) {
            return $this->errorResponse('Something went wrong while getting data!',500, $e->getMessage());
        }
    }

    public function store(StoreEmployeeRequest $request)
    {
        try {
            $employee =  $this->employeeService->createNewEmployee($request->all());
            return $this->successResponse($employee);
        } catch (Exception $e) {
            return $this->errorResponse('Something went wrong while storing employee data!', $e->getMessage(), 500);
        }
    }

}
