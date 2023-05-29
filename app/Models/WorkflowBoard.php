<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowBoard extends Model
{
    use HasFactory;

    protected $fillable = [
        'workflow_template_id',
        'name',
        'order'
    ];
}
