<?php include_once("inc/header.php"); ?>

<?php
error_reporting(1);
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors',  true);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = '';

    if ($_POST['name'] == '' || trim($_POST['name']) == '') {
        $errors .= '- Please enter name.<br />';
    }

    // if ($_POST['cname'] == '' || trim($_POST['cname']) == '')
    //     $errors .= '- Please enter company name.<br />';

    // if ($_POST['address1'] == '' || trim($_POST['address1']) == '')
    //     $errors .= '- Please enter address.<br />';

    if ($_POST['phone'] == '' || trim($_POST['phone']) == '') {
        $errors .= '- Please enter phone.<br />';
    }

    $errors .= check_emailadd($_POST['email']);

    if ($_POST['message'] == '' || trim($_POST['message']) == '') {
        $errors .= '- Please enter your message.<br />';
    }

    $comments = stripslashes(nl2br($_REQUEST['message']));

    if ($errors == '') {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $email_data = $db->GetRow("select * from " . DB_TABLE_PREFIX . "email_notifications where id =2");

        $subject = (isset($_POST['subject']) && !empty($_POST['subject'])) ? $_POST['subject'] : rs($email_data['subject']);
        $subject = str_replace("##NAME##", $name, $subject);
        $subject = str_replace("##COMPANY_NAME##", COMPANY_NAME, $subject);

        $body = rs($email_data['email_text']);
        $body = str_replace("##NAME##", $name, $body);
        // $body = str_replace("##CNAME##", $cname, $body);
        // $body = str_replace("##ADDRESS##", $address1, $body);
        $body = str_replace("Address: ##ADDRESS##", "", $body);
        $body = str_replace("##PHONE##", $phone, $body);
        $body = str_replace("##EMAIL##", $email, $body);
        $body = str_replace("##COMMENTS##", $comments, $body);
        $body = str_replace("##COMPANY_NAME##", COMPANY_NAME, $body);

        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: " . $name . " <" . stripslashes($_POST['email']) . ">\r\nReply-To:" . stripslashes($_POST['email']) . "\r\n";

        // @mail(ADMIN_EMAIL, $subject, stripslashes($body), $headers);
        // @mail('shakil518@gmail.com,topctlimo@gmail.com,topctlimo20@gmail.com', $subject, stripslashes($body), $headers);
        // @mail('topctlimo@gmail.com,topctlimo@gmail.com,topctlimo20@gmail.com', $subject, stripslashes($body), $headers);

        $email_dataa = $db->GetRow("select * from " . DB_TABLE_PREFIX . "email_notifications where id =1");
        $subjecta = (isset($_POST['subject']) && !empty($_POST['subject'])) ? $_POST['subject'] : rs($email_dataa['subject']);
        $subjecta = str_replace("##NAME##", $name, $subjecta);
        $subjecta = str_replace("##COMPANY_NAME##", COMPANY_NAME, $subjecta);


        $bodya = rs($email_dataa['email_text']);
        $bodya = str_replace("##NAME##", $name, $bodya);
        $bodya = str_replace("##COMPANY_NAME##", COMPANY_NAME, $bodya);

        $headersa = "MIME-Version: 1.0\r\n";
        $headersa .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headersa .= "From: " . ADMIN_NAME . " <" . ADMIN_EMAIL . ">\r\nReply-To:" . ADMIN_EMAIL . "\r\n";
        
        @mail($_POST['email'], $subjecta, stripslashes($bodya), $headersa);

        // $msg = urlencode("We received your inquiry, we will be in touch shortly.");
        $msg = "We received your inquiry, we will be in touch shortly.";
        // header('Location: '.$filename);
        // redirect(" ".$currentUrl."?msg=$msg");
    }
}
?>

<div class=" header-banner" style="background-image: url(assets/img/slide-2.jpg);">
    <div class="background-overlay3"></div>
    <div class="container">
        <div class="row">
            <div class="header-banner-content">
                <h1>Contact</h1>
            </div>
        </div>
    </div>
</div>

<div class="section about-us about-us-page-div bg-white">
    <div class="container">
        <div class="row">

            <div class=" contact-us col-md-12">
                <?php
                if(isset($msg) && !empty($msg)) {
                    echo '<div class="alert alert-success">'.$msg.'</div>';
                }
                ?>
                <div class="row">
                    <div class="col-md-6  ">
                        <div class="about-us-heading">
                            <h2><?php echo $heading; ?></h2>
                        </div>
                        <?php echo $text; ?>
                        <!-- <div class="contact-info  align-items-center">
                            <div class="contact-info-ctn font-roboto">
                                <i class="bi bi-telephone-fill d-flex align-items-center">
                                    <span class="ms-2">1888.topctlimo</span>
                                </i>
                            </div>
                            <div class="contact-info-ctn mt-3 font-roboto">
                                <i class="bi bi-telephone-fill d-flex align-items-center">
                                    <span class="ms-2">860-796-4893</span>
                                </i>
                            </div>
                            <div class="contact-info-ctn mt-3 mb-3 font-roboto">
                                <i class="bi bi-envelope-fill d-flex align-items-center ">
                                    <span class="ms-2">topctlimo20@gmail.com</span>
                                </i>
                            </div>
                        </div>
                        <img src="assets/img/about-img-1.jpg"> -->
                    </div>
                    <div class="col-md-6 d-flex">
                        <form action="/contact.php" method="post">
                            <div class="mb-3">
                                <input name="name" type="text" class="form-control" placeholder="Your Name">
                            </div>
                            <div class="mb-3">
                                <input name="email" type="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="mb-3">
                                <input name="phone" type="number" class="form-control" placeholder="Your Phone">
                            </div>
                            <div class="mb-3">
                                <input name="subject" type="text" class="form-control" placeholder="Subject">
                            </div>
                            <div class="mb-3">
                                <textarea name="message" class="form-control" placeholder="Message" rows="3"></textarea>
                            </div>
                            <div class="mb-3">
                                <p>This form collects your name, phone, and email so that we can correspond with you.
                                    Check out our <a href="privacy.php">Privacy Policy</a> for more information.</p>
                            </div>
                            <div class="mb-3 form-btn">
                                <input type="submit" class="get-started-btn" value="SUBMIT" />
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include_once("inc/footer.php") ?>