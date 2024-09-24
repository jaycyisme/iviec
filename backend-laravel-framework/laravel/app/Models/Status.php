<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'status';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function recruitmentRequirements() {
        return $this->hasMany(RecruitmentRequirement::class)->withTrashed();
    }

    public function jobNews() {
        return $this->hasMany(JobNew::class)->withTrashed();
    }

    public function candidateRepositories() {
        return $this->hasMany(CandidateRepository::class)->withTrashed();
    }
}
