<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Add Social Media Link
                 <a href="services.php" class="btn btn-primary float-end">Services</a>
               </h4>
            </div>
            <div class="card-body">
                <?= alertMessage(); ?>
                 <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Small Description</label>
                        <textarea name="small_description" id="" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Long Description</label>
                        <textarea name="long_description" id="" rows="3" class="form-control mySummerNote"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Upload Image</label>
                        <input type="file" name="image" id="" class="form-control">
                    </div>
                    <h5>SEO Tags</h5>
                    <div class="mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" name="meta_title" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Meta Description</label>
                        <textarea name="meta_description" id="" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="">Meta Keywords</label>
                        <input type="text" name="meta_keywords" id="" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="">Select Role</label>
                        <input type="checkbox" name="status" id="">
                    </div>
                     <div class="mb-3">
                        <button type="submit" name="saveServices" class="btn btn-primary">Save</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
   </div>
<?php  include('includes/footer.php'); ?>