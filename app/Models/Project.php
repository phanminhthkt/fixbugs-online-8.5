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
    public function dev(){
        return $this->belongsTo(Member::class, 'project_detail', 'id_dev', 'id_project');
    }
    public function sale(){
        return $this->belongsTo(Member::class, 'project_detail', 'id_sale', 'id_project');
    }
    public function status_project(){
        return $this->belongsTo(Status::class, 'project_detail', 'id_status_project', 'id_project');
    }
    public function status_code(){
        return $this->belongsTo(Status::class, 'project_detail', 'id_status_code', 'id_project');
    }
}
