<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobNew extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'job_news';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'candidate_quantity', 'recruitment_requirement_id', 'status_id', 'job', 'position', 'job_description',
                            'requirement', 'benefit', 'working_form', 'level', 'salary_type_id', 'salary_start', 'salary_end', 'year_of_experience',
                            'gender', 'language'];


    public function candidateRepositories() {
        return $this->hasMany(CandidateRepository::class)->withTrashed();
    }

    public function addresses() {
        return $this->hasMany(Address::class)->withTrashed();
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function salaryType() {
        return $this->belongsTo(SalaryType::class);
    }

    public function recruitmentRequirement() {
        return $this->belongsTo(RecruitmentRequirement::class);
    }
}
