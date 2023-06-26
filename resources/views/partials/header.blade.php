<!-- partial:partials/_navbar.html -->
{{-- IMPORTANT VARIABLE --}}
<?php
  //shortlisting app()->getLocal
  $appLocale = app()->getLocale();  
?>

<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
      <div class="me-3">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
      </div>
      <div>
        <a class="navbar-brand brand-logo fw-bold" href="{{route('index')}}">
          KANABE
          {{-- <img src="images/logo.svg" alt="logo" /> --}}
        </a>
        <a class="navbar-brand brand-logo-mini fw-bold" href="{{route('index')}}">
          KANABE
          {{-- <img src="images/logo-mini.svg" alt="logo" /> --}}
        </a>
      </div>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top"> 
      <ul class="navbar-nav">
        <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
          <h5 class="welcome-sub-text">
            <span class="text-black ">
              @if(Auth()->check())
                <span class="display-4"> {{ Auth::user()->name}} </span>
                @if( Auth::user()->userType)
                  <span class="badge badge-success"> {{ Auth::user()->userType->name}}</span>
                @endif  
              @endif
            </span>
          </h5>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown d-none d-lg-block">
          <a class="nav-link dropdown-bordered dropdown-toggle dropdown-toggle-split" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">Liste de catégories de productions</a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
            <a class="dropdown-item py-3" >
              <p class="mb-0 font-weight-medium float-left">Liste de catégories de productions</p>
            </a>
            <div class="dropdown-divider"></div>

            <?php $categories = DB::table('categories')->get('name') ; ?>
              @foreach($categories as $category)
            
                <a class="dropdown-item preview-item">    
                  <div class="preview-item-content flex-grow py-2">
                    <p class="preview-subject ellipsis font-weight-medium text-dark">{{ $category->name }}</p>
                  </div>
                </a>
              @endforeach
          </div>
        </li>

        <li class="nav-item dropdown d-none d-lg-block">
          <select class="form-select changeLang">
            <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
            <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>
            <option value="es" {{ session()->get('locale') == 'es' ? 'selected' : '' }}>Spanish</option>
          </select>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
            
            
          </div>
        </li>

        <li class="nav-item d-none d-lg-block">
          <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
            <span class="input-group-addon input-group-prepend border-right">
              <span class="icon-calendar input-group-text calendar-icon"></span>
            </span>
            <input type="text" class="form-control">
          </div>
        </li>
        <li class="nav-item">
          <form class="search-form" method="GET" action="{{ route('search.search') }}">
            <i class="icon-search"></i>
            <input type="search" class="form-control" name="query" placeholder="Entre votre recherche basée sur une date" title="Recherchez ici">
          </form>
        </li>
        <li class="nav-item dropdown"> 
          <a class="nav-link count-indicator" id="countDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="icon-bell"></i>
            <span class="count"></span>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="countDropdown">
            <a href="{{ route('product.requisition')}}" class="dropdown-item py-3">
              <p class="mb-0 font-weight-medium float-left">{{ GoogleTranslate::trans('Production inférieur à 50pcs', $appLocale)}} </p>
              <?php $rec = DB::table('productions')->where('quantity', '<', 50)->get() ;?>
              <span class="badge badge-pill badge-primary float-right">{{ GoogleTranslate::trans('Voir Plus', $appLocale)}}</span>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item">
              
              <div class="preview-item-content flex-grow py-2">
                <p class="preview-subject ellipsis font-weight-medium text-dark">{{ count($rec) . ' Productions'}}  </p>
                <p class="fw-light small-text mb-0"> {{ GoogleTranslate::trans('Rupture de stock', $appLocale)}} </p>
              </div>
            </a>
            
          </div>
        </li>
        <li class="nav-item dropdown d-none d-lg-block user-dropdown">
          <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
            @auth
              <img class="img-xs rounded-circle" src="{{ asset(Auth::user()->image) }}" alt="{{ Auth::user()->name }}"> 
            @endauth
          </a>
          
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
            <div class="dropdown-header text-center">
              @auth
                <img class="img-xs rounded-circle" src="{{ asset(Auth::user()->image) }}" alt="{{ Auth::user()->name }}"> 
              @endauth
              @if(Auth()->check())                
                <p class="mb-1 mt-3 font-weight-semibold">
                    {{ Auth::user()->name }}
                </p>
                <p class="fw-light text-muted mb-2">{{ Auth::user()->email }}</p>
                @if(Auth::user()->userType)
                  <p class="fw-light text-muted mb-2">
                    <div class="badge badge-primary">
                      {{ Auth::user()->userType->name }}
                    </div>
                  </p>
                @endif
              @endif
               
              <!-- Authentication -->
              @auth
              <form class="dropdown-item align-center" method="post" action="{{ route('logout') }}">
                @csrf
                <input type="hidden" name="user_email" value="{{ Auth::user()->email }}">
                <button type="submit" :href="route('logout')" class="border border-0 bg bg-primary text-light rounded-3 text-center">
                  <i class="dropdown-item-icon mdi mdi-power text-light"></i>
                  {{ GoogleTranslate::trans('Déconnexion', $appLocale)}}
                </button>
              </form>
              @endauth

              @guest
                <a class="dropdown-item" href="{{ route('login')}}"> <i class="menu-icon mdi mdi-account-circle-outline text-primary me-2"></i>{{ GoogleTranslate::trans('Connexion', $appLocale)}}</a>
              @endguest
            </div>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
        <span class="mdi mdi-menu"></span>
      </button>
    </div>
  </nav>

{{-- change language js --}}

<script src="js/jquery_inc.js"></script>

<script type="text/javascript">  
  var url = "{{ route('changeLang') }}";
  $(".changeLang").change(function(){

    // alert('phil');
      window.location.href = url + "?lang="+ $(this).val();
  });
  
</script>
  <!-- partial -->