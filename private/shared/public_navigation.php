<?php 
	$page_id = isset($page_id) ? $page_id : '';
	$subject_id = isset($subject_id) ? $subject_id : '';
	$visible = isset($visible) ? $visible : true;
?>
<nav>
	<?php $nav_subjects = get_all_subjects_order_by_position(['visible' => $visible]);?>
	<ul class="subjects">
		<?php foreach($nav_subjects as $nav_subject){ ?>
			<li class="<?php if($nav_subject['id'] == $subject_id){ echo 'selected';}?>">
				<a href="<?php echo url_for('index.php?subject_id=' . h(u($nav_subject['id']))); ?>">
					<?php echo $nav_subject['menu_name'];?>
				</a>
				<?php $nav_pages = find_pages_by_subject_id($nav_subject['id'], ['visible' => $visible]);?>
				<ul class="pages">
					<?php foreach($nav_pages as $nav_page){ ?>
						<li class="<?php if($nav_page['id'] == $page_id){ echo 'selected';}?>">
							<a href="<?php echo url_for('index.php?id=' . h(u($nav_page['id'])));?>">
								<?php echo $nav_page['menu_name'];?>
							</a>
						</li>
					<?php } ?>
				</ul>
			</li>
		<?php } ?>
	</ul>
</nav>