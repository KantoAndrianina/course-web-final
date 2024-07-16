<?php
$url = config('app.url');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-6RRXFGB5YT"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-6RRXFGB5YT');
  </script>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UTR - Equipe</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/vendors/feather/feather.css">
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/vendors/typicons/typicons.css">
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo $url ?>/assets_dash/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="<?php echo $url ?>/assets_dash/images/favicon.png" />
</head>
    <body class="antialiased">
    <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <!-- <div class="brand-logo">
                <img src="/assets_dash/images/logo.svg" alt="logo">
              </div> -->
              <h4>Log in Equipe </h4>
              <!-- <h6 class="fw-light">Sign in to continue.</h6> -->
              <form class="pt-3" action="{{ route('login.equipe') }}" method="post">
                @csrf
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="login" name="login" value="A" placeholder="Login Equipe">
                  @error('login')
                      <div class="invalid-feedback" style="color: red;">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="mdp" name="mdp" value="A" placeholder="Mot de passe">
                  @error('mdp')
                      <div class="invalid-feedback" style="color: red;">
                          {{ $message }}
                      </div>
                  @enderror
                </div>
                <div id="error-message" class="alert alert-danger" style="display: {{ $errors->any() ? 'block' : 'none' }};">
                      @if($errors->any())
                          <ul>
                              @foreach($errors->all() as $error)
                                  {{ $error }}<br/>
                              @endforeach
                          </ul>
                      @endif
                  </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">LOG IN</button>
                </div>
                <!-- <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div> -->
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook me-2"></i>Connect using facebook
                  </button>
                </div> -->
                <!-- <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
        </div>
    </body>
</html>