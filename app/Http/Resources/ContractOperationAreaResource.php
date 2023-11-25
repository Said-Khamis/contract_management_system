<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractOperationAreaResource extends JsonResource
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
            'details' => $this->details,
            'contract_id' => $this->contract_id,
            'contract_operation_area_id' => $this->contract_operation_area_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by
        ];
    }
}
