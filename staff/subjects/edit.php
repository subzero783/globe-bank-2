<?php
require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/subjects/index.php'));
}
$id = $_GET['id'];
if(is_post_request()) {
  $subject = [];
  $subject['id'] = $id;
  $subject['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : '';
  $subject['position'] = isset($_POST['position']) ? $_POST['position'] : '';
  $subject['visible'] = isset($_POST['visible']) ? $_POST['visible'] : '';
  $editedArray = edit_subject($subject);
  if(isset($editedArray['updated'])){
    if($editedArray['updated'] == true){
      $_SESSION['message'] = 'The subject was updated successfully.';
      redirect_to(url_for('/staff/subjects/show.php?id=' . h(u($subject['id']))));
    }
  }
}else if(is_get_request()){
    $subject = get_subject_by_id($id);
}
?>
<?php $page_title = 'Edit Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject edit">
    <h1>Edit Subject</h1>
    <?php 
    if(isset($editedArray['errors'])){
        show_validation_errors($editedArray['errors']); 
    } ?>
    <form action="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo h($subject['menu_name']); ?>" /></dd>
      </dl>
      <?php 
         $subjectCount = count_rows_subects_table();
      ?>
      <dl>
        <dt>Position</dt>
        <dd>
            <select name="position">
            <?php
                for($i=1; $i <= $subjectCount; $i++) {
                  echo "<option value=\"{$i}\"";
                if($subject['position'] == $i) {
                  echo " selected";
                }
                  echo ">{$i}</option>";
                }
                ?>
            </select>
        </dd>
    </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1"<?php if($subject['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Subject" />
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>