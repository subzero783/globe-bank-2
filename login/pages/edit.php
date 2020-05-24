<?php
require_once('../../../private/initialize.php');
require_login();
if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];
if(is_post_request()) {
  $page = [];
  $page['id'] = $id;
  $page['subject_id'] = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
  $page['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : '';
  $page['position'] = isset($_POST['position']) ? $_POST['position'] : '';
  $page['visible'] = isset($_POST['visible']) ? $_POST['visible'] : '';
  $page['content'] = isset($_POST['content']) ? $_POST['content'] : '';
  $pageUpdated = update_page_by_id($page);
  if(isset($pageUpdated['inserted'])){
    if($pageUpdated['inserted'] == true){
      $_SESSION['message'] = 'The page was updated successfully.';
      redirect_to( url_for('/staff/pages/show.php?id=' . u($id) ));
    }
  }
}else if(is_get_request()){
  $page = get_page_by_id($id);
}
  $page_set = get_all_pages_order_by_subject_id_and_position();
  $page_count = count_pages_by_subject_id($page['subject_id']);
?>
<?php $page_title = 'Edit Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">&laquo; Back to Subject Page</a>
  <div class="page edit">
    <h1>Edit Page</h1>
    <?php 
    if(isset($pageUpdated['errors'])){
			show_validation_errors($pageUpdated['errors']); 
    } ?>
    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>Subject</dt>
        <dd>
          <select name="subject_id">
          <?php
            $subjects = get_all_subjects_order_by_position();
            foreach($subjects as $subject){
              echo "<option value=\"" . $subject['id'] . "\"";
              if($page['subject_id'] == $subject['id']){
                echo " selected";
              }
              echo ">" . $subject['menu_name'] . "</option>";
            }
          ?>
          </select>
        </dd>
      </dl>
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php echo $page['menu_name']; ?>" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
            <?php
              for($i=1; $i <= $page_count; $i++) {
                echo "<option value=\"{$i}\"";
                if($page["position"] == $i) {
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
          <input type="checkbox" name="visible" value="1"<?php if($page['visible'] == "1") { echo " checked"; } ?> />
        </dd>
      </dl>
      <dl>
        <dt>Content</dt>
        <dd>
          <textarea name="content" cols="60" rows="10"><?php echo $page['content']; ?></textarea>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Edit Page" />
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>