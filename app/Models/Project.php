<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    const STATUS = [
        'published' => 'Published',
        'draft' => 'Draft'
    ];

    /**
     * Model image url
     * @return mixed
     */
    public function mainImageUrl()
    {
        return $this->image
            ? Storage::disk('projects')->url($this->image)
            : url('/svg/placeholder.svg');
    }

    public function additionalImages()
    {
        return $this->hasMany(AdditionalImage::class);
    }
}
