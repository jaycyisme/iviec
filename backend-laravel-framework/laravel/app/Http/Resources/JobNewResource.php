<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobNewResource extends JsonResource
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
            'title' => $this->title,
            'candidate_quantity' => $this->candidate_quantity,
            'status' => $this->status,
            'job' => $this->job,
            'position' => $this->position,
            'job_description' => $this->job_description,
            'requirement' => $this->requirement,
            'benefit' => $this->benefit,
            'working_form' => $this->working_form,
            'level' => $this->level,
            'salary_type' => $this->salary_type,
            'salary_start' => $this->salary_start,
            'salary_end' => $this->salary_end,
            'year_of_experience' => $this->year_of_experience,
            'gender' => $this->gender,
            'language' => $this->language,
            'recuitment_requirement' => new RecruitmentRequirementResource($this->recruitmentRequirement),
            'candidate_repositories' => CandidateRepositoryResource::collection($this->candidateRepositories),
        ];
    }
}
