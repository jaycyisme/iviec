<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecruitmentRequirement extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'recruitment_requirements';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'quantity_needed', 'quantity_recruited', 'status_id', 'company_id', 'expired_date', 'description'];

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function jobNews() {
        return $this->hasMany(JobNew::class)->withTrashed();
    }
}
