<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
  
    public static function albumForAdministration($id){
      $album = self::find($id);
      if($album){
        $photos = $album->photos()->orderBy('vitrine','=',1, 'desc')->orderBy('created_at', 'desc')->get();
        if($photos){
          foreach($photos as $photo){
            $photo->urlFull = asset('storage/'.$photo->url.'/min.jpeg');
          }
        }
        $album->photos = $photos;
      }
      return $album;
    }
    
    /**
     * Get the categorie that owns the album.
     */
    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }
    
    /**
     * Get the photos for album.
     */
    public function photos()
    {
        return $this->hasMany('App\Photo');
    }
}
