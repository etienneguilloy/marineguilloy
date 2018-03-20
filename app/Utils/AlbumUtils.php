<?php
namespace App\Utils;

use Illuminate\Support\Facades\DB;


class AlbumUtils
{
    public static function getAlbumsActif(){
        return DB::table('albums')
                            ->select('albums.id', 'albums.libel', 'albums.categorie_id')
                            ->where('albums.actif', '=', 1)
                            ->get(); 
    }
    
}
