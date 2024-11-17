<?php
  require '../admin/config/function.php';

  //Inserting Users Data Into The Database
 if (isset($_POST['saveUser'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $is_ban = validate($_POST['is_ban']) == true ? 1:0;
    $role = validate($_POST['role']);

    if ($name != '' || $email != '' || $phone != '' || $password != '') {
        //Inserting Data
        $query = "INSERT INTO users(name, phone, email, password, is_ban, role) 
        VALUES('$name','$phone','$email','$password','$is_ban','$role')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('users.php', "User / Admin Added Successfully");
        } else {
            redirect('users-create.php', "Something went wrong");
        }
        
    }else{
        redirect('users-create.php', "All fileds are required");
    }
 }

 //Updating The Users Records In the Database
 if (isset($_POST['updateUser'])) {
    $name = validate($_POST['name']);
    $phone = validate($_POST['phone']);
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    $is_ban = validate($_POST['is_ban']) == true ? 1:0;
    $role = validate($_POST['role']);

    //Defining the user id
    $userId = validate($_POST['userId']);
    $user = getById('users', $userId);
    if ($user['status'] != 200) {
        redirect('edit-user.php?id='.$userId, "No Such Id Found");
    }
    if ($name != '' || $email != '' || $phone != '' || $password != '') {
        //Updating Data
        $query = "UPDATE users SET 
        name ='$name', 
        phone ='$phone', 
        email ='$email', 
        password ='$password', 
        is_ban ='$is_ban', 
        role ='$role' 
        WHERE id= '$userId'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('users.php', "User / Admin Updated Successfully");
        } else {
            redirect('edit-user.php', "Something went wrong");
        }
        
    }else{
        redirect('edit-user.php', "All fileds are required");
    }
 }
 

 //Saving the Data in settings
 if (isset($_POST['saveSetting'])) {
    $title = validate($_POST['title']);
    $slug = validate($_POST['slug']);
    $small_description = validate($_POST['small_description']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keywords = validate($_POST['meta_keywords']);
    $email1 = validate($_POST['email1']);
    $email2 = validate($_POST['email2']);
    $phone1 = validate($_POST['phone1']);
    $phone2 = validate($_POST['phone2']);
    $address = validate($_POST['address']);

    $settingId = validate($_POST['settingId']);

    if ($settingId == 'insert') {
        $query = "INSERT INTO settings(title, slug, small_description, meta_description, meta_keywords, email1, email2, phone1, phone2, address)
        VALUES('$title','$slug','$small_description','$meta_description', '$meta_keywords', '$email1', '$email2', '$phone1', '$phone2', '$address')";
        $result = mysqli_query($conn, $query);
    }

    //Updating the record
    if (is_numeric($settingId)) {
        $query = "UPDATE settings SET 
        title='$title',
        slug='$slug',
        small_description='$small_description',
        meta_description='$meta_description',
        meta_keywords='$meta_keywords',
        email1='$email1',
        email2='$email2',
        phone1='$phone1',
        phone2='$phone2',
        address='$address' 
        WHERE id='$settingId'";
        $result = mysqli_query($conn, $query);
    }

    //Inserting and redirecting
    if ($result) {
        redirect('settings.php', 'Record Saved Successful');
    }else{
        redirect('settings.php', 'Something Went Wrong');
    }
 }



  //Creating Appoinments
  if (isset($_POST['disasterSave'])) {
    $type = validate($_POST['type']);
    $date_of_event = validate($_POST['date_of_event']);
    $loc_of_event = validate($_POST['loc_of_event']);
    $description= validate($_POST['description']);
    $status = validate($_POST['status']);

    if ($type != '' || $description != '' || $date_of_event != '') {
        //Inserting Data
        if (isset($_FILES['pic_of_event']) && $_FILES['pic_of_event']['error'] === UPLOAD_ERR_OK) {

                $file_name = $_FILES['pic_of_event']['name'];
                $tmp_name = $_FILES['pic_of_event']['tmp_name'];
                $file_up_name = time().$file_name;
                move_uploaded_file($tmp_name, "image/".$file_up_name);


        
        $query = "INSERT INTO disaster(type,date_of_event,description,status,location,picture) 
                VALUES('type','$date_of_event','$description','status','$loc_of_event','$file_up_name')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('disasters.php', "Appoinment Added Successfully");
            } else {
             redirect('disaster_create.php', "Something went wrong");
            }
        }
            }
    
    // Read the image file into a variable

        
        
    }        


 //Creating Reports
 if (isset($_POST['reportGenerate'])) {
    $disaster_id = validate($_POST['disaster_id']);
    $disaster_id1 = validate($_POST['disaster_id1']);
    $disaster_id2 = validate($_POST['disaster_id2']);
    $disaster_id3 = validate($_POST['disaster_id3']);

    if ($disaster_id != '' || $disaster_id1 != '' || $disaster_id2 != '') {
        //Inserting Data
        $query = "INSERT INTO reports(disaster_id,disaster_id1,disaster_id2,disaster_id3) 
        VALUES('disaster_id','$disaster_id1','$disaster_id2','disaster_id3')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('reports.php', "Disaster Report Generated Successfully");
        } else {
            redirect('reports_create.php', "Something went wrong");
        }
        
    }else{
        redirect('reports_create.php', "All fileds are required");
    }
 }


  //Updating Appoinments
  if (isset($_POST['updateAppointments'])) {
    $type = validate($_POST['type']);
    $description = validate($_POST['description']);
    $created_at= validate($_POST['created_at']);
    $status = validate($_POST['status']) == true ? 1:0;

    $appointmentId = validate($_POST['appointmentId']);

    if ($type != '' || $description != '' || $created_at != '') {
        //Updating Data
        $query = "UPDATE appoinments SET
        type = '$type',
        description = '$description',
        created_at = '$created_at',
        status= '$status'
        WHERE id='$appointmentId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('appointments.php', "Appoinment Added Updated Successfully");
        } else {
            redirect('appoinments-edit.php', "Something went wrong");
        }
        
    }else{
        redirect('appoinments-edit.php', "All fileds are required");
    }
 }



 //Inserting Social media Links
 if (isset($_POST['saveSocialMedia'])) {
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = validate($_POST['status']) == true ? 1:0;

    if ($name != '' || $url != '') {
        //Inserting Data
        $query = "INSERT INTO social_media(name, url, status) 
        VALUES('$name','$url','$status')";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('social-media.php', "Socail Media Link Added Successfully");
        } else {
            redirect('social-media-create.php', "Something went wrong");
        }
        
    }else{
        redirect('social-media-create.php', "All fileds are required");
    }
 }

 //Updating social Media Links
 if (isset($_POST['updateSocialMedia'])) {
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = validate($_POST['status']) == true ? 1:0;

    $socialMediaId = validate($_POST['socialMediaId']);

    if ($name != '' || $url != '') {
        //Updating Data
        $query = "UPDATE social_media SET
        name = '$name',
        url = '$url',
        status= '$status'
        WHERE id='$socialMediaId' LIMIT 1";
        $result = mysqli_query($conn, $query);
        if ($result) {
            redirect('social-media.php', "Socail Media Link Updated Successfully");
        } else {
            redirect('edit-social-media-create.php', "Something went wrong");
        }
        
    }else{
        redirect('edit-social-media-create.php', "All fileds are required");
    }
 }

 //Inserting Service Data
 if (isset($_POST['saveServices'])) {
    $name = validate($_POST['name']);

    //Converting the name to lowercases
    $slug = str_replace('', '-', strtolower($name));
    $small_description = validate($_POST['small_description']);
    $long_description = validate($_POST['long_description']);

    //Checking if the image is uploaded
    if ($_FILES['image']['size'] > 0) {
        //The image with the name
        $image = $_FILES['image']['name'];
        //The path
        $path = "../assets/uploads/services/";

        //The extension
        $imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if ($imageType != 'jpg' && $imageType != 'png' && $imageType != 'jpeg' && $imageType != 'tiff') {
            redirect('services-create.php', "Wrong Image Format");
        }
        $imgExt = pathinfo($image, PATHINFO_EXTENSION);
        $fileName = time().'.'.$imgExt;
        $finalImage = 'assets/uploads/services/'.$fileName;
    }else{
        $finalImage = NULL;
    }
    $meta_title = validate($_POST['meta_title']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keywords = validate($_POST['meta_keywords']);
    $status = validate($_POST['status']) == true ? 1:0;

    //Inserting The data
    $query = "INSERT INTO services(name, slug, small_description, long_description, image, meta_title, meta_description, meta_keywords, status)
           VALUES ('$name', '$slug', '$small_description', '$long_description', '$finalImage', '$meta_title', '$meta_description', '$meta_keywords', '$status')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        if ($_FILES['image']['size'] > 0) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.$fileName);
        }
        
        redirect('services.php', "Service saved Successfully");
    } else {
        redirect('services-create.php', "Something went wrong");
    }
 }

 //Updating the services
 if (isset($_POST['updateServices'])) {
    $name = validate($_POST['name']);

    //Converting the name to lowercases
    $slug = str_replace('', '-', strtolower($name));
    $small_description = validate($_POST['small_description']);
    $long_description = validate($_POST['long_description']);

    //Geting the service Id
    $serviceId = validate($_POST['serviceId']);
    $services = getById('services', $serviceId);

    //Checking if the image is uploaded
    if ($_FILES['image']['size'] > 0) {

        //The image with the name
        $image = $_FILES['image']['name'];

        //The path
        $path = "../assets/uploads/services/";

        //The extension
        $imageType = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if ($imageType != 'jpg' && $imageType != 'png' && $imageType != 'jpeg' && $imageType != 'tiff') {
            redirect('services-create.php', "Wrong Image Format");
        }

        //Deleting the old image before uploading New one
        $deleteImage = "../".$services['data']['image'];
        
        //Checking if the file exists
        if (file_exists($deleteImage)) {
            unlink($deleteImage);
        }
        $imgExt = pathinfo($image, PATHINFO_EXTENSION);
        $fileName = time().'.'.$imgExt;
        $finalImage = 'assets/uploads/services/'.$fileName;
    }else{
        $finalImage = $services['data']['image'];
    }
    $meta_title = validate($_POST['meta_title']);
    $meta_description = validate($_POST['meta_description']);
    $meta_keywords = validate($_POST['meta_keywords']);
    $status = validate($_POST['status']) == true ? 1:0;

    //Updating the data
    $query = "UPDATE services SET 
    name = '$name', 
    slug = '$slug', 
    small_description = '$small_description', 
    long_description = '$long_description', 
    image = '$finalImage', 
    meta_title = '$meta_title', 
    meta_description = '$meta_description', 
    meta_keywords = '$meta_keywords', 
    status = $status
    WHERE id='$serviceId' ";

    //Updating the data
    $result = mysqli_query($conn, $query);
    if ($result) {
        if ($_FILES['image']['size'] > 0) {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.$fileName);
        }
        
        redirect('services.php', "Service updated Successfully");
    } else {
        redirect('services-create.php', "Something went wrong");
    }
 }

 //Updating Enquiries Status
 if (isset($_POST['updateStatus'])) {
    $status = validate($_POST['status']);
    $statusId = validate($_POST['statusId']);

    $query = "UPDATE enquiries SET status='$status' WHERE id='$statusId'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        redirect('enquiries.php', "Enquiries status updated Successfully");
    }else{
        redirect('enquiries.php', "Enquiries not updated");
    }
 }

 //Updating Enquiries Status
 if (isset($_POST['updateAppStatus'])) {
    $status = validate($_POST['status']);
    $statusId = validate($_POST['statusId']);

    $query = "UPDATE appoinmentenquiries SET status='$status' WHERE id='$statusId'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        redirect('bookings.php', "Appointments status updated Successfully");
    }else{
        redirect('bookings.php', "Appointments not updated");
    }
 }
?>