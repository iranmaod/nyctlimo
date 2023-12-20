<?php
include("includes/open_con.php");
// For CurrentDate
$reservations = $db->getAll("SELECT * FROM `doc_reservations` WHERE transactionid != '' AND ( CONCAT(`departure_date`,' ',STR_TO_DATE(`actual_pick_up_time`,  '%l:%i %p' )) BETWEEN NOW()-INTERVAL 2 hour AND NOW()-INTERVAL 90 MINUTE ) ORDER BY `id` DESC");
echo "<pre>";
print_r($reservations);
// $reservations = $db->getAll("select * from ".DB_TABLE_PREFIX."reservations where departure_date = '2023-12-03' AND transactionid != ''");
// echo "select * from ".DB_TABLE_PREFIX."reservations where departure_date = '2023-12-03' AND transactionid != ''".'<br /><pre>';
if ( count( $reservations ) > 0 ) {
    foreach( $reservations as $res ) {
        if (strpos($res["transactionid"], "txn_") !== false) {
            $ddate = explode("-", $res["departure_date"]);
            $date = $ddate[1] . '-' . $ddate[2] . '-' . $ddate[0] . ' ' . $res["actual_pick_up_time"];
            $html1 = '<p>Dear ' . $res["name"] . ' ' . $res["lastname"] . ', <br><br>Your reservation time is ' . $date . '. It will be in next 3 hours.<br><br>Thanks</p>';

            SendMail('muneeb@nexvistech.com', 'info@topctlimo.com', 'info@topctlimo.com', 'admin', 'NYCTLimo Reservation Reminder Email', $html1);
            SendMail('nyctlimousine@gmail.com', 'info@topctlimo.com', 'info@topctlimo.com', 'admin', 'NYCTLimo Reservation Reminder Email', $html1);
        }
    }
}

exit;