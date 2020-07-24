<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $guarded = [];

    public function author()
    {
        return $this->belongsTo(User::class)
    }

    public function slug()
    {
        return str_replace(' ', '-', $this->title);
    }
}
