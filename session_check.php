<?php
#error_reporting(15);
if(get_session('ses_user_id')==''){

	$msg = urlencode('please login to continue.');
//	session_register('ses_return_url');
	$_SESSION['ses_return_url'] = $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'] ;
	redirect("login.php?msg=$msg&cs=er");	
}

if(isset($_SESSION['ses_return_url'])) unset($_SESSION['ses_return_url']);

?>