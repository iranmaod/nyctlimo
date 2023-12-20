<?php
error_reporting(0);
ini_set('error_reporting', E_ALL ^ E_NOTICE);
ini_set('display_errors',  true);

// Create a curl handle to a non-existing location
$ch = curl_init('https://api.stripe.com/v1/charges');

// Execute
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_exec($ch);

// Check if any error occurred
if(curl_errno($ch))
{
    echo 'Curl error: ' . curl_error($ch);
}

// Close handle
curl_close($ch);
?>