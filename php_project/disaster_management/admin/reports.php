<?php include('includes/header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <h3 class="text-center py-4">
                    Generate Reports
                </h3>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <a href="reports_create.php" class="btn btn-primary">Click To Generate Disaster Reports</a>
                            </div>
                        </div>

                        <?= alertMessage(); ?>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //Fecthing the records from the database
                                $reports = mysqli_query($conn, "SELECT r.*, d.* FROM reports r, disaster d WHERE d.id = r.disaster_id ORDER BY r.id DESC");
                                if (mysqli_num_rows($reports) > 0) {
                                    foreach ($reports as $reportsItem) {
                                ?>
                                        <tr>
                                            <td><?= $reportsItem['type']; ?></td>
                                            
                                            <td>
                                                <a href="edit-reports.php?id=<?= $reportsItem['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <a href="delete-reports.php?id=<?= $reportsItem['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this record?')">Delete</a>
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

        <?php include('includes/footer.php'); ?>