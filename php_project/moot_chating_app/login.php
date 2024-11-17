<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form login">
      <header>MOOT</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <input type="text" name="username" required>
          <span>Username</span>
          <i></i>
        </div>
        <div class="field input">
          <input type="password" name="password" required>
          <span>Password</span>
          <i></i>
          <!-- <i class="fas fa-eye view" style="display: block; position: absolute; top: 60%; right: 5%; cursor: pointer;"></i>
          <i class="fas fa-eye-slash hide" style="display: none; position: absolute; top: 60%; right: 5%; cursor: pointer;"></i> -->
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Not yet signed up? <a href="index.php">Signup now</a></div>
    </section>
  </div>
  
  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/login.js"></script>

</body>
</html>
