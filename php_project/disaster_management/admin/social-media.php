<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Socal Media Lists
                 <a href="social-media-create.php" class="btn btn-primary float-end">Add Social Media Link</a>
               </h4>
            </div>
            <div class="card-body">
              <?= alertMessage(); ?>
               <table class="table">
                 <thead>
                  <tr>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                 </thead>
                 <tbody>
                  <?php
                  //Fecthing the records from the database
                    $social_media = getAll('social_media');
                    if (mysqli_num_rows($social_media) > 0) {
                      foreach($social_media as $social_mediaItem){
                        ?>
                          <tr>
                             <td><?= $social_mediaItem['name'];?></td>
                             <td><?= $social_mediaItem['url'];?></td>
                             <td><?= $social_mediaItem['status'] == 1 ? 'Not Available':'Active';?></td>
                             <td>
                               <a href="edit-social-media.php?id=<?= $social_mediaItem['id'];?>" class="btn btn-success btn-sm">Edit</a>
                               <a href="delete-social-media.php?id=<?= $social_mediaItem['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                             </td>
                           </tr>
                        <?php
                      }
                    } else {
                      ?>
                       <tr>
                        <td colspan="5">No Record Found</td>
                       </tr>
                      <?php
                    }
                    
                  ?>
                 </tbody>
               </table>
            </div>
        </div>
    </div>
   </div>
<?php  include('includes/footer.php'); ?>