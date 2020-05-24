<?php require_once('../private/initialize.php'); 
require_login('/login/login.php', true);
// redirect_to(url_for('/login/index.php'));

echo $_SESSION['user_id'];

?>
<h1>Pages</h1>
