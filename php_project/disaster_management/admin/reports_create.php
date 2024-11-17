<?php include('includes/header.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h3 class="text-center py-4">
                    Generate Reports
                </h3>
                <div class="card-body">
                    <form action="code.php" method="POST">
                        <div class="mb-3">
                            <label for="">Disaster Type</label>
                            <select name="disaster_id" id="" class="form-select">
                                <?php
                                //Check for all categories
                                $categories = getALL('disaster');
                                //If true the dispaly
                                if ($categories) {
                                    //If Found Loop the records
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $disasterItem) {
                                            echo '<option value="' . $disasterItem['id'] . '">' . $disasterItem['type'] . '</option>';
                                        }
                                    } else {
                                        echo '<h5>No Disaster found</h5>';
                                    }
                                } else {
                                    echo '<h5>Something went wrong</h5>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Disater Description</label>
                            <select name="disaster_id1" id="" class="form-select">
                                <?php
                                //Check for all categories
                                $categories = getALL('disaster');
                                //If true the dispaly
                                if ($categories) {
                                    //If Found Loop the records
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $disasterItem) {
                                            echo '<option value="' . $disasterItem['id'] . '">' . $disasterItem['description'] . '</option>';
                                        }
                                    } else {
                                        echo '<h5>No Disaster found</h5>';
                                    }
                                } else {
                                    echo '<h5>Something went wrong</h5>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Disaster Status</label>
                            <select name="disaster_id2" id="" class="form-select">
                                <?php
                                //Check for all categories
                                $categories = getALL('disaster');
                                //If true the dispaly
                                if ($categories) {
                                    //If Found Loop the records
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $disasterItem) {
                                            echo '<option value="' . $disasterItem['id'] . '">' . $disasterItem['status'] . '</option>';
                                        }
                                    } else {
                                        echo '<h5>No Disaster found</h5>';
                                    }
                                } else {
                                    echo '<h5>Something went wrong</h5>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Disaster Date</label>
                            <select name="disaster_id3" id="" class="form-select">
                                <?php
                                //Check for all categories
                                $categories = getALL('disaster');
                                //If true the dispaly
                                if ($categories) {
                                    //If Found Loop the records
                                    if (mysqli_num_rows($categories) > 0) {
                                        foreach ($categories as $disasterItem) {
                                            echo '<option value="' . $disasterItem['id'] . '">' . $disasterItem['date_of_event'] . '</option>';
                                        }
                                    } else {
                                        echo '<h5>No Disaster found</h5>';
                                    }
                                } else {
                                    echo '<h5>Something went wrong</h5>';
                                }

                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="reportGenerate" class="btn btn-primary">Generate</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php include('includes/footer.php'); ?>