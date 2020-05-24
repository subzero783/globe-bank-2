<?php 
require_once('../private/initialize.php');
require_login('/login/');
if(!empty($_GET['id']) && isset($_GET['id'])){
  print_r($_GET['id']);
}


?>
<h1>Dashboard</h1>