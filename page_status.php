<?php
require_once('page_stat_count.php');


if($seo_url!=''){
	
	//echo "select * from ".DB_TABLE_PREFIX."web_pages where seo_url='".$seo_url."' ";
	
	$rs_cms = $db->GetRow("select * from ".DB_TABLE_PREFIX."web_pages where seo_url='".$seo_url."' ");


	if(!is_array($rs_cms)){

		redirect("index.php");
	}
	
	$heading 	= ucwords(stripslashes($rs_cms['page_heading']));
	$landing_page_color = $rs_cms['landing_page_color'];
	$text 		= stripslashes($rs_cms['page_text']);
	$parent_id 	= stripslashes($rs_cms['parent_id']);
	
	 $is_landing 	= stripslashes($rs_cms['is_landing']);
	
	if($is_landing == 1){
		include_once("landing_pages/index.php");
		die();
	}
}