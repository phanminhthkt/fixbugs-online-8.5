<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_detail extends Model
{
    use HasFactory;
    protected $table = 'project_detail';
    protected $fillable = [
        'id_project',
        'id_dev',
        'id_sale',
        'id_status_project',
        'id_status_code',
    ];
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('id_dev','id_sale','id_status_code','id_status_project', 'created_by');
    }
}
