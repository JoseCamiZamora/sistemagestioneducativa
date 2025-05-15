<!doctype html>
<html  lang="es">
    @include('layouts.partials.htmlheader')    
    <body>
      <div class="container-fluid">
        <div class="row">
          <input type="hidden"  id="url_raiz_proyecto" value="{{ url("/") }}" />
          <main class="main-content col-lg-12 col-md-12 col-sm-12 p-0">
          <input type="hidden"  id="_token_maestro" value="<?php echo csrf_token(); ?>" />
          
          @include('layouts.partials.headermenu') 
            <div class="preloader" >
                    <div class="loader">Loading...</div>
                    <p class="loader__label">Cargando Sistema Educativo</p>
            </div>      
            <div class="main-content-container container-tabla"  id="body_principal" style="min-height: 768px;">
              @yield('content')
            </div>
          </main>
        </div>
    </div>
  </body>
    @include('layouts.partials.footer')
    @include('layouts.partials.scripts')
</html>
