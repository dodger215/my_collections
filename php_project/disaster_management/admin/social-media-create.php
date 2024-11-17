<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Add Social Media Link
                 <a href="social-media.php" class="btn btn-primary float-end">Social Media Links</a>
               </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                 <form action="code.php" method="POST">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">URL</label>
                        <input type="text" name="url" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Select Role</label>
                        <input type="checkbox" name="status" id="">
                    </div>
                     <div class="mb-3">
                        <button type="submit" name="saveSocialMedia" class="btn btn-primary">Save</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
   </div>
<?php  include('includes/footer.php'); ?>