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
    public function group_member(){
        return $this->belongsToMany(Member::class, 'member_project', 'member_id', 'project_id');
    }
    public function group_status(){
        return $this->belongsToMany(Status::class, 'project_status', 'status_id', 'project_id');
    }
    public function member(){
        return $this->belongsTo(Member::class, 'member_project', 'member_id', 'project_id');
    }
    public function status(){
        return $this->belongsTo(Status::class, 'project_status', 'status_id', 'project_id');
    }
}
