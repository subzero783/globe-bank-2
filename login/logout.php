<?php
require_once('../private/initialize.php');
//unset($_SESSION['username']);
// or you could use
//$_SESSION['username'] = NULL;
log_out();
redirect_to(url_for('/login/login.php'));
?>