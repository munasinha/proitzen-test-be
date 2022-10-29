<?php

namespace App\Services;

use Illuminate\Support\Arr;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\EmployeeResourceCollection;
use App\Repositories\Contracts\TitleRepositoryInterface;
use App\Repositories\Contracts\SalaryRepositoryInterface;
use App\Repositories\Contracts\EmployeeRepositoryInterface;

final class EmployeeManagementService
{
    /**
     * @var EmployeeRepositoryInterface
     */
    private $employeeRepo;

    /**
     * @var SalaryRepositoryInterface
     */
    private $salaryRepo;

    /**
     * @var TitleRepositoryInterface
     */
    private $titleRepo;


    public function __construct(
        EmployeeRepositoryInterface $employeeRepo,
        SalaryRepositoryInterface $salaryRepo,
        TitleRepositoryInterface $titleRepo,
    )
    {
        $this->employeeRepo = $employeeRepo;
        $this->salaryRepo = $salaryRepo;
        $this->titleRepo = $titleRepo;
    }


    /**
     * Get All Employees
     *
     * @return EmployeeResourceCollection
     */
    public function getAllEmployees(): EmployeeResourceCollection
    {
        $allEmployees = $this->employeeRepo->findAllWithPaginate(15);
        return new EmployeeResourceCollection($allEmployees);
    }


    /**
     * Get Employee Details
     *
     * @param int $id
     * @return EmployeeResource
     */
    public function getEmployeeDetails(int $id): EmployeeResource
    {
        $employee = $this->employeeRepo->find($id);
        return new EmployeeResource($employee->load(['salaries', 'titles']));
    }


    /**
     * Create new Employee
     *
     * @param array $data
     * @return EmployeeResource
     */
    public function createNewEmployee(array $data): EmployeeResource
    {
        // create employee with details
        $employeeData = Arr::only($data, ['first_name', 'last_name', 'gender', 'hire_date', 'birth_date']);
        $employee = $this->employeeRepo->create($employeeData);

        // create salary for new employee
        $salaryData = [
            'emp_no'    => $employee->emp_no,
            'salary'    => Arr::get($data, 'salary'),
            'from_date' => now()
        ];
        $this->salaryRepo->create($salaryData);

        // create title for new employee
        $titleData = [
            'emp_no'    => $employee->emp_no,
            'title'     => Arr::get($data, 'title'),
            'from_date' => now()
        ];
        $this->titleRepo->create($titleData);

        // refresh model with new relationships
        $employee->refresh();

        return new EmployeeResource($employee->load(['salaries', 'titles']));
    }

}
