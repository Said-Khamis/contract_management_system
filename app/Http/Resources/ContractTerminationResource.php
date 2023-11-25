<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractTerminationResource extends JsonResource
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
            'date_of_termination' => $this->date_of_termination,
            'reasons' => $this->reasons,
            'attachement_id' => $this->attachement_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'contract_id' => $this->contract_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at
        ];
    }
}
