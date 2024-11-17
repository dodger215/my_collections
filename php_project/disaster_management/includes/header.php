<?php
  require './admin/config/function.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if (isset($pageTitle)) {
        echo $pageTitle;
    } else{
        webSettings('title') ?? 'CASE (Cascading Style Evolution)';
    }?></title>
    <meta name="description" content="<?= webSettings('meta_description') ?? 'CASE (Cascading Style Evolution)'; ?>">
    <meta name="keywords" content="<?= webSettings('meta_keywords') ?? 'CASE (Cascading Style Evolution)'; ?>">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
</head>
<body>

<?php
  include('includes/navbar.php');
?>