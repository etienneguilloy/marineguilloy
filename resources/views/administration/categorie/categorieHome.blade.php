@extends('layouts.app')

@section('content')
<div class="container">
  <form id="form_categorie" class="form-inline" v-on:submit.prevent="onSubmit">
      <label class="sr-only" for="libel_categorie">Nouvelle catégorie</label>
      <input type="text" class="form-control mb-2 mr-sm-2" id="libel_categorie" name="libel_categorie" placeholder="Titre catégorie" v-model="libel" required />
      <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
  </form>
  
  <div id="list_categories">
    <div v-for="categorie in categories" class="space-row bloc">
      <h3 v-show="titleCategorie">
        @{{ categorie.libel }} 
        <button class="btn" v-on:click="prepareEditCategorie"><svg class="icon" ><use xlink:href="{{ asset('sprite.svg') }}#pencil"></use></svg></button>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategorieModal" v-on:click="prepareModal(categorie.id)">Supprimer</button>
      </h3>
      
      <div v-show="showEdit">
        <form class="form-inline" v-on:submit.prevent="onSubmitEdit">
            <label class="sr-only" for="libel_categorie_edit">Editer catégorie</label>
            <input type="text" class="form-control mb-2 mr-sm-2" name="libel_categorie_edit" v-model="categorie.libel" required />
            <input type="hidden" name="categorie_id_edit" v-model="categorie.id" />
            <button class="btn mb-2"><svg class="icon"><use xlink:href="{{ asset('sprite.svg') }}#check"></use></svg></button>
        </form>
      </div>
      
       <div>
        <form class="form-inline" v-on:submit.prevent="addAlbum">
          <label class="sr-only" for="libel_album">Nouvel album</label>
          <input type="text" class="form-control mb-2 mr-sm-2" id="libel_album" name="libel_album" placeholder="Titre album" required />
          <input type="hidden" id="categorie_id" name="categorie_id" v-bind:value="categorie.id" />
          <button type="submit" class="btn btn-primary mb-2">Ajouter</button>
        </form>
       </div>
       
      <div class="row space-row">
        <div v-for="album in categorie.albums" class="col-6 col-md-3 space-col">                 
          <div class="card h-100" >
            <div class="card-body no-padding all-center">
              <img class="img-fluid" v-bind:src="album.photoVitrine" v-bind:alt="album.libel">
            </div>
            <div class="card-footer">
              <h5 class="card-title">@{{ album.libel }}</h5>
              <a v-bind:href="album.albumRoute" class="btn btn-primary">Acceder</a>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
    
    <div class="modal fade" id="deleteCategorieModal" tabindex="-1" role="dialog" aria-labelledby="deleteCategorieModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteCategorieModalLabel">Supprimer cette catégorie</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Supprimer cette catégorie et l'ensemble des albums et des photos ?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" v-on:click="deleteCategorie(idCatDel)">Valider</button>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection

@section('scripts')
<script>
var list_categories = new Vue({
  el: '#list_categories',
  data: {
    categories: {!! $categories !!},
    showEdit : 0,
    titleCategorie : 1,
    idCatDel : 0,
  },
  methods : {
    addAlbum : function(e){
    
    var libel_album = e.target.elements.libel_album.value;
    var categorie_id = e.target.elements.categorie_id.value;
      axios.post('/administration/album', {
          libel: libel_album,
          categorie_id: categorie_id,
      })
      .then(function (response) {
          var responseDecode = JSON.parse(response.data);
          $.each(list_categories.categories, function(index, value) {
            if(value.id == responseDecode.categorie_id){
              list_categories.categories[index]['albums'].push(responseDecode);
              return false;
            }
          });  
      })
      .catch(function (error) {
          //console.log(error);
      });
    },
    prepareEditCategorie :function(e){
      list_categories.showEdit = 1;
      list_categories.titleCategorie = 0;
    },
    onSubmitEdit : function(e){
      list_categories.showEdit = 0;
      list_categories.titleCategorie = 1;
      
      var libel_categorie = e.target.elements.libel_categorie_edit.value;
      var categorie_id = e.target.elements.categorie_id_edit.value;
      
      axios.post('/administration/categorieLibel', {
          libel: libel_categorie,
          id: categorie_id,
      })
      .then(function (response) {
          var responseDecode = JSON.parse(response.data);
          $.each(list_categories.categories, function(index, value) {
            if(value.id == responseDecode.categorie_id){
              list_categories.categories[index]['libel'] = libel_categorie;
              return false;
            }
          });  
      })
      .catch(function (error) {
          //console.log(error);
      });
    },
    prepareModal : function(id){
      this.idCatDel = id;
    },
    deleteCategorie : function(id){
      axios.delete('/administration/categorie/'+id)
      .then(function (response) {
        
        $.each(list_categories.categories, function(index, value) {
          if(value.id == id){
            list_categories.categories.splice(index, 1);
            return false;
          }
        }); 
        
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  }
});

var form_categorie = new Vue({
    el: '#form_categorie',
    data: {
        libel: ''
    },
    methods: {
        onSubmit: function (e) {
            axios.post('/administration/categorie', {
                libel: this.libel,
            })
            .then(function (response) {
                list_categories.categories.push(JSON.parse(response.data));
            })
            .catch(function (error) {
                /*console.log(error);*/
            });
        }
    }
});
</script>
@endsection

