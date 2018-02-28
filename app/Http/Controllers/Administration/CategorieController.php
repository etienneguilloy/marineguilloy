<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Categorie;

class CategorieController extends Controller
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
     * Show the list of categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories = Categorie::allForAdministration();
        return view('administration/categorie/categorieHome',['categories' => $categories->toJson()]);
    }
    
    /**
     * Add a new categorie
     *
     * @return \Illuminate\Http\Response
     */
    public function categorieAdd(Request $request){
        $categorie = new Categorie;
        $categorie->libel = ucfirst(strtolower($request->input('libel')));
        $categorie->save();
        
        $categorie->albums = $categorie->albums;
        
        
        return response()->json($categorie->toJson());
    }
    
    /**
     * Set libel categorie
     *
     * @return \Illuminate\Http\Response
     */
    public function categorieLibel(Request $request){
      
      $categorie = Categorie::find($request->input('id'));
      
      $categorie->libel = $request->input('libel');
      $code_response = ($categorie->save()) ? 200 : 400;
      
      return response(json_encode(array('msg'=>'')), $code_response);
    }
    
    public function categorieDelete($id){
      
      $categorie = Categorie::find($id);
      
      if($categorie->delete()){
        $code_response = 200;
        $msg = 'OK';
      }
      else{
        $code_response = 400;
        $msg = 'Une erreur est survenue';
      }
      
      
      return response(json_encode(array('msg'=>$msg)), $code_response);
    }
}
