<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>MOOT</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <input type="text" name="fname" required>
            <span>First Name</span>
            <span class="bg"></span>
          </div>
          <div class="field input">
            <input type="text" name="lname" required>
            <span>Last Name</span>
            <span class="bg"></span>
          </div>
        </div>
        <div class="field input">
          <input type="text" name="username" required>
          <span>Username</span>
          <span class="bg"></span>
        </div>
        <div class="field input">
          <input type="password" name="password" required>
          <span>Password</span>
          <!-- <i class="fas fa-eye"></i> -->
          <span class="bg"></span>
        </div>
        <div class="field image">
          <label>Select Image</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue to Chat">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login.php">Login now</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
