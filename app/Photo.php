<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    /**
     * Get the album that owns the photo.
     */
    public function album()
    {
        return $this->belongsTo('App\Album');
    }
    
}
