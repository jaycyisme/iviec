<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkingForm extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'working_forms';
    protected $primaryKey = 'id';
    protected $fillable = ['name'];
}
