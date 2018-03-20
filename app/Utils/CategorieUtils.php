<?php
namespace App\Utils;

use Illuminate\Support\Facades\DB;


class CategorieUtils
{
    public static function getCategoriesAlbumsActif(){
        return DB::table('categories')
                            ->join('albums', 'categories.id', '=', 'albums.categorie_id')
                            ->select('categories.id', 'categories.libel')
                            ->where('albums.actif', '=', 1)
                            ->groupBy('categories.id')
                            ->get(); 
    }
    
}
