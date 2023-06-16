<!-- partial:partials/_settings-panel.html -->
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
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
        @endif
        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Producteur' OR Auth()->user()->userType->name == 'Financier')
          <li class="nav-item nav-category">Stock</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="menu-icon mdi mdi-floor-plan"></i>
              <span class="menu-title">Stock</span>
              <i class="menu-arrow"></i> 
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('matiere.index')}}">Matières premières</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('emballage.index')}}">Emballages</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('emballage_casse.index')}}">Emballages Cassés</a></li>
                
                <li class="nav-item"> <a class="nav-link" href="{{ route('production.index')}}">Productions</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('product.requisition')}}">Réquisition</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">Catégories et Types</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-element" aria-expanded="false" aria-controls="form-element">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">Catégorie</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-element">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('type_matiere.index')}}">Types de Matières</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('category.index')}}">Catégories de Productions</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('type_emballage.index')}}">Catégories d'emballages</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('unit.index')}}">Unités</a></li>
              </ul>
            </div>
          </li>
        @endif

        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Vendeur')
          <li class="nav-item nav-category">Ventes</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">Ventes</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('production.search')}}">Vendre</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('sale.index')}}">Liste de Ventes</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('price_config.index')}}">Liste de Prix de réduction</a></li>
                @if(Auth()->user()->userType->name == 'Vendeur')
                  <li class="nav-item"> <a class="nav-link" href="{{ route('dette.index') }}">Dettes</a></li>
                @endif
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">Clients</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#client-elements" aria-expanded="false" aria-controls="client-elements">
              <i class="menu-icon mdi mdi-card-text-outline"></i>
              <span class="menu-title">Clients</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="client-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('client.index')}}">Liste de Clients</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('bonus.create')}}">Bonus</a></li>
              </ul>
            </div>
          </li>
        @endif

        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Financier' OR Auth()->user()->userType->name == 'Comptable')
          <li class="nav-item nav-category">Finance Et Comptabilité </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Finance</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('recette.index') }}">Recettes</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('type_recette.index')}}">Type de Recettes</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('sortie.index') }}">Charges</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('cout_production.index') }}">Couts de Productions</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('balance.index') }}">Balance Financière</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('dette.index') }}">Dettes</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('justification.index') }}">Pièces Justificatives</a></li>
              </ul>
            </div>
          </li>
        @endif

        @if(Auth()->user()->userType->name == 'Administrateur' OR Auth()->user()->userType->name == 'Entrepreneur' OR Auth()->user()->userType->name == 'Comptable' OR Auth()->user()->userType->name == 'Financier')
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#compt" aria-expanded="false" aria-controls="compt">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Comptabilité</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="compt">
              <ul class="nav flex-column sub-menu">
              
                <li class="nav-item"> <a class="nav-link" href="{{ route('journal.index') }}">Journal</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('grand_livre.index') }}">Grand Livre</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('bilan.index') }}">Bilan</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('bilan_config.index') }}">Elaboration du Bilan</a></li>
                {{-- <li class="nav-item"> <a class="nav-link" href="{{ route('bilan_classement.index') }}">Classement du Bilan</a></li> --}}
                <li class="nav-item"> <a class="nav-link" href="{{ route('plan_comptable.index') }}">Plan Comptable</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('account_type.index') }}">Types de Comptes</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('operation.index') }}">Operations Du Journal</a></li>
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
              <span class="menu-title">Bureaux</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="office-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="{{ route('office.index')}}">Liste de Bureaux</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logistique.index')}}">Liste de Matériels (Mobilers)</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item nav-category">Accèss</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Compte</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('users.create')}}">Nouvel Utilisateur </a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('users.index')}}">Liste des Utilisateurs </a></li>
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
      <li class="nav-item nav-category">Accès</li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">Compte</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('users.create')}}">Connexion</a></li>
              </ul>
            </div>
          </li>
    </ul>
  </nav>
  @endguest

  <!-- partial -->