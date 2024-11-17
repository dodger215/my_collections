<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Edit Social Media Link
                 <a href="social-media.php" class="btn btn-primary float-end">Social Media Links</a>
               </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                 <form action="code.php" method="POST">
                 <?php
                       //Fecthing the records
                       $paramResult = checkParamiterId('id');
                       if (!is_numeric($paramResult)) {
                        echo '<h5>'.$paramResult.'</h5>';
                        return false;
                       }

                       //Fetching a single data
                       $social_media = getById('social_media', checkParamiterId('id'));
                       if ($social_media['status'] == 200) {
                        ?>
                    <input type="hidden" name="socialMediaId" value="<?= $social_media['data']['id'];?>">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" value="<?= $social_media['data']['name'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="">URL</label>
                        <input type="text" name="url" id="" class="form-control" value="<?= $social_media['data']['url'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Select Role</label>
                        <input type="checkbox" name="status" id="" value="<?= $social_media['data']['status'] == 1 ? 'checked':'';?>">
                    </div>
                     <div class="mb-3">
                        <button type="submit" name="updateSocialMedia" class="btn btn-primary">Save</button>
                     </div>
                 </form>
            </div>
            <?php
               }else{
                echo '<h5>'.$social_media['messgae'].'</h5>';
              }
            ?>
        </div>
    </div>
   </div>
<?php  include('includes/footer.php'); ?>