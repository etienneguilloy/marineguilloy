<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Album;

class AlbumController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    /**
     * Show content of album
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id){
        $album = Album::albumForAdministration($id);
        
        abort_if(!$album, 404);
        
        return view('administration/album/albumHome', ['album' => $album->toJson()]);
    }
    
    /**
     * Add a new album
     *
     * @return \Illuminate\Http\Response
     */
    public function albumAdd(Request $request){
      
      $album = new Album;
      $album->libel = ucfirst(strtolower($request->input('libel')));
      $album->categorie_id = $request->input('categorie_id');
      $album->save();
      
      $album->albumRoute = route('albumHome', ['id' => $album->id]);
      $album->photoVitrine = asset('storage/photos/no_picture.jpg');

      return response()->json($album->toJson());
    }
    
    
    public function albumDelete($id){
      
      $album = Album::find($id);
      
      if($album->delete()){
        $code_response = 200;
        $msg = route('categorieHome');
      }
      else{
        $code_response = 400;
        $msg = 'Une erreur est survenue';
      }
      
      
      return response(json_encode(array('msg'=>$msg)), $code_response);
    }
    
    public function albumEdit(Request $request, $id){
      $album = Album::find($id);
      
      $inputs = $request->all();
      if($inputs){
        foreach($inputs as $key=>$input){
          if(isset($album->$key)){
            $album->$key = $input;
          }
        }
      }
      
      $msg = '';
      if($album->save()){
        $code_response = 204;
      }
      else{
        $code_response = 400;
        $msg = 'Une erreur est survenue';
      }
      
      return response(array('msg'=>json_encode($msg)), $code_response);
    }
}
