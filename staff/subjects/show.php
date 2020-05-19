<?php require_once('../../../private/initialize.php'); ?>
<?php
require_login();
 $id = isset($_GET['id']) ? $_GET['id'] : '1';
?>
<?php $page_title = 'Show Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>
<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>
  <div class="subject show">
  <?php $subject = get_subject_by_id($id); ?>
	<h1>Subject: <?php echo h($subject['menu_name']);?></h1>
	<div class='attributes'>
		<dl>
			<dt>Menu Name</dt>
			<dd><?php echo h($subject['menu_name']);?></dd>
		</dl>
		<dl>
			<dt>Position</dt>
			<dd><?php echo h($subject['position']);?></dd>
		</dl>
		<dl>
			<dt>Visible</dt>
			<?php $visible = $subject['visible'] == '1' ? 'true' : 'false';?>
			<dd><?php echo h($visible);?></dd>
		</dl>
	</div>
	<hr>
	<div class="pages listing">
		<h2>Pages</h2>
		<?php 
		/*$results = has_unique_page_menu_name("Wtf");
		var_dump($results);*/
		$pages =  find_pages_by_subject_id($id);
		?>
		<div class="actions">
			<a class="action" href="<?php echo url_for('/staff/pages/new.php?subject_id=' . h(u($subject['id']))); ?>">Create New Page</a>
		</div>
		<table class="list">
			<tr>
				<th>ID</th>
				<!-- <th>Subject</th> -->
				<th>Position</th>
				<th>Visible</th>
				<th>Menu Name</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
				<th>&nbsp;</th>
			</tr>
			<tr>
			<?php foreach($pages as $page) { ?>  
				<td><?php echo $page['id']; ?></td>
				<td><?php echo $page['position']; ?></td>
				<td><?php echo $page['visible'] == 1 ? 'true' : 'false'; ?></td>
				<td><?php echo $page['menu_name']; ?></td>
				<td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id']))); ?>">View</a></td>
				<td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
				<td><a class="action" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>">Delete</a></td>
			</tr>
			<?php } ?>
		</table>
    </div>
  </div>
</div>
