<?php require_once('../../private/initialize.php');
require_login();
?>
<?php $page_title = 'Subjects'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
  <div class="subjects listing">
    <h1>Subjects</h1>
    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/subjects/new.php'); ?>">Create New Subject</a>
    </div>
    <table class="list">
      <tr>
        <th>ID</th>
        <th>Position</th>
        <th>Visible</th>
        <th>Menu Name</th>
        <th>Pages Count</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
      <?php $subjects = get_all_subjects_order_by_position(); ?>
      <?php foreach($subjects as $subject){ ?>
        <tr>
          <td><?php echo h($subject['id']);?></td>
          <td><?php echo h($subject['position']);?></td>
          <td><?php echo h($subject['visible']) == 1 ? 'true' : 'false';?></td>
          <td><?php echo h($subject['menu_name']);?></td>
          <td><?php echo count_pages_by_subject_id($subject['id']);?></td>
          <td><a class='action' href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($subject['id'])));?>">View</a></td>
          <td><a class='action' href="<?php echo url_for('/staff/subjects/edit.php?id=' . h(u($subject['id'])));?>">Edit</a></td>
          <td><a class='action 'href=";<?php echo url_for('/staff/subjects/delete.php?id=' . h(u($subject['id'])));?>">Delete</a></td>
        </tr>
      <?php } ?>
  	</table>
  </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>
