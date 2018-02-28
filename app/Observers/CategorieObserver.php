<?php

namespace App\Observers;

use App\Categorie;

class CategorieObserver
{
    /**
     * Listen to the Categorie created event.
     *
     * @param  \App\Categorie  $categorie
     * @return void
     */
    public function created(Categorie $categorie)
    {
        //
    }

    /**
     * Listen to the Categorie deleting event.
     *
     * @param  \App\Categorie  $categorie
     * @return void
     */
    public function deleting(Categorie $categorie)
    {
        foreach($categorie->albums as $album){
          $album->delete();
        }
    }
}