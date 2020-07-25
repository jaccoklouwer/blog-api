<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Blog extends Model
{
    /** @var array  */
    protected $guarded = [];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    /**
     *
     */
    public function setSlug()
    {
        $this->slug = str_replace(' ', '-', $this->title);
    }

}
