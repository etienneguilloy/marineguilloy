<?php
namespace App\Utils;

use Illuminate\Support\Facades\DB;


class PhotoUtils
{
    public static function getPhotoFront(){
        return DB::table('photos')
                        ->leftJoin('albums', 'photos.album_id', '=', 'albums.id')
                        ->leftJoin('categories', 'albums.categorie_id', '=', 'categories.id')
                        ->select(DB::raw('photos.*, categories.id as categorie_id, 0 as isLoad'))
                        ->where('albums.actif', '=', 1)
                        ->get();
    }
    
}
