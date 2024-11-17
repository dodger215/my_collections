<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Users Lists
                 <a href="users-create.php" class="btn btn-primary float-end">Add Users</a>
               </h4>
            </div>
            <div class="card-body">
              <?= alertMessage(); ?>
               <table class="table" id="myTable">
                 <thead>
                  <tr>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                 </thead>
                 <tbody>
                  <?php
                  //Fecthing the records from the database
                    $users = getAll('users');
                    if (mysqli_num_rows($users) > 0) {
                      foreach($users as $userItem){
                        ?>
                          <tr>
                             <td><?= $userItem['name'];?></td>
                             <td><?= $userItem['phone'];?></td>
                             <td><?= $userItem['email'];?></td>
                             <td><?= $userItem['role'];?></td>
                             <td><?= $userItem['is_ban'] == 1 ? 'Banned':'Active';?></td>
                             <td>
                               <a href="edit-user.php?id=<?= $userItem['id'];?>" class="btn btn-success btn-sm">Edit</a>
                               <a href="delete-user.php?id=<?= $userItem['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                             </td>
                           </tr>
                        <?php
                      }
                    } else {
                      ?>
                       <tr>
                        <td colspan="7">No Record Found</td>
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