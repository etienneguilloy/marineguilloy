<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/new-age.css') }}" rel="stylesheet">
    <link href="{{ asset('css/device-mockups.min.css') }}" rel="stylesheet">
    <!-- Galery Core CSS file -->
    <link href="{{ asset('css/photoswipe.css') }}" rel="stylesheet">
    <!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
    <link href="{{ asset('css/default-skin/default-skin.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#galerie">Galerie</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#features">Features</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
    <header class="masthead">
      <div class="container h-100">
        <div class="row h-100">
          <div class="col-lg-7 my-auto">
            <div class="header-content mx-auto">
              <h1 class="mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vehicula tempus neque aliquet interdum. Donec a massa est. Fusce quis. </h1>
              <a href="#galerie" class="btn btn-outline btn-xl js-scroll-trigger">Voir la galerie !</a>
            </div>
          </div>
          <div class="col-lg-5 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <img src="{{ asset('images/DSC_0233-3.jpg') }}" class="img-fluid" alt="">
                  </div>
                  <!--<div class="button">
                     You can hook the "home button" to some JavaScript events or just remove it 
                  </div>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <section class="galery bg-primary text-center" id="galerie">
       @include('galery')
    </section>

    <section class="features" id="features">
      <div class="container">
        <div class="section-heading text-center">
          <h2>Unlimited Features, Unlimited Fun</h2>
          <p class="text-muted">Check out what you can do with this app theme!</p>
          <hr>
        </div>
        <div class="row">
          <div class="col-lg-4 my-auto">
            <div class="device-container">
              <div class="device-mockup iphone6_plus portrait white">
                <div class="device">
                  <div class="screen">
                    <!-- Demo image for screen mockup, you can put an image here, some HTML, an animation, video, or anything else! -->
                    <!-- <img src="img/demo-screen-1.jpg" class="img-fluid" alt="">-->
                  </div>
                  <div class="button">
                    <!-- You can hook the "home button" to some JavaScript events or just remove it -->
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8 my-auto">
            <div class="container-fluid">
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-screen-smartphone text-primary"></i>
                    <h3>Device Mockups</h3>
                    <p class="text-muted">Ready to use HTML/CSS device mockups, no Photoshop required!</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-camera text-primary"></i>
                    <h3>Flexible Use</h3>
                    <p class="text-muted">Put an image, video, animation, or anything else in the screen!</p>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-present text-primary"></i>
                    <h3>Free to Use</h3>
                    <p class="text-muted">As always, this theme is free to download and use for any purpose!</p>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="feature-item">
                    <i class="icon-lock-open text-primary"></i>
                    <h3>Open Source</h3>
                    <p class="text-muted">Since this theme is MIT licensed, you can use it commercially!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="cta">
      <div class="cta-content">
        <div class="container">
          <h2>Stop waiting.<br>Start building.</h2>
          <a href="#contact" class="btn btn-outline btn-xl js-scroll-trigger">Let's Get Started!</a>
        </div>
      </div>
      <div class="overlay"></div>
    </section>

    <section class="contact bg-primary" id="contact">
      <div class="container">
        <h2>We
          <i class="fa fa-heart"></i>
          new friends!</h2>
        <ul class="list-inline list-social">
          <li class="list-inline-item social-twitter">
            <a href="#">
              <i class="fa fa-twitter"></i>
            </a>
          </li>
          <li class="list-inline-item social-facebook">
            <a href="#">
              <i class="fa fa-facebook"></i>
            </a>
          </li>
          <li class="list-inline-item social-google-plus">
            <a href="#">
              <i class="fa fa-google-plus"></i>
            </a>
          </li>
        </ul>
      </div>
    </section>

    <footer>
      <div class="container">
        <p>&copy; marineguilloy.test 2018. All Rights Reserved.</p>
        <ul class="list-inline">
          <li class="list-inline-item">
            <a href="#">Privacy</a>
          </li>
          <li class="list-inline-item">
            <a href="#">Terms</a>
          </li>
          <li class="list-inline-item">
            <a href="#">FAQ</a>
          </li>
        </ul>
      </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/new-age.js') }}"></script>
    
    <!-- Core JS file -->
    <script src="{{ asset('js/photoswipe.min.js') }}"></script> 

    <!-- UI JS file -->
    <script src="{{ asset('js/photoswipe-ui-default.js') }}"></script> 
    
    <script src="{{ asset('js/jquery.lazy.min.js') }}"></script> 
        
    <script>
      var galeryVue = new Vue({
        el: '#app_galery',
        data: {
          photos : [],
          photosAll : [],
          albums : [],
          albumsAll: [],
          categories : [],
          selectCategorie : 'all',
          selectAlbum : 'all',
        },
        watch: {
            selectCategorie : function(newValue, oldValue){
                this.setPhotoCategorie(newValue);
            },
            selectAlbum : function(newValue, oldValue){
                this.setPhotoAlbum(newValue);
            }
        },
        methods : {
            showGalery : function(index){
                var pswpElement = document.querySelectorAll('.pswp')[0];
                var options = {
                    index: index // start at first slide
                };

                // Initializes and opens PhotoSwipe
                var gallery = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, this.photos, options);
                gallery.init();
            },
            setPhotoCategorie : function(id){
                
                if(id === 'all'){
                    galeryVue.photos = galeryVue.photosAll;
                    galeryVue.albums = galeryVue.albumsAll;
                    galeryVue.selectAlbum = 'all';
                }
                else{
                    galeryVue.photos = galeryVue.photosAll.filter(function(item) { 
                       return item.categorie_id === id;  
                    });

                    galeryVue.albums = galeryVue.albumsAll.filter(function(item) { 
                       return item.categorie_id === id;  
                    });
                }
               
            },
            setPhotoAlbum : function(id){
                
                if(id === 'all'){
                    galeryVue.photos = galeryVue.photosAll;
                }
                else{
                    galeryVue.photos = galeryVue.photosAll.filter(function(item) { 
                       return item.album_id === id;  
                    });
                }
            }
        },
        mounted(){
          axios.get('/categories')
          .then(function (response) {
            galeryVue.categories = response.data;
          })
          .catch(function (error) {
          });

          axios.get('/albums')
          .then(function (response) {
            galeryVue.albums = galeryVue.albumsAll = response.data;
          })
          .catch(function (error) {
          });

          axios.get('/photos')
          .then(function (response) {
            galeryVue.photosAll = galeryVue.photos = response.data;
            window.setTimeout(function() {
                  $('.lazy').Lazy({
                    afterLoad: function(element) {
                        // called after an element was successfully handled
                        galeryVue.photosAll[element[0].dataset.index].isLoad = 1;
                    },

                  });
            }, 1);
          })
          .catch(function (error) {
          });
        }
      })
    </script>
</body>
</html>

