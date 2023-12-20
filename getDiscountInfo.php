<?php

include("includes/open_con.php");
include('session_check.php');

if ($_POST['coupon_code']) {
    $errors = '';
    if ($_POST['coupon_code'] == '') {
        $errors .= '- Invalid code coupon code. ';
    }

    if ($_POST['estimated_total'] == '') {
        $errors .= '- Invalid code coupon code. ';
    }

    foreach ($_POST as $key => $val) {
        $$key = addslashes($val);
    }

    if ($errors == '') {
        $coupon_price = 0;
        $emsg = "";
        $expiry_date = date('Y-m-d');
        $coupon_code = $_POST['coupon_code'];
        // $sql_coupon = "SELECT * FROM " . DB_TABLE_PREFIX . "coupons WHERE coupon_code = '" . $_REQUEST['coupon_code'] . "' and status = '1' and expiry_date >='$expiry_date' ";
        // $result_coupon = mysqli_query($sql_coupon);
        $row_coupon = $db->GetRow("SELECT * FROM " . DB_TABLE_PREFIX . "coupons WHERE coupon_code = '" . $_REQUEST['coupon_code'] . "' and status = '1' and expiry_date >='$expiry_date' ");

        if (!empty($row_coupon['coupon_id'])) {
            $coupon_type = $row_coupon['coupon_type'];
            if ($coupon_type == 2) {
                $coupon_price = $row_coupon['coupon_price'];
                $estimated_total = $estimated_total - $coupon_price;
                $finalprice = $estimated_total;
            } else {
                $coupon_percent = $row_coupon['coupon_percent'];
                $coupon_price = ($estimated_total / 100) * $coupon_percent;
                $estimated_total = $estimated_total - $coupon_price;
                $finalprice = $estimated_total;
            }

            $datar['coupon_price'] = $coupon_price;
            $datar['price'] = $finalprice;
            echo json_encode($datar);
        } else {
            $datar['error'] = 'You have entered an expired or invalid code';
            echo json_encode($datar);
        }
    } else {
        $datar['error'] = $errors;
        if ($_REQUEST['sendReq'] == 0) {
            echo json_encode($datar);
        }
    }
}
?>