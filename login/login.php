<?php
require_once('../private/initialize.php');
$errors = log_in_verification($_POST, '/dashboard/');
?>
<?php $page_title = 'Log in'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
  <h1>Log in</h1>
  <?php echo display_errors($errors); ?>
  <form action="login.php" method="post">
    Username:<br />
    <!-- <input type="text" name="username" value="<?php //echo h($username); ?>" /><br /> -->
    <input type="text" name="username" value="" /><br />
    Password:<br />
    <input type="password" name="password" value="" /><br />
    <input type="submit" name="submit" value="Submit"  />
  </form>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>