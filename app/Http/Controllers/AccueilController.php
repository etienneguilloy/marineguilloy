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
        return view('welcome');
    }

    public function categories(){
        $categories = CategorieUtils::getCategoriesAlbumsActif();
        return response()->json($categories);
    } 

    public function albums(){
        $albums = AlbumUtils::getAlbumsActif();
        return response()->json($albums);
    }

    public function photos(){
        $photos = PhotoUtils::getPhotoFront();
        if($photos){
            foreach($photos as $key=>$photo){
              $photo->src = asset('storage/'.$photo->url.'/full.jpeg');
              $photo->srcMin = asset('storage/'.$photo->url.'/min.jpeg');
              
              list($width, $height) = getimagesize($photo->src);
              $photo->w = $width;
              $photo->h = $height;
            }
        }
        return response()->json($photos);
    }
    
    
}
