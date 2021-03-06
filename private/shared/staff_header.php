<?php
  if(!isset($page_title)) { $page_title = 'Staff Area'; }
?>
<!doctype html>
<html lang="en">
  <head>
    <title>GBI - <?php echo h($page_title); ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/assets/stylesheets/staff.css'); ?>" />
  </head>
  <body>
    <header>
      <h1>GBI Staff Area</h1>
    </header>
    <nav>
      <ul>
        <li>User: <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?></li>
        <li><a href="<?php echo url_for('/login/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/login/logout.php'); ?>">Logout</a></li>
      </ul>
    </nav>
<?php echo display_session_message(); ?>