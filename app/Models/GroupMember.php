<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    use HasFactory;
    protected $table = 'group_members';
    protected $fillable = [
        'name',
        'is_status',
        'is_priority',
        'type'
    ];
    public function members(){
    	return $this->hasMany(Member::class,'group_id','id');
    }
}
