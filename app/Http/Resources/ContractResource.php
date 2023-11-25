<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
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
            'title' => $this->title,
            'reference_no' => $this->reference_no,
            'date_signed' => $this->date_signed,
            'signed_place' => $this->signed_place,
            'ratification_date' => $this->ratification_date,
            'duration' => $this->duration,
            'is_amended' => $this->is_amended,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by
        ];
    }
}
