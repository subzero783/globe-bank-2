<?php require_once('../private/initialize.php'); ?>
<?php //unset($_SESSION['admin_id']);?>
<?php require_login('/login/login.php'); 
// Check if user is an admin by checking if their level is 1
  // If their level is 1 rediect to pages/
  // Else redirect to dashboard/
?>
<?php $page_title = 'Staff Menu'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
  <div id="main-menu">
    <h2>Main Menu</h2>
    <ul>
      <li><a href="<?php echo url_for('/login/subjects/index.php'); ?>">Subjects</a></li>
      <!--<li><a href="<?php echo url_for('/login/pages/index.php'); ?>">Pages</a></li>-->
      <li><a href="<?php echo url_for('/login/admins/index.php'); ?>">Admins</a></li>
    </ul>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
 