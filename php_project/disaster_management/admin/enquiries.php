<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <div class="row">
                <div class="col-md-5">
                <h4>
                 Enquiries Lists
               </h4>
                </div>
                <div class="col-md-7">
                  <form action="" method="post">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="date" name="date" id="" class="form-control" value="
                        <?= isset($_GET['date']) == true ? $_GET['date'] : '';
                        ?>" required>
                      </div>
                      <div class="col-md-4">
                        <select name="status" id="" class="form-select" required>
                          <option value="pending" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'pending' ? 'selected': '') : '';?> >Pending</option>
                          <option value="completed" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'completed' ? 'selected': '') : '';?> >Completed</option>
                          <option value="cancelled" <?= isset($_GET['status']) == true ? ($_GET['status'] == 'cancelled' ? 'selected': '') : '';?> >Cancelled</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="enquiries.php" class="btn btn-danger">Reset</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              <?= alertMessage(); ?>
               <table class="table" id="myTable">
                 <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                 </thead>
                 <tbody>
                  <?php
                  if (isset($_GET['date']) && $_GET['date'] != '' && isset($_GET['status']) && $_GET['status'] != '') {
                    //Fething the record from the database
                    $date = validate($_GET['date']);
                    $satus = validate($_GET['status']);
                    $enquiries = mysqli_query($conn, "SELECT * FROM enquiries WHERE created_at ='$date' AND status ='$satus' ORDER BY id DESC");
                  }else{
                  //Fecthing the records from the database
                    $enquiries = mysqli_query($conn, "SELECT * FROM enquiries ORDER BY id DESC");
                  }
                    if (mysqli_num_rows($enquiries) > 0) {
                      foreach($enquiries as $enquiriesItem){
                        ?>
                          <tr>
                             <td><?= $enquiriesItem['name'];?></td>
                             <td><?= $enquiriesItem['email'];?></td>
                             <td><?= $enquiriesItem['phone'];?></td>
                             <td><?= $enquiriesItem['message'];?></td>
                             <td><?= $enquiriesItem['status'];?></td>
                             <td><?= $enquiriesItem['created_at'];?></td>
                             <td>
                               <a href="enquiries-view.php?id=<?= $enquiriesItem['id'];?>" class="btn btn-success btn-sm">View</a>
                               <a href="delete-enquiries.php?id=<?= $enquiriesItem['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
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