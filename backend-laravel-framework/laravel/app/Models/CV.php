<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CV extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cvs';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'image'];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
