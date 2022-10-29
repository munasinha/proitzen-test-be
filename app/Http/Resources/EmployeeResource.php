<?php

namespace App\Http\Resources;

use App\Http\Resources\TitleResource;
use App\Http\Resources\SalaryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'emp_no'        => $this->emp_no,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'gender'        => $this->gender,
            'hire_date'     => $this->hire_date,
            'birth_date'    => $this->birth_date,
            'salaries'      => SalaryResource::collection($this->salaries),
            'titles'        => TitleResource::collection($this->titles),
        ];
    }
}
