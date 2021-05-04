<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $appends = ['image_full_path', 'readable_date'];

    public function getImageFullPathAttribute()
    {
        return url("/public/uploads/".$this->attributes['image']);
    }

    public function getReadableDateAttribute()
    {
        $date = \Carbon\Carbon::parse($this->attributes['created_at']);
        return $date->diffForHumans();
    }

    public function media()
    {
        return $this->hasMany('App\Media', 'model_id');
    }

    public function tags()
    {
        return $this->hasMany('App\Tags', 'model_id');
    }
}
