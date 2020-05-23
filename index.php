<?php require_once('private/initialize.php'); ?>	
<?php 
 
$preview = false;

if(isset($_GET['preview'])){
	$preview = $_GET['preview'] == 'true' && is_logged_in() ? true : false;
}

$visible = !$preview;

//Each row from the subjects db table 
if( isset($_GET['page_slug']) ){  

  $page_slug = $_GET['page_slug'];

  $page = get_page_by_slug($page_slug, ['visible' => $visible]);
  

}else{
  // nothing selected; show homepage 
}
?>
<?php include(SHARED_PATH . '/public_header.php'); ?>	
<div id="main">		
	<?php include(SHARED_PATH . '/public_navigation.php');?>
  <div id="page">	
  <?php 
    if( isset($page) ){
      // $allowed_tags = '<div><img><h1><h2><p><br><strong><em><ul><li>';
      echo $page['title'];
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