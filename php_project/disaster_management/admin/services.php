<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 Socal Media Lists
                 <a href="services-create.php" class="btn btn-primary float-end">Add Services</a>
               </h4>
            </div>
            <div class="card-body">
              <?= alertMessage(); ?>
               <table class="table" id="myTable">
                 <thead>
                  <tr>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Small Description</th>
                    <th>Image</th>
                    <th>Satus</th>
                    <th>Action</th>
                  </tr>
                 </thead>
                 <tbody>
                  <?php
                  //Fecthing the records from the database
                    $services = getAll('services');
                    if (mysqli_num_rows($services) > 0) {
                      foreach($services as $servicesItem){
                        ?>
                          <tr>
                             <td><?= $servicesItem['name'];?></td>
                             <td><?= $servicesItem['slug'];?></td>
                             <td><?= $servicesItem['small_description'];?></td>
                             <td><img src="<?= '../'.$servicesItem['image'];?>" alt="" style="width: 300px; height: 300px"></td>
                             <td><?= $servicesItem['status'] == 1 ? 'Not Available':'Active';?></td>
                             <td>
                               <a href="edit-services.php?id=<?= $servicesItem['id'];?>" class="btn btn-success btn-sm">Edit</a>
                               <a href="delete-services.php?id=<?= $servicesItem['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
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