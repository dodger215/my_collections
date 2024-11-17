<?php  include('includes/header.php'); ?>
   <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
               <h4>
                 View Enquiries 
                 <a href="enquiries.php" class="btn btn-primary float-end">View Enquiries</a>
               </h4>
            </div>
            <div class="card-body">
                <?php
                      //Fecthing the records
                      $paramResult = checkParamiterId('id');
                    if (!is_numeric($paramResult)) {
                       echo '<h5>'.$paramResult.'</h5>';
                       return false;
                      }

                      //Fetching a single data
                  $enquiries = getById('enquiries', checkParamiterId('id'));
                  if ($enquiries['status'] == 200) {
                ?>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td><?= $enquiries['data']['name']?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?= $enquiries['data']['email']?></td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td><?= $enquiries['data']['phone']?></td>
                        </tr>
                        <tr>
                            <td>Service</td>
                            <td><?= $enquiries['data']['service']?></td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td><?= $enquiries['data']['message']?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3">
                    <div class="card border card-body">
                        <form action="code.php" method="post">
                            <input type="hidden" name="statusId" value="<?= $enquiries['data']['id']?>">
                        <?= alertMessage(); ?>
                         <div class="row">
                            <div class="col-md-4">
                                <label for="">Update Status</label>
                                <select name="status" id="" class="form-select">
                                    <option value="pending" <?= $enquiries['data']['status'] == 'pending' ? 'selected':''?> >Pending</option>
                                    <option value="completed" <?= $enquiries['data']['status'] == 'completed' ? 'selected':''?>>Completed</option>
                                    <option value="cancelled" <?= $enquiries['data']['status'] == 'cancelled' ? 'selected':''?>>Canceled</option>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <br>
                                <button type="submit" name="updateStatus" class="btn btn-primary">Update</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
                <?php
            }else{
                echo '<h5>'.$enquiries['messgae'].'</h5>';
            }
           ?>
            </div>
        </div>
    </div>
   </div>
<?php  include('includes/footer.php'); ?>