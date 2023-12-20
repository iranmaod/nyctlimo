<?php
include("includes/open_con.php");


// for auto guest login
if (get('guest') == 1) {

    $login = 'guest@guest.com';
    $password = 'guest';

  	$errors = "";

    if ($errors == '') {
//		echo "select * from " . DB_TABLE_PREFIX . "members where email_address = " . $db->qstr($login) . " and pass = " . $db->qstr($password) . " and status=1 ";
		
		//die();
        $row = $db->GetRow("select * from " . DB_TABLE_PREFIX . "members where email_address = " . $db->qstr($login) . " and pass = " . $db->qstr($password) . " and status=1 ");
        if ($row['id'] != '') {
            set_session('ses_user', $login);
            set_session('ses_user_id', $row['id']);
            $_SESSION['ISMASTER'] = $row['pass'];
            $_SESSION['username'] = $row['email_address'];
            $_SESSION['userid'] = $row['id'];

            if (isset($_SESSION['ses_return_url'])) {
                $l_return_url = $_SESSION['ses_return_url'];
                unset($_SESSION['ses_return_url']);
                header("Location:" . $l_return_url . "");
                exit();
            } else {
                redirect('reservations.php');
                exit;
            }
        } else {
            $msg = urlencode(" <strong>Error(s)</strong>:<br> Invalid email or password.");
            redirect("login.php?msg=$msg&cs=er&login=$login");
        }
    } else {

        $msg = urlencode(" <strong>Error(s)</strong>:<br> Invalid email or password.");
        redirect("login.php?msg=$msg&cs=er&login=$login");
    }
}
$chek = "";
if (get_cookie(USER_COOKIE_NAME)) {
    $admin_cookie = explode('~>', get_cookie(USER_COOKIE_NAME));
    $login = str_replace("'", "", $db->qstr($admin_cookie[0]));
    $password = str_replace("'", "", $db->qstr($admin_cookie[1]));
    $chek = "checked";
    $row = $db->GetRow("select * from " . DB_TABLE_PREFIX . "members where email_address = " . $db->qstr($admin_cookie[0]) . " and pass = " . $db->qstr($admin_cookie[1]) . "");
    if (sizeof($row) != 0) {
        set_session('ses_user', $row['email']);
        set_cookie(USER_COOKIE_NAME, $row['email_address'] . '~>' . $row['pass'], ((60 * 60) * 24) * 7);
        //redirect('home.php');
    }
}
?>