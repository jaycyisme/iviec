<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecruitmentRequirementResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'news_quantity' => $this->news_quantity,
            'company' => $this->company,
            'status' => $this->status->name,
            'quantity_needed' => $this->quantity_needed,
            'quantity_recruited' => $this->quantity_recruited,
            'candidate_quantity' => $this->candidate_quantity,
            'created_at' => $this->created_at,
            'expired_date' => $this->expired_date,
        ];
    }
}
