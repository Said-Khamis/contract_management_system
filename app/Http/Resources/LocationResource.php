<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationResource extends JsonResource
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
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'settlement' => $this->settlement,
            'ward_id' => $this->ward_id,
            'district_id' => $this->district_id,
            'city_id' => $this->city_id,
            'region_id' => $this->region_id,
            'state_id' => $this->state_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by
        ];
    }
}
