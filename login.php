<?php


include("includes/open_con.php");


if (get('act') == 'logout') {
    if (session_start()) {
        session_unset();
        session_destroy();
    }

    session_unset();
    session_destroy();

    unset_session('ses_user');
    unset_session('ses_user_id');

    unset($_SESSION['ISMASTER']);
    unset($_SESSION['username']);
    unset($_SESSION['userid']);

    unset($_SESSION["myCart"]);
    unset($_SESSION["ins_sql"]);
    unset($_SESSION["shipping_info"]);
    unset($_SESSION["UPS_Chages"]);
    unset($_SESSION['UPS_type']);
    unset($_SESSION["ses_user_id"]);
    unset($_SESSION["ses_user_email"]);
    unset($_SESSION["ses_user_name"]);
    unset($_SESSION['ses_order_id']);
    unset($_SESSION["discount_amount"]);
    unset($_SESSION["ses_cp"]);
    unset($_SESSION["ses_cp_pt"]);
    //unset_cookie(USER_COOKIE_NAME);
    $msg = urlencode("You Have Successfully Logged Out.");
    redirect("index.php?msg=$msg&cs=ok");
}

header('Location: guest_login.php?guest=1');
die();

if (post('act') == 'login') {

    $login = $_REQUEST['login'];
    $password = $_REQUEST['password'];

    if (post('login') == '')
        $errors .= '- Please enter your e-mail.<br />';
    if (post('password') == '' || post('password') == '**********')
        $errors .= '- Please enter your Password.<br />';
    $password = str_replace("'", "", post('password'));

    if ($errors == '') {

        $row = $db->GetRow("select * from " . DB_TABLE_PREFIX . "members where email_address = " . $db->qstr(post('login')) . " and pass = " . $db->qstr(post('password')) . " and status=1 ");
        if ($row['id'] != '') {
            set_session('ses_user', post('login'));
            set_session('ses_user_id', $row['id']);
            $_SESSION['ISMASTER'] = $row['pass'];
            $_SESSION['username'] = $row['email_address'];
            $_SESSION['userid'] = $row['id'];

            if (post('remember'))
                set_cookie(USER_COOKIE_NAME, post('login') . '~>' . $password, ((60 * 60) * 24) * 7);
            else
                unset_cookie(USER_COOKIE_NAME);

            if (isset($_SESSION['ses_return_url'])) {
                $l_return_url = $_SESSION['ses_return_url'];
                unset($_SESSION['ses_return_url']);
                header("Location:" . $l_return_url . "");
                exit();
            } else {
                redirect('account.php');
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
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="cufon-active cufon-ready">
    <head>
        <title>Login</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.2r1/build/reset-fonts-grids/reset-fonts-grids.css" />
        <link rel="stylesheet" type="text/css" media="all" href="styles/new-styles.css" />
        <link rel="stylesheet" type="text/css" media="all" href="styles/res_menu.css" />
        <link rel="stylesheet" type="text/css" media="all" href="styles/responsive.css" />     

        <script type="text/javascript" src="scripts/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="scripts/plugins.init.js"></script>
        <script type="text/javascript" src="scripts/jquery.cycle.all.min.js"></script>
        <script type="text/javascript" src="scripts/cufon-yui.js"></script>
        <script type="text/javascript" src="scripts/Rockwell_400-Rockwell_700.font.js"></script>
        <script src="scripts/menu.js" type="text/javascript"></script>
        <style>
            .td{padding-top:3px !important;}
        </style>
        <!--[if IE 6]>
        <link rel="stylesheet" type="text/css" media="all" href="styles/ie6.css" />
        <![endif]-->
        <!--[if IE 7]>
        <link rel="stylesheet" type="text/css" media="all" href="styles/ie7.css" />
        <![endif]-->
    </head>
    <body>
        <div id="custom-doc">
            <?php include("includes/topheader.php"); ?>
            <div id="top_wrapper"> 
                <?php include("includes/topmenu.php"); ?>
                <div id="container">
                    <?php include("includes/sidebar.php"); ?>
                    <div id="mainContent"> 
                        <h1>Login</h1>
                        <form id="form1" name="form1" method="post" action="" class="login-form res-sec-wrap">
                            <?php @caution(get("msg"), get("cs"), "h3"); ?><? @print_errors($errors, $cs = 'h3'); ?>

                            <div class="element_wrapper">
                                <label class="label_wrapper"><strong>E-mail Address</strong></label>
                                <div class="input_wrapper">
                                    <input name="login" type="text" class="input"  value="<?= rs($login) ?>" />
                                </div>
                            </div>

                            <div class="element_wrapper">
                                <label class="label_wrapper"><strong>Password</strong></label>
                                <div class="input_wrapper">
                                    <input name="password" type="password" class="input"  value="<?= $password ?>" />
                                </div>
                            </div>

                            <div class="form_action">
                                <div class="login-btn-wrap">
                                    <input name="submit"  type="submit" class="buttons" value="Login" alt="Login" border="0" />
                                    <input name="register" onClick="location.href='signup.php'"  type="button" class="buttons" value="Signup" alt="Signup" border="0" />
                                    <input name="guest" onClick="location.href='guest_login.php?guest=1'"  type="button" class="buttons" value="Guest Reservation"  border="0" />
                                    <input name="act" type="hidden" id="act" value="login" />
                                </div>
                                <div class="forgot-pass"><a href="forgot.password.php" target="_self" class="Linka">Forgot Your Password?</a></div>
                                <div><img src="images/trans.gif" width="1" height="10" alt="" border="0" /></div>
                            </div>

                        </form>



                        <?php
                        if (post('country') != '') {
                            ?>
                            <script language="javascript1.1" type="text/javascript">
                                getstate('<?= post('country') ?>', '<?= post('state') ?>');
                            </script>
                            <?php
                        }
                        ?>

                        <br />






                    </div> 
                </div>




                <div id="content_wrapper_bottom"> </div>

            </div>


            <?php include("includes/footer.php"); ?>


        </div></body></html>