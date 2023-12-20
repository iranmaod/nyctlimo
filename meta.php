<?php


if(isset($seo_url) && $seo_url!=''){
	
	
	/*$rs_cms = $db->GetRow("select * from ".DB_TABLE_PREFIX."web_pages where seo_url='".$seo_url."' ");


	if(!is_array($rs_cms)){

		redirect("index.php");
	}
	
	$heading 	= ucwords(stripslashes($rs_cms['page_heading']));
	$text 		= stripslashes($rs_cms['page_text']);
	$parent_id 	= stripslashes($rs_cms['parent_id']);*/
	
	
}

if(isset($page_id) && $page_id!=''){
	$rs_cms = $db->GetRow("select * from ".DB_TABLE_PREFIX."web_pages where id='".$page_id."' ");

	if(!is_array($rs_cms)){
		redirect("index.php");
	}
	$heading 	= ucwords(stripslashes($rs_cms['page_heading']));
	$landing_page_color = $rs_cms['landing_page_color'];
	$text 		= stripslashes($rs_cms['page_text']);
	$parent_id 	= stripslashes($rs_cms['parent_id']);
}
//	echo "<pre>"; print_r($_GET);
	$view = isset($_REQUEST['view']) ? $_REQUEST['view'] : 'm';
	//die('here');
	if($view != ""){
		$_SESSION['site_view'] = $view;
	}
	if($_SESSION['site_view'] != ""){
		 $site_view = $_SESSION['site_view'];
		//echo "aa";
	}
	//echo "taa" . $site_view . "ok " ;
//	die();
	//$site_view = "m";
	
	//echo "<pre>"; print_r($rs_cms);
?>

<title><?=stripslashes($rs_cms["page_title"])?></title>
<meta name="keywords" content="<?=nl2br(stripslashes($rs_cms["meta_keywords"]))?>">
<meta name="description" content="<?=stripslashes($rs_cms["meta_desc"])?>">
<!--<link rel="shortcut icon" href="favicon.ico">
-->


<link rel="icon" type="image/png" sizes="32x32" href="http://www.topctlimo.com/favicon-32x32.png">
<?php if($site_view == 'm'){?>
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<?php }else{?>

<?php }?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-122201651-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-122201651-1');
</script>

<meta name="google-site-verification" content="4IkvSkY3gnRgYVUF6_lcTSFk_iLIQjM9MbFWdcUagLk" />
<meta name="msvalidate.01" content="3A4C3F198BC62E0D9BED37A1EDCFE4F6" />
<meta name="alexaVerifyID" content="5pjAyQUTj0ESmZBFDl1RD09Yz9g"/>
<meta name="p:domain_verify" content="4bbcca79570eecb305f2935c0c1b2406"/>
<meta name='yandex-verification' content='4a368c921798ec75' />

<?php if($_SERVER['REQUEST_URI']=='/our-vehicles/sedan-suv.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/sedan-suv.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/private-van.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/private-van.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/stretch-limo.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/stretch-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/our-vehicles/transportation.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/transportation.html" />

<?php } if($_SERVER['REQUEST_URI']=='/?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com" />

<?php } if($_SERVER['REQUEST_URI']=='/?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com" />

<?php } if($_SERVER['REQUEST_URI']=='/quickquote.php?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/quickquote.php" />

<?php } if($_SERVER['REQUEST_URI']=='/quickquote.php?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/quickquote.php" />

<?php } if($_SERVER['REQUEST_URI']=='/reservations.php?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/reservations.php" />

<?php } if($_SERVER['REQUEST_URI']=='/index.php?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com" />

<?php } if($_SERVER['REQUEST_URI']=='/index.php?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/mobile.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/mobile.html" />

<?php } if($_SERVER['REQUEST_URI']=='/sedan-suv.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/sedan-suv.html" />

<?php } if($_SERVER['REQUEST_URI']=='sedan-suv.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/sedan-suv.html" />

<?php } if($_SERVER['REQUEST_URI']=='/private-van.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/private-van.html" />

<?php } if($_SERVER['REQUEST_URI']=='/private-van.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/private-van.html" />

<?php } if($_SERVER['REQUEST_URI']=='/stretch-limo.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/stretch-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/stretch-limo.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/stretch-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/transportation.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/transportation.html" />

<?php } if($_SERVER['REQUEST_URI']=='/transportation.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/transportation.html" />

<?php } if($_SERVER['REQUEST_URI']=='/contactus.php?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/contactus.php" />

<?php } if($_SERVER['REQUEST_URI']=='/contactus.php?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/contactus.php" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/sprinter-service.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/sprinter-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/luxury-limo.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/luxury-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/wedding-limo.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/wedding-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/car-service.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/car-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/taxi-service.html') { ?>

<link rel="canonial" href="http://www.topctlimo.com/taxi-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/mobile.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/mobile.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/mobile.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/mobile.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/sprinter-service.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/sprinter-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/sprinter-service.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/sprinter-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/luxury-limo.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/luxury-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/luxury-limo.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/luxury-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/wedding-limo.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/wedding-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/wedding-limo.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/wedding-limo.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/car-service.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/car-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/car-service.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/car-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/taxi-service.html?view=d') { ?>

<link rel="canonial" href="http://www.topctlimo.com/taxi-service.html" />

<?php } if($_SERVER['REQUEST_URI']=='/our-vehicles/taxi-service.html?view=m') { ?>

<link rel="canonial" href="http://www.topctlimo.com/taxi-service.html" />

<?php }?>