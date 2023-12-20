<?php

include("includes/open_con.php");
include('session_check.php');

// error_reporting(-1);
// ini_set('error_reporting', E_ALL ^ E_NOTICE);
// ini_set('display_errors',  true);

if (!empty($_POST['price'])) {
    $lastId = (int) $_SESSION['lastId'];
    if ($_SESSION['res_type'] == 'hourly') {
        $table = "hourly_reservations";
        $data = $db->GetRow("select * from " . DB_TABLE_PREFIX . "$table where id ='" . $lastId . "' order by id desc");
    } else {
        $table = "reservations";
        $data = $db->GetRow("select * from " . DB_TABLE_PREFIX . "$table where id ='" . $lastId . "' order by id desc");
    }

    $input = $_POST['price'];
    $dollars = str_replace('$', '', $input);
    $cents = $dollars*100;

    require_once('stripe-php/init.php');

    // \Stripe\Stripe::setApiKey("sk_test_51LZlB8E23L1fPfB4v4oV708HolP8QEdhRhLbzzTAH5WlAeYJwNROQSk218mpX5BwwwiBD8VgJhI4btMQzMPlFWRm007ibJQFal");
    // \Stripe\Stripe::setApiKey("sk_test_j4fd3smlaBG6UcIFVqtZHOEN");
    // $stripe = new \Stripe\StripeClient('sk_test_51LZlB8E23L1fPfB4v4oV708HolP8QEdhRhLbzzTAH5WlAeYJwNROQSk218mpX5BwwwiBD8VgJhI4btMQzMPlFWRm007ibJQFal');
    $stripe = new \Stripe\StripeClient('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');

    $customer = $stripe->customers->create([
        'payment_method' => $_POST['paymentMethod'],
        'email' => $_POST['stripeEmail'],
        'name' => $data['name'] . ' ' . $data['lastname']
    ]);

    // $token = $_POST['stripeToken'];
    // $charge = \Stripe\Charge::create([
    //     "amount" => $cents,
    //     "currency" => "usd",
    //     "receipt_email" => $_POST['stripeEmail'],
    //     "source" => $token, // obtained with Stripe.js
    //     "description" => isset($_POST['desc']) ? $_POST['desc'] : '',
    //     'capture' => 'false',
    // ]);

    // if (!$charge->failure_code) {
    if ($customer) {
        // $chargeJson = $charge->jsonSerialize();

        // $balance_transaction = $chargeJson['id'];
        $balance_transaction = $_POST['paymentMethod'];

        $lastId = (int) $_SESSION['lastId'];
        if ($_SESSION['res_type'] == 'hourly') {
            // echo "update " . DB_TABLE_PREFIX . "hourly_reservations set status = '1', transactionid = '" . $balance_transaction . "', stripe_customer_id = '".$customer->id."' where id = '" . $lastId . "'";
            $db->Execute("update " . DB_TABLE_PREFIX . "hourly_reservations set status = '1', transactionid = '" . $balance_transaction . "', stripe_customer_id = '".$customer->id."' where id = '" . $lastId . "'");
            $table = "hourly_reservations";
            $data = $db->GetRow("select * from " . DB_TABLE_PREFIX . "$table where id ='" . $lastId . "' order by id desc");
// print_r($data);
            $serial_no = $data['serial_no'];
        } else {
            // echo "update " . DB_TABLE_PREFIX . "reservations set status = '1', transactionid = '" . $balance_transaction . "', stripe_customer_id = '".$customer->id."' where id = '" . $lastId . "'";
            $db->Execute("update " . DB_TABLE_PREFIX . "reservations set status = '1', transactionid = '" . $balance_transaction . "', stripe_customer_id = '".$customer->id."' where id = '" . $lastId . "'");
            $table = "reservations";
            $data = $db->GetRow("select * from " . DB_TABLE_PREFIX . "$table where id ='" . $lastId . "' order by id desc");
// print_r($data);
            $serial_no = $data['serial_no'];
        }

        unset($_SESSION['lastId']);
        unset($_SESSION['res_type']);
// exit;
        $html1 = '';
        // $html1 = '<p>Thanks for requesting a reservation. Your payment has been successfully processed.</p>';
        // $html1 .= '<p><strong><i>Transaction ID:</i> ' . $balance_transaction . '</strong></p>';
        // $html1 .= '<p><strong><i>Reservation:</i> ' . $serial_no . '</strong></p>';

        $html = str_replace("< ", "<", $_SESSION['emailhtml']);
        $html = str_replace(" >", ">", $html);

        // SendMail($to, $from, $reply, $fromname, $subject, $message);
        SendMail('muneebtariq1991@gmail.com', 'topctlimo20@gmail.com', $_SESSION['reservation']['email'], 'admin', 'NYCTLimo Reservation Admin Email', $html1 . $html);
        SendMail('nyctlimousine@gmail.com', 'topctlimo20@gmail.com', $_SESSION['reservation']['email'], 'admin', 'NYCTLimo Reservation Admin Email', $html1 . $html);
        // SendMail($_SESSION['reservation']['email'], 'info@topctlimo.com', $_SESSION['reservation']['email'], 'admin', 'New Reservation - NYCTLIMO', $html1 . $html);
        unset($_SESSION['emailhtml']);

        $card_no = "Payment will be made via Stripe";

        $logo_img = '<img id="main_logo" src="http://www.topctlimo.com/images/logo.png" border="0">';
        header("location:reservations_thanks.php");
        exit;
    } else {
        echo '<pre>';
        print_r($charge->failure_code);
        exit;
    }
}