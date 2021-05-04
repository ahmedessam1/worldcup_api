<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PDF extends Model
{
    protected $appends = ['pdf_full_path'];

    public function getPDFFullPathAttribute()
    {
        return url("/public/uploads/".$this->attributes['file']);
    }
}
