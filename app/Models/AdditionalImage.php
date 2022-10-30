<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
