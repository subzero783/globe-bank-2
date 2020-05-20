<?php require_once('private/initialize.php'); ?>	
<?php 
 
$preview = false;

if(isset($_GET['preview'])){
	$preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}

$visible = !$preview;

//Each row from the subjects db table 
if(isset($_GET['id'])){  

	$page_id = $_GET['id'];
	$page = get_page_by_id($page_id, ['visible' => $visible]);

	if(!$page){
		redirect_to(url_for('/index.php'));
	}

	$subject_id = $page['subject_id'];
	$subject = get_subject_by_id($subject_id, ['visible' => $visible]);

	if(!$subject){
		redirect_to(url_for('/index.php'));
	}

}else if(isset($_GET['subject_id'])){    

	$subject_id = $_GET['subject_id'];
	$subject = get_subject_by_id($subject_id, ['visible' => $visible]);

	if(!$subject){
		redirect_to(url_for('/index.php'));
	}

	$page = get_first_page_by_subject_id_visible_true($subject_id);

	if(!$page) {
		redirect_to(url_for('/index.php'));
	}

	$page_id = $page['id'];
	
}else{
	// nothing selected; show homepage 
}
?>
<?php include(SHARED_PATH . '/public_header.php'); ?>	
<div id="main">		
	<?php include(SHARED_PATH . '/public_navigation.php');?>
  <div id="page">	
	<?php 
			if(isset($page)){
				$allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
				echo strip_tags($page['content'], $allowed_tags);
			}else{
				//Show the home page
				//the home page content could:
				//* be static content (here or in a shared file)
				//* show the first page from the nav
				//* be in the database but add code to hide in the nav
			 include(SHARED_PATH . '/static_homepage.php');
			} 
	?>
  </div>	
</div>	
<?php include(SHARED_PATH . '/public_footer.php'); ?>