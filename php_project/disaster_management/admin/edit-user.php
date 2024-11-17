<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Edit Users
                 <a href="users.php" class="btn btn-primary float-end">View Users</a>
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
                       $user = getById('users', checkParamiterId('id'));
                       if ($user['status'] == 200) {
                        ?>
                          
                    <input type="hidden" name="userId" id="" required value="<?= $user['data']['id'];?>">

                    <div class="mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" id="" class="form-control" required value="<?= $user['data']['name'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Contact</label>
                        <input type="text" name="phone" id="" class="form-control" required value="<?= $user['data']['phone'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" id="" class="form-control" required value="<?= $user['data']['email'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Password</label>
                        <input type="password" name="password" id="" class="form-control" required value="<?= $user['data']['password'];?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Role</label>
                        <select name="role" id="" class="form-select" required>
                            <option value="admin" class="" value="<?= $user['data']['role'] == 'admin' ?'Selected':'Not Selected';?>">Admin</option>
                            <option value="user" value="<?= $user['data']['role'] == 'user' ?'Not Selected':'Selected';?>">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="">Is Ban</label>
                        <input type="checkbox" name="is_ban" id="" value="<?= $user['data']['is_ban'] == true ?'checked':'';?>">
                    </div>
                     <div class="mb-3">
                        <button type="submit" name="updateUser" class="btn btn-primary">Update</button>
                     </div>
                 </form>
            </div>
            <?php
               }else{
                echo '<h5>'.$user['messgae'].'</h5>';
              }
            ?>
        </div>
    </div>
   </div>
<?php  include('includes/footer.php'); ?>