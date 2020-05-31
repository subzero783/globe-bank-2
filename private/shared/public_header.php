<!doctype html>
<html lang="en">
  <head>
    <title>QASREP <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?><?php if(isset($preview) && $preview) { echo ' [PREVIEW]'; } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo url_for('/assets/dist/css/style.css?cb=123');?>"/>
  </head>
  <body>
    <header>
      <a id="main-nav-logo-link" href="<?php echo url_for('/'); ?>">
        <img src="<?php echo url_for('/assets/images/gbi_logo.png'); ?>" width="298" height="71" alt="" />
      </a>
    </header>