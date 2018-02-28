<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
  
    /**
    * Get all the categorie with url route to albums
    * @return json vor view
    */
    public static function allForAdministration(){
      $categories = self::with('albums')->get();
      if($categories){
        foreach($categories as $categorie){
          foreach($categorie->albums as $album){
            $album->albumRoute = route('albumHome', ['id' => $album->id]);
            
            $photosVitrine = $album->photos()->where('vitrine', 1)->limit(1)->get();
            $urlFullVitrine = '';
            $urlFullVitrine = asset('storage/photos/no_picture.jpg');
            if($photosVitrine){
              foreach($photosVitrine as $photoVitrine){
                $urlFullVitrine = asset('storage/'.$photoVitrine->url);
              }
            }
            $album->photoVitrine = $urlFullVitrine;
          }
        }
      }
      return $categories;
    }
    
    
    /**
     * Get the albums for categorie.
     */
    public function albums()
    {
        return $this->hasMany('App\Album');
    }
}
