<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Connexion Kanabe Système</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>

  {{-- IMPORTANT VARIABLE --}}
  <?php
    //shortlisting app()->getLocal
    $appLocale = app()->getLocale();  
  ?>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              
              <h4>Kanabe Système</h4>
              <h6 class="fw-light">{{ GoogleTranslate::trans('Complétez ce formulaire pour vous connecter.', $appLocale)}}</h6>
              
              
              
              <form method="POST" action="{{ route('login') }}" class="pt-3">
              @csrf

                <div class="form-group">
                  <input type="email" name="email" :value="old('email')" required autofocus class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                  <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                </div>
                <div class="form-group">
                  <input  type="password" name="password" required autocomplete="current-password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                  <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >{{ GoogleTranslate::trans('Connexion', $appLocale)}}</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  
                  {{-- <a href="#" class="auth-link text-black">Mot de passe oublié?</a> --}}
                </div>
                
                <div class="text-center mt-4 fw-light">
                  {{ GoogleTranslate::trans('Pas de compte?', $appLocale)}} <a href="register.html" class="text-primary">{{ GoogleTranslate::trans('Créez un Compte', $appLocale)}}</a>
                </div>
              </form>
            
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
