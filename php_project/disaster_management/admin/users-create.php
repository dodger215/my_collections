<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Add Users
                 <a href="users.php" class="btn btn-primary float-end">View Users</a>
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
                        <label for="">Role</label>
                        <select name="role" id="" class="form-select">
                            <option value="admin" class="">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Select Role</label>
                        <input type="checkbox" name="is_ban" id="">
                    </div>
                     <div class="mb-3">
                        <button type="submit" name="saveUser" class="btn btn-primary">Save</button>
                     </div>
                 </form>
            </div>
        </div>
    </div>
   </div>
<?php  include('includes/footer.php'); ?>