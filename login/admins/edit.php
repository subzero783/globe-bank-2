<?php

require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/admins/index.php'));
}
$id = $_GET['id'];

if(is_post_request()) {
  $admin = [];
  $admin['id'] = $id;
  $admin['first_name'] = isset($_POST['first_name']) ? $_POST['first_name'] : '';
  $admin['last_name'] = isset($_POST['last_name']) ? $_POST['last_name'] : '';
  $admin['email'] = isset($_POST['email']) ? $_POST['email'] : '';
  $admin['username'] = isset($_POST['username']) ? $_POST['username'] : '';
  $admin['password'] = isset($_POST['password']) ? $_POST['password'] : '';
  $admin['confirm_password'] = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

  $editedArray = update_admin($admin);
  if(isset($editedArray['updated'])){
    if($editedArray['updated'] == true){
      $_SESSION = 'Admin updated.';
      redirect_to(url_for('/staff/admins/show.php?id=' . h(u($id))));
    }
  }
} else {
  $admin = find_admin_by_id($id);
}

?>

<?php $page_title = 'Edit Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

  <div class="admin edit">
    <h1>Edit Admin</h1>
    <?php 
    if(isset($editedArray['errors'])){
        show_validation_errors($editedArray['errors']); 
    } ?>
    <form action="<?php echo url_for('/staff/admins/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First name</dt>
        <dd><input type="text" name="first_name" value="<?php echo h($admin['first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name</dt>
        <dd><input type="text" name="last_name" value="<?php echo h($admin['last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Username</dt>
        <dd><input type="text" name="username" value="<?php echo h($admin['username']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email</dt>
        <dd><input type="text" name="email" value="<?php echo h($admin['email']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Password</dt>
        <dd><input type="password" name="password" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password</dt>
        <dd><input type="password" name="confirm_password" value="" /></dd>
      </dl>
      <p>
        Passwords should be at least 6 characters and include at least one uppercase letter, lowercase letter, number, and symbol.
      </p>
      <br />

      <div id="operations">
        <input type="submit" value="Edit Admin" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
