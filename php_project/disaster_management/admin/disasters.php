<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Disater List
                 <a href="disaster_create.php" class="btn btn-primary float-end">Add disaster</a>
               </h4>
            </div>
            <div class="card-body">
              <?= alertMessage(); ?>
               <table class="table" id="myTable">
                 <thead>
                  <tr>
                    <th>Name</th>
                    <th>Date of the Event</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                 </thead>
                 <tbody>
                  <?php
                  //Fecthing the records from the database
                    $disaster = getAll('disaster');
                    if (mysqli_num_rows($disaster) > 0) {
                      foreach($disaster as $disasterItem){
                        ?>
                          <tr>
                             <td><?= $disasterItem['type'];?></td>
                             <td><?= $disasterItem['date_of_event'];?></td>
                             <td><?= $disasterItem['description'];?></td>
                             <td><?= $disasterItem['status'];?></td>
                             <td>
                               <a href="view-disaster.php?id=<?= $disasterItem['id'];?>" class="btn btn-success btn-sm">View</a>
                               <a href="delete-disaster.php?id=<?= $disasterItem['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
                             </td>
                             <td>
                              <a href="https://www.openstreetmap.org/search?query=<?= $disasterItem['location'];?>" class="btn btn-success btn-sm">View on map</a>
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