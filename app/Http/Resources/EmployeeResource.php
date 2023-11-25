<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'employee_id' => $this->employee_id,
            'nin' => $this->nin,
            'employment_date' => $this->employment_date,
            'duty_station' => $this->duty_station,
            'designation_id' => $this->designation_id,
            'department_id' => $this->department_id
        ];
    }
}
