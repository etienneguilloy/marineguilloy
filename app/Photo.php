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
    
    
    
    
    public static function resizeImg($fileOrigin){
      
      // Définition de la largeur et de la hauteur maximale
      $width = 640;
      $height = 640;

      // Cacul des nouvelles dimensions
      list($width_orig, $height_orig) = getimagesize($fileOrigin);

      $ratio_orig = $width_orig/$height_orig;

      if ($width/$height > $ratio_orig) {
         $width = $height*$ratio_orig;
      } else {
         $height = $width/$ratio_orig;
      }

      // Redimensionnement
      $image_p = imagecreatetruecolor($width, $height);
      $image = imagecreatefromjpeg($fileOrigin);
      imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
      
      $pathTemp = tempnam('/tmp', uniqid());
      imagejpeg($image_p, $pathTemp , 100); 
      imagedestroy($image_p);
      
      return file_get_contents($pathTemp);
    }
}
