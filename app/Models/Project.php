<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';
    protected $fillable = [
        'name',
        'contract_code',
        'link_design',
        'note',
        'file',
        'is_status',
        'is_priority',
    ];
    public function members(){
        return $this->belongsToMany(Member::class)->withTimestamps();
    }
    public function dev(){
        return $this->belongsToMany(Member::class)->where('group_id','=',1);
    }
    public function saler(){
        return $this->belongsToMany(Member::class)->where('group_id','=',2);
    }
    public function status(){
        return $this->belongsToMany(Status::class)->withTimestamps();
    }
    public function status_code(){
        return $this->belongsToMany(Status::class)->where('group_id','=',1);
    }
    public function status_project(){
        return $this->belongsToMany(Status::class)->where('group_id','=',2);
    }
}
