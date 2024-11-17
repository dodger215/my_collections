<?php
 require 'admin/config/function.php';

 if (isset($_SESSION['auth'])) {
    logouSession();
    redirect('login.php', 'Log Out Successfuly');
 }

?>