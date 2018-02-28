<?php

namespace App\Http\Controllers\administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;

use App\Photo;

class PhotoController extends Controller
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
   * Add a new photo
   *
   * @return \Illuminate\Http\Response
   */
  public function photoAdd(Request $request){
    
    if ($request->hasFile('photoFile') && $request->file('photoFile')->isValid()) {
      
      $path = $request->photoFile->store('photos/'.$request->input('album_id'), 'public');
      
      /*$miniature = $request->input('miniature');
      $img = $miniature;
      $img = str_replace('data:image/jpeg;base64,', '', $img);
      $img = str_replace(' ', '+', $img);
      $data = base64_decode($img);
      
      $tabPath = pathinfo($path);
      $filename = $tabPath['filename'];
      
      $pathMin = 'photos/'.$request->input('album_id').'/'.'min_'.$filename.'.jpg';
      Storage::disk('public')->put($pathMin, $data);*/
      
      $photo = new Photo;
      $photo->libel = ucfirst(strtolower($request->input('libel')));
      $photo->url = $path;
      // $photo->urlMiniature = $pathMin;
      $photo->album_id = $request->input('album_id');
      $photo->save();
      
      $photo->urlFull = asset('storage/'.$photo->url);
      // $photo->urlFullMin = asset('storage/'.$photo->urlMiniature);
      
       return response()->json($photo->toJson());
      
    }
    return response(json_encode(array('msg'=>'Impossible de télécharger la photo')), '400');
  }
  
  /**
   * Edit photo
   *
   * @return \Illuminate\Http\Response
   */
  public function photoEdit(Request $request, $id){
    $photo = Photo::find($id);
    
    $inputs = $request->all();
    if($inputs){
      foreach($inputs as $key=>$input){
        if(isset($photo->$key)){
          
          if($key == 'vitrine'){
            Photo::where('album_id', $photo->album_id)->where('vitrine', 1)->update(['vitrine' => 0]);
          }
          
          $photo->$key = $input;
        }
      }
    }
    
    $msg = '';
    if($photo->save()){
      $code_response = 204;
    }
    else{
      $code_response = 400;
      $msg = 'Une erreur est survenue';
    }
    
    return response(array('msg'=>json_encode($msg)), $code_response);
  }
  
  public function photoDelete(Request $request){
    $photo = Photo::find($request->input('id'));
    $photo->delete();
  }
  
}
