<?php 
	$page_slug = isset($page_slug) ? $page_slug : '';
	$subject_id = isset($subject_id) ? $subject_id : '';
  $visible = isset($visible) ? $visible : true;
?>
<nav>
  <?php 
  $all_pages = get_all_pages(['visible' => $visible]);
  // echo (!empty($_GET['page_slug']) && isset($_GET['page_slug'])) ? $_GET['page_slug'] : '';
  // echo "<br>";
  // echo (!empty($_GET['posts_id']) && isset($_GET['posts_id'])) ? $_GET['posts_id'] : '';
  ?>
	<ul class="pages">
		<?php foreach($all_pages as $the_page){ ?>
			<li class="<?php if($the_page['page_slug'] == $page_slug){ echo 'selected';}?>">
				<a href="<?php echo url_for(h(u($the_page['page_slug']))); ?>">
					<?php echo $the_page['page_name'];?>
				</a>
			</li>
		<?php } ?>
		<li>
			<a href="<?php echo url_for('/login/');?>">
				Login
			</a>
			</li>
	</ul>
</nav>