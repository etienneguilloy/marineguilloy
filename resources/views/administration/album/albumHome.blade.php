@extends('layouts.app')
@section('content')
<div class="container" id="app_vue">

  <div id="album_gestion">
    <div class="element">
      <span v-show="titleAlbum" style="font-size:30px;">@{{album.libel}}</span>
      <div v-show="showEdit" class="element">
        <form class="form-inline" v-on:submit.prevent="onSubmitEdit">
            <label class="sr-only">Editer Album</label>
            <input type="text" class="form-control mb-2 mr-sm-2" name="libel_album_edit" v-model="album.libel" required />
            <input type="hidden" name="album_id_edit" v-model="album.id" />
            <button class="btn mb-2"><svg class="icon"><use xlink:href="{{ asset('sprite.svg') }}#check"></use></svg></button>
        </form>
      </div>
    </div>
    
    <div class="element">
      <button class="btn" v-on:click="prepareEditAlbum"><svg class="icon" ><use xlink:href="{{ asset('sprite.svg') }}#pencil"></use></svg></button>
    </div>
    <div class="element">
      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAlbumModal">Supprimer</button>
    </div>
    
    <div class="element" style="white-space:nowrap;">
      <label v-if="album.actif">Album activé</label>
      <label v-else>Album desactivé</label>
      <label class="switch">
        <input type="checkbox" name="albumActif" id="albumActif" v-model="album.actif" v-on:change="setActif(album.id)" />
        <span class="slider round"></span>
      </label>
    </div>
  </div>
  
  
  <div class="alert alert-danger" role="alert" v-show="showAlert">
    @{{ msgAlert }}
  </div>
  <form id="form_categorie" v-on:submit.prevent="addPhoto" enctype="multipart/form-data">
    <div class="custom-file">
      <input type="file" class="custom-file-input" id="photoFile" lang="fr" v-on:change="addPhoto" accept="image/*">
      <label class="custom-file-label" for="photoFile">Ajouter une photo</label>
    </div>
  </form>
  
  <div class="bloc">
    <div class="row space-row">
      <div v-for="photo in album.photos" class="col-6 col-md-3 space-col">
        <div class="card h-100">
          <div class="card-body no-padding all-center">
            <img class="img-fluid" v-bind:src="photo.urlFull" v-bind:alt="photo.libel" />
          </div>
          <div class="card-footer">
            <h5 class="card-title">@{{ photo.libel }}</h5>
            <div class="custom-control custom-radio">
              <input type="radio" v-bind:id="radioVitrineId(photo.id)" name="photoVirine" class="custom-control-input" v-bind:checked="isCheckedVitrine(photo.vitrine)" v-on:click="photoVitrine(photo.id)" />
              <label class="custom-control-label" v-bind:for="radioVitrineId(photo.id)">Photo vitrine de l'album</label>
            </div>
            <div style="margin-top:15px;text-align:center;">
              <button type="button" class="btn btn-danger" v-on:click="deletePhoto(photo.id)">Supprimer</button>
            </div>
          </div>
      </div>
    </div>
   </div>
   
   
   
<div class="modal fade" id="deleteAlbumModal" tabindex="-1" role="dialog" aria-labelledby="deleteAlbumModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAlbumModalLabel">Supprimer cet album</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Supprimer cet album et l'ensemble des photos ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary"  v-on:click="deleteAlbum(album.id)">Valider</button>
      </div>
    </div>
  </div>
</div>
</div>
@endsection

@section('scripts')
<script>
var albumVue = new Vue({
  el: '#app_vue',
  data: {
    album : {!! $album !!},
    showAlert : 0,
    msgAlert : '',
    showEdit : 0,
    titleAlbum:1,
  },
  methods : {
    addPhoto : function(e){
      
      var file = e.target.files[0];
      
      var formData = new FormData();
      formData.append("photoFile", file);
      formData.append("album_id", albumVue.album.id);
      
      axios.post('/administration/photo', formData)
      .then(function (response) {
          albumVue.album.photos.unshift(JSON.parse(response.data));
      })
      .catch(function (error) {
        albumVue.msgAlert = error.response.data.msg;
        albumVue.showAlert = 1;
        window.setTimeout(function() {
           albumVue.showAlert = 0;
        }, 4000);
      }); 
    },
    radioVitrineId : function(id){
      return 'vitrine'+id;
    },
    isCheckedVitrine: function(vitrine){
      return (vitrine) ? 'checked' : '';
    },
    photoVitrine: function(id){
      axios.patch('/administration/photo/'+id, {vitrine : 1})
      .then(function (response) {
        $.each(albumVue.album.photos, function(index, value) {
          if(value.id == id){
            albumVue.album.photos[index].vitrine = 1;
          }
          else{
            albumVue.album.photos[index].vitrine = 0;
          }
        });
      })
      .catch(function (error) {
          
      });
    },
    deletePhoto: function(id){
      axios.post('/administration/photoDelete', {id : id})
      .then(function (response) {
          $.each(albumVue.album.photos, function(index, value) {
            if(value.id == id){
              albumVue.album.photos.splice(index,1);
              return false;
            }
          });
      })
      .catch(function (error) {
          
      });
    },
    prepareEditAlbum:function(e){
      albumVue.showEdit = 1;
      albumVue.titleAlbum = 0;
    },
    onSubmitEdit : function(e){
      albumVue.showEdit = 0;
      albumVue.titleAlbum = 1;
      
      var libel_album = e.target.elements.libel_album_edit.value;
      var album_id = e.target.elements.album_id_edit.value;
      
      axios.patch('/administration/album/'+album_id, {libel : libel_album})
      .then(function (response) {
        
      })
      .catch(function (error) {
      });
      
    },
    deleteAlbum : function(id){
      axios.delete('/administration/album/'+id)
      .then(function (response) {
        window.location = response.data.msg;
      })
      .catch(function (error) {
      });
    },
    setActif : function(id){
      
      axios.patch('/administration/album/'+id, {actif : this.album.actif})
      .then(function (response) {
      })
      .catch(function (error) {
      });
    }
  }
});
</script>
@endsection