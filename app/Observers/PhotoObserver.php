<?php

namespace App\Observers;

use App\Photo;
use Illuminate\Support\Facades\Storage;

class PhotoObserver
{
    /**
     * Listen to the Photo created event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function created(Photo $photo)
    {
        //
    }

    /**
     * Listen to the Photo deleting event.
     *
     * @param  \App\Photo  $photo
     * @return void
     */
    public function deleting(Photo $photo)
    {
        Storage::disk('public')->delete($photo->url);
        // Storage::disk('public')->delete($photo->urlMiniature);
    }
}