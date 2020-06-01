<!doctype html>
<html lang="en">
  <head>
    <title>QASREP <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?><?php if(isset($preview) && $preview) { echo ' [PREVIEW]'; } ?></title>
    <meta charset="utf-8">
    <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo url_for('/assets/dist/css/style.min.css?cb=123');?>"/>
  </head>
  <body>
    <!--
    <header>
      <a id="main-nav-logo-link" href="<?php echo url_for('/'); ?>">
        <img src="<?php echo url_for('/assets/images/gbi_logo.png'); ?>" width="298" height="71" alt="" />
      </a>
    </header> -->
        <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-center">
      <div class="container d-flex align-items-center">

        <div class="logo mr-auto">
          <h1 class="text-light"><a href="<?php echo url_for('/'); ?>"><span>Vesperr</span></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

