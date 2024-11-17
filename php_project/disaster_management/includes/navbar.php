<div class="sticky-top">
  <div class="bg-primary py-2">
    <div class="container">
    <div class="row">
      <div class="col-md-6 text-white">
        Email: <?= webSettings('email1') ?? ''; ?>
        Contact: <?= webSettings('phone1') ?? ''; ?>
      </div>
      <div class="col-md-6">
        Socail Media: 
      </div>
    </div>
    </div>
  </div>
<nav class="navbar navbar-expand-lg bg-white shadow sticky-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">Disaster Management</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about-us.php">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact-us.php">Contact Us</a>
        </li>
        <?php if(isset($_SESSION['auth'])): ?>
        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
 </nav>
</div>