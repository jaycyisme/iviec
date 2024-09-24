<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'name', 'email', 'phone', 'address', 'image', 'banner', 'link_of_company_website', 'business_area', 'employee_quantity'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function recruimentRequirements() {
        return $this->hasMany(RecruitmentRequirement::class)->withTrashed();
    }
}
