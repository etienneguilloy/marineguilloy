<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Utils\CategorieUtils;
use App\Utils\AlbumUtils;
use App\Utils\PhotoUtils;


class AccueilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        /*$photos = PhotoUtils::getPhotoFront();              
        $categories = CategorieUtils::getCategoriesAlbumsActif();
        $albums = AlbumUtils::getAlbumsActif();
        
        if($photos){
            foreach($photos as $key=>$photo){
              $photo->src = asset('storage/'.$photo->url.'/full.jpeg');
              $photo->srcMin = asset('storage/'.$photo->url.'/min.jpeg');
              
              list($width, $height) = getimagesize($photo->src);
              $photo->w = $width;
              $photo->h = $height;
            }
        }*/
        return view('welcome');
    }
    
    
}
