<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateRepository extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'candidate_repositories';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'job_new_id', 'status_id', 'cv', 'name', 'email', 'phone', 'dob'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function jobNew() {
        return $this->belongsTo(JobNew::class);
    }
}
