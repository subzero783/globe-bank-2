<?php 
	$page_slug = isset($page_slug) ? $page_slug : '';
	$subject_id = isset($subject_id) ? $subject_id : '';
  $visible = isset($visible) ? $visible : true;
?>
<!-- <nav> -->
  <?php 
  $all_pages = get_all_pages(['visible' => $visible]);
  // echo (!empty($_GET['page_slug']) && isset($_GET['page_slug'])) ? $_GET['page_slug'] : '';
  // echo "<br>";
  // echo (!empty($_GET['posts_id']) && isset($_GET['posts_id'])) ? $_GET['posts_id'] : '';
  ?>
	<!-- <ul class="pages">
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
</nav> -->

<nav class="nav-menu d-none d-lg-block">
	<ul>
		<li class="active"><a href="#header">Home</a></li>
		<li><a href="#about">About</a></li>
		<li><a href="#services">Services</a></li>
		<li><a href="#portfolio">Portfolio</a></li>
		<li><a href="#team">Team</a></li>
		<li><a href="#pricing">Pricing</a></li>
		<li class="drop-down"><a href="">Drop Down</a>
			<ul>
				<li><a href="#">Drop Down 1</a></li>
				<li class="drop-down"><a href="#">Drop Down 2</a>
					<ul>
						<li><a href="#">Deep Drop Down 1</a></li>
						<li><a href="#">Deep Drop Down 2</a></li>
						<li><a href="#">Deep Drop Down 3</a></li>
						<li><a href="#">Deep Drop Down 4</a></li>
						<li><a href="#">Deep Drop Down 5</a></li>
					</ul>
				</li>
				<li><a href="#">Drop Down 3</a></li>
				<li><a href="#">Drop Down 4</a></li>
				<li><a href="#">Drop Down 5</a></li>
			</ul>
		</li>
		<li><a href="#contact">Contact</a></li>

		<li class="get-started"><a href="#about">Get Started</a></li>
	</ul>
</nav><!-- .nav-menu -->

</div>
</header><!-- End Header -->