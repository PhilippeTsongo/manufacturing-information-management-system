<!-- partial:partials/_settings-panel.html -->


{{-- IMPORTANT VARIABLE --}}
<?php
  //shortlisting app()->getLocal
  $appLocale = app()->getLocale();  
?>

<div class="theme-setting-wrapper">
    <div id="settings-trigger"><i class="ti-settings"></i></div>
    <div id="theme-settings" class="settings-panel">
      <i class="settings-close ti-close"></i>
      <p class="settings-heading">SIDEBAR SKINS</p>
      <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
      <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
      <p class="settings-heading mt-2">HEADER SKINS</p>
      <div class="color-tiles mx-0 px-4">
        <div class="tiles success"></div>
        <div class="tiles warning"></div>
        <div class="tiles danger"></div>
        <div class="tiles info"></div>
        <div class="tiles dark"></div>
        <div class="tiles default"></div>
      </div>
    </div>
  </div>
  <div id="right-sidebar" class="settings-panel">
    <i class="settings-close ti-close"></i>
    <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="todo-tab" data-bs-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="chats-tab" data-bs-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
      </li>
    </ul>
    <div class="tab-content" id="setting-content">
      <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
        <div class="add-items d-flex px-3 mb-0">
          <form class="form w-100">
            <div class="form-group d-flex">
              <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
              <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
            </div>
          </form>
        </div>
        <div class="list-wrapper px-3">
          <ul class="d-flex flex-column-reverse todo-list">
            <li>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox">
                  Team review meeting at 3.00 PM
                </label>
              </div>
              <i class="remove ti-close"></i>
            </li>
            <li>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox">
                  Prepare for presentation
                </label>
              </div>
              <i class="remove ti-close"></i>
            </li>
            <li>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox">
                  Resolve all the low priority tickets due today
                </label>
              </div>
              <i class="remove ti-close"></i>
            </li>
            <li class="completed">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox" checked>
                  Schedule meeting for next week
                </label>
              </div>
              <i class="remove ti-close"></i>
            </li>
            <li class="completed">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox" checked>
                  Project review
                </label>
              </div>
              <i class="remove ti-close"></i>
            </li>
          </ul>
        </div>
        <h4 class="px-3 text-muted mt-5 fw-light mb-0">Events</h4>
        <div class="events pt-4 px-3">
          <div class="wrapper d-flex mb-2">
            <i class="ti-control-record text-primary me-2"></i>
            <span>Feb 11 2018</span>
          </div>
          <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
          <p class="text-gray mb-0">The total number of sessions</p>
        </div>
        <div class="events pt-4 px-3">
          <div class="wrapper d-flex mb-2">
            <i class="ti-control-record text-primary me-2"></i>
            <span>Feb 7 2018</span>
          </div>
          <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
          <p class="text-gray mb-0 ">Call Sarah Graves</p>
        </div>
      </div>
      <!-- To do section tab ends -->
      <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
        <div class="d-flex align-items-center justify-content-between border-bottom">
          <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
          <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 fw-normal">See All</small>
        </div>
        <ul class="chat-list">
          <li class="list active">
            <div class="profile"><img src="images/faces/face1.jpg" alt="image"><span class="online"></span></div>
            <div class="info">
              <p>Thomas Douglas</p>
              <p>Available</p>
            </div>
            <small class="text-muted my-auto">19 min</small>
          </li>
          <li class="list">
            <div class="profile"><img src="images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
            <div class="info">
              <div class="wrapper d-flex">
                <p>Catherine</p>
              </div>
              <p>Away</p>
            </div>
            <div class="badge badge-success badge-pill my-auto mx-2">4</div>
            <small class="text-muted my-auto">23 min</small>
          </li>
          <li class="list">
            <div class="profile"><img src="images/faces/face3.jpg" alt="image"><span class="online"></span></div>
            <div class="info">
              <p>Daniel Russell</p>
              <p>Available</p>
            </div>
            <small class="text-muted my-auto">14 min</small>
          </li>
          <li class="list">
            <div class="profile"><img src="images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
            <div class="info">
              <p>James Richardson</p>
              <p>Away</p>
            </div>
            <small class="text-muted my-auto">2 min</small>
          </li>
          <li class="list">
            <div class="profile"><img src="images/faces/face5.jpg" alt="image"><span class="online"></span></div>
            <div class="info">
              <p>Madeline Kennedy</p>
              <p>Available</p>
            </div>
            <small class="text-muted my-auto">5 min</small>
          </li>
          <li class="list">
            <div class="profile"><img src="images/faces/face6.jpg" alt="image"><span class="online"></span></div>
            <div class="info">
              <p>Sarah Graves</p>
              <p>Available</p>
            </div>
            <small class="text-muted my-auto">47 min</small>
          </li>
        </ul>
      </div>
      <!-- chat tab ends -->
    </div>
  </div>
  <!-- partial -->
  
  
  <!-- partial:partials/_sidebar.html -->
  @auth
  @if(Auth()->user()->userType)
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        
        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur')
          <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard')}}">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Dashboard', $appLocale)}}</span>
            </a>
          </li>
        @endif
        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Producteur' OR Auth()->user()->userType->name == 'Financier')
          <li class="nav-item nav-category">{{ GoogleTranslate::trans('Stock', $appLocale)}}</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Stock', $appLocale)}}</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('matiere.index')}}">{{ GoogleTranslate::trans('Matières premières', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('emballage.index')}}">{{ GoogleTranslate::trans('Emballages', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('emballage_casse.index')}}">{{ GoogleTranslate::trans('Emballages Cassés', $appLocale)}}</a></li>
                
                <li class="nav-item"> <a class="nav-link" href="{{ route('production.index')}}">{{ GoogleTranslate::trans('Productions', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('product.requisition')}}">{{ GoogleTranslate::trans('Réquisition', $appLocale)}}</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">{{ GoogleTranslate::trans('Catégories et Types', $appLocale)}}</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-element" aria-expanded="false" aria-controls="form-element">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Catégorie', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-element">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('type_matiere.index')}}">{{ GoogleTranslate::trans('Types de Matières', $appLocale)}}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('category.index')}}">{{ GoogleTranslate::trans('Catégories de Productions', $appLocale)}}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('type_emballage.index')}}">{{ GoogleTranslate::trans('Catégories d\'emballages', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('unit.index')}}">{{ GoogleTranslate::trans('Unités', $appLocale)}}</a></li>
              </ul>
            </div>
          </li>
        @endif

        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Vendeur')
          <li class="nav-item nav-category">{{ GoogleTranslate::trans('Ventes', $appLocale)}}</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Ventes', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('production.search')}}">{{ GoogleTranslate::trans('Vendre', $appLocale)}}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('sale.index')}}">{{ GoogleTranslate::trans('Liste de Ventes', $appLocale)}}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('price_config.index')}}">{{ GoogleTranslate::trans('Liste de Prix de réduction', $appLocale)}}</a></li>
                @if(Auth()->user()->userType->name == 'Vendeur')
                  <li class="nav-item"> <a class="nav-link" href="{{ route('dette.index') }}">{{ GoogleTranslate::trans('Dettes', $appLocale)}}</a></li>
                @endif
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">{{ GoogleTranslate::trans('Clients', $appLocale)}}</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#client-elements" aria-expanded="false" aria-controls="client-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Clients', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="client-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index')}}">{{ GoogleTranslate::trans('Liste de Clients', $appLocale)}}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('bonus.create')}}">{{ GoogleTranslate::trans('Bonus', $appLocale)}}</a></li>
              </ul>
            </div>
          </li>
        @endif

        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Financier' OR Auth()->user()->userType->name == 'Comptable')
          <li class="nav-item nav-category">{{ GoogleTranslate::trans('Finance Et Comptabilité' , $appLocale)}} </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Finance', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('recette.index') }}">{{ GoogleTranslate::trans('Recettes', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('type_recette.index')}}">{{ GoogleTranslate::trans('Type de Recettes', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('sortie.index') }}">{{ GoogleTranslate::trans('Charges', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('cout_production.index') }}">{{ GoogleTranslate::trans('Couts de Productions', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('balance.index') }}">{{ GoogleTranslate::trans('Balance Financière', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('dette.index') }}">{{ GoogleTranslate::trans('Dettes', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('justification.index') }}">{{ GoogleTranslate::trans('Pièces Justificatives', $appLocale)}}</a></li>
              </ul>
            </div>
          </li>
        @endif

        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Comptable' OR Auth()->user()->userType->name == 'Financier')
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#compt" aria-expanded="false" aria-controls="compt">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Comptabilité', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="compt">
              <ul class="nav flex-column sub-menu">
              
                <li class="nav-item"> <a class="nav-link" href="{{ route('journal.index') }}">{{ GoogleTranslate::trans('Journal', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('grand_livre.index') }}">{{ GoogleTranslate::trans('Grand Livre', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('bilan.index') }}">{{ GoogleTranslate::trans('Bilan', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('bilan_config.index') }}">{{ GoogleTranslate::trans('Elaboration du Bilan', $appLocale)}}</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('bilan_classement.index') }}">Classement du Bilan</a></li> --}}
                <li class="nav-item"> <a class="nav-link" href="{{ route('plan_comptable.index') }}">{{ GoogleTranslate::trans('Plan Comptable', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('account_type.index') }}">{{ GoogleTranslate::trans('Types de Comptes', $appLocale)}}</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('operation.index') }}">{{ GoogleTranslate::trans('Operations Du Journal', $appLocale)}}</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('transaction.index') }}">Transactions</a></li> --}}
                
              </ul>
            </div>
          </li>
        @endif

        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur')
          <li class="nav-item nav-category">Bureaux</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#office-elements" aria-expanded="false" aria-controls="client-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Bureaux', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="office-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('office.index')}}">{{ GoogleTranslate::trans('Liste de Bureaux', $appLocale)}}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logistique.index')}}">{{ GoogleTranslate::trans('Liste de Matériels (Mobilers)', $appLocale)}}</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">{{ GoogleTranslate::trans('Accèss', $appLocale)}}</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Compte', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('users.create')}}">{{ GoogleTranslate::trans('Nouvel Utilisateur', $appLocale)}} </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('users.index')}}">{{ GoogleTranslate::trans('Liste des Utilisateurs', $appLocale)}} </a></li>
              </ul>
            </div>
          </li>
        @endif
      </ul>
    </nav>
  @endif
  @endauth
  @guest
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item nav-category">{{ GoogleTranslate::trans('Accès', $appLocale)}}</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">{{ GoogleTranslate::trans('Compte', $appLocale)}}</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('users.create')}}">{{ GoogleTranslate::trans('Connexion', $appLocale)}}</a></li>
              </ul>
            </div>
          </li>
    </ul>
  </nav>
  @endguest

  <!-- partial -->