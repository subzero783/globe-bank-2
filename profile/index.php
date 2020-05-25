<?php require_once('../private/initialize.php'); ?>
<?php //unset($_SESSION['admin_id']);?>
<?php require_login('/login/login.php'); ?>
<?php 

if(!empty($_GET['id']) && isset($_GET['id'])){
  print_r($_GET['id']);
}

?>
<h1>Profile</h1>