<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'addresses';
    protected $primaryKey = 'id';
    protected $fillable = ['address_detail', 'country', 'province', 'district'];

    public function jobNew() {
        return $this->belongsTo(JobNew::class);
    }
}
