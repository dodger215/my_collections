<?php
$pageTitle = "Index";

    require './admin/config/function.php';


  if (isset($_SESSION['auth'])) {
    logouSession();
    redirect('index.php', 'Wrong Credencials!');
  }
?>

<!--     Fonts and icons     -->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="./admin/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="./admin/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="./admin/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="./admin/assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    .main-content{
      background-image: url('admin/assets/img/curved-images/disater3.jpg');
      height: 100vh;
      width: 100%;
      background-size: cover;
    }
  </style>


<body class="">
  
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Welcome To Disaster Mangement System</h3>
                </div>
                <div class="card-body">
                <?= alertMessage(); ?>
                <form action="login-code.php" method="post" role="form">
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email">
                    </div>
                    <label>Password</label>
                    <div class="mb-3">
                      <input type="password" name="password" id="" required class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Remember me</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" name="loginBtn" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
                      OR
                      <a href="sign_in.php" class="btn btn-primary w-100 mt-4 mb-0">Sign up</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('./admin/assets/img/curved-images/disater3.jpg')"></div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </main>

