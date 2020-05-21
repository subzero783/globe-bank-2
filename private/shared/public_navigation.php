<?php 
	$page_slug = isset($page_slug) ? $page_slug : '';
	$subject_id = isset($subject_id) ? $subject_id : '';
  $visible = isset($visible) ? $visible : true;
?>
<nav>
  <?php $pages = get_all_pages(['visible' => $visible]);
  print_r($_GET['page_slug']);
  print_r($_GET['posts_id']);
  ?>
	<ul class="pages">
		<?php foreach($pages as $page){ ?>
			<li class="<?php if($page['page_slug'] == $page_slug){ echo 'selected';}?>">
				<a href="/<?php echo h(u($page['page_slug'])); ?>/">
					<?php echo $page['page_name'];?>
				</a>
			</li>
		<?php } ?>
	</ul>
</nav>