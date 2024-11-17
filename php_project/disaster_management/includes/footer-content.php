
<div class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="footer-heading"><?= webSettings('title') ?? 'CASE (Cascading Style Evolution)'; ?></h4>
                <hr>
                <p>
                  <?= webSettings('small_description') ?? 'CASE (Cascading Style Evolution)'; ?>
                </p>
            </div>
            <div class="col-md-4">
              <h4 class="footer-heading">Follow Us</h4> 
              <hr>
              <ul>
                <?php
                  $socialMedia = getAll('social_media');
                  if ($socialMedia) {
                    if (mysqli_num_rows($socialMedia) > 0) {
                       foreach($socialMedia as $socialMedias){
                        ?>
                        <li>
                          <a href="<?= $socialMedias['url'];?>" class="text-decoration-none"><?= $socialMedias['name'];?></a>
                        </li>
                        <?php
                       }
                    } else {
                      echo "<li>No Record Found</li>";
                    }
                    
                  } else {
                    echo "<li>Something Went Wrong </li>";
                  }
                  
                ?>
              </ul>
            </div>
            <div class="col-md-4">
              <h4 class="footer-heading">Contact Information</h4> 
              <hr>
              <p>
                Email: <?= webSettings('email1') ?? ''; ?>, <?= webSettings('email2') ?? ''; ?>
              </p>
              <p>
                Contact: <?= webSettings('phone1') ?? ''; ?>, <?= webSettings('phone2') ?? ''; ?>
              </p>
              <p>
                Contact: <?= webSettings('address') ?? ''; ?>
              </p>
            </div>
        </div>
    </div>
</div>