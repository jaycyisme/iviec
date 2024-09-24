<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'image' => $this->image,
            'banner' => $this->banner,
            'link_of_company_website' => $this->link_of_company_website,
            'business_area' => $this->business_area,
            'employee_quantity' => $this->business_area,
        ];
    }
}
