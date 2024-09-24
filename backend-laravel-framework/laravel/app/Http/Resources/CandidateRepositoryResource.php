<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CandidateRepositoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user_id' => $this->user_id,
            'status' => $this->status->name,
            'cv' => $this->cv,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'dob' => $this->dob,
        ];
    }
}
