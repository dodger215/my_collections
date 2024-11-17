<?php
$pageTitle = "Index";

    require './admin/config/function.php';


  if (isset($_SESSION['auth'])) {
    logouSession();
    redirect('sign_in.php', 'Wrong Credencials!');
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
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Register
                  <a href="index.php" class="btn btn-primary float-end">sign in</a>
               </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                 <form action="sign.php" method="POST">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Contact</label>
                        <input type="text" name="phone" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control">
                    </div>
                     <div class="mb-3">
                        <button type="submit" name="createUser" class="btn btn-primary">Register</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
   </div>
</body>
