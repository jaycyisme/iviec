<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalaryType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'salary_types';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public function jobNew() {
        return $this->belongsTo(JobNew::class);
    }
}
