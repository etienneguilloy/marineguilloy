<?php

namespace App\Observers;

use App\Album;
use Illuminate\Support\Facades\Storage;

class AlbumObserver
{
    /**
     * Listen to the Album created event.
     *
     * @param  \App\Album  $album
     * @return void
     */
    public function created(Album $album)
    {
        //
    }

    /**
     * Listen to the Album deleting event.
     *
     * @param  \App\Album  $album
     * @return void
     */
    public function deleting(Album $album)
    {
        Storage::disk('public')->deleteDirectory('photos/'.$album->id);
    }
}