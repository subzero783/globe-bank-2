<?php
require_once('../../../private/initialize.php');
require_login();
if(is_post_request()){ 
  //Handle form values sent by new.php
  $subject = [];
  $subject['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : '';
  $subject['position'] = isset($_POST['position']) ? $_POST['position'] : '';
  $subject['visible'] = isset($_POST['visible']) ? $_POST['visible'] : '';
  //var_dump($menu_name);
  $wasCreated = [];
  $wasCreated = create_new_subject($subject);
  //var_dump($wasCreated);
  if(isset($wasCreated['inserted'])){
    if($wasCreated['inserted'] == true){
      $_SESSION['message'] = 'The subject was created successfully.';
      redirect_to(url_for('/staff/subjects/show.php?id=' . h(u($wasCreated['last_id']))));
    }
  } 
}
?>
<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
<a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject new">
    <h1>Create Subject</h1>
    <?php 
    if(isset($wasCreated['errors'])){
        show_validation_errors($wasCreated['errors']); 
    } ?>
    <form action="<?php echo url_for('/staff/subjects/new.php'); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="<?php if(isset($subject['menu_name'])){ echo $subject['menu_name']; }?>" /></dd>
      </dl>
      <?php 
      $subjectCount = get_all_subjects_count();      
      ?>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
          <?php
          for($i=1; $i <= $subjectCount; $i++) {
            echo "<option value=\"{$i}\"";
          if($subjectCount == $i) {
            echo " selected";
          }
            echo ">{$i}</option>";
          }
          ?>
          </select>
        </dd>
      </dl>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" <?php if(isset($subject['visible'])) { if($subject['visible'] == '1'){echo " checked";} } ?>/>
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>

