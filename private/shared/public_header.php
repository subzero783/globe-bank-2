<!doctype html>
<html lang="en">
  <head>
    <title>QASREP <?php if(isset($page_title)) { echo '- ' . h($page_title); } ?><?php if(isset($preview) && $preview) { echo ' [PREVIEW]'; } ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/assets/stylesheets/public.css'); ?>" />
    <link rel="stylesheet" href="<?php echo url_for('/assets/build/main.min.css');?>"/>
  </head>
  <body>
    <header>
      <a id="main-nav-logo-link" href="<?php echo url_for('/'); ?>">
        <img src="<?php echo url_for('/assets/images/gbi_logo.png'); ?>" width="298" height="71" alt="" />
      </a>
    </header>