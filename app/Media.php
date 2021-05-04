<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    protected $appends = ['full_path'];

    public function getFullPathAttribute()
    {
        return url("/public/uploads/".$this->attributes['file']);
    }
}
