<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractPartyResource extends JsonResource
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
            'name' => $this->name,
            'is_main' => $this->is_main,
            'is_home' => $this->is_home,
            'location_id' => $this->location_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by
        ];
    }
}
