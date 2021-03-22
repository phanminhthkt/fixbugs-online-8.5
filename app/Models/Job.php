<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;
    protected $table = 'jobs';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
    ];
    public function member(){
    	return $this->hasMany(Member::class,'is_job','id');
    }
}
