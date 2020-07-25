<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    /** @var array  */
    protected $guarded = [];


    /**
     *
     */
    public function setSlug()
    {
        $this->slug = str_replace(' ', '-', $this->title);
    }

}
