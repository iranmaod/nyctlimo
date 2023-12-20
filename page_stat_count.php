<?php
require_once('phpcount.php');

$time = time();
for($i = 0; $i < 1; $i++)
{
	/*echo "<pre>"; print_r($_SERVER);
	die();*/
	// PHPCount::AddHit($_SERVER["SCRIPT_URL"], $_SERVER['REMOTE_ADDR']);
	PHPCount::AddHit($_SERVER["REQUEST_URI"], $_SERVER['REMOTE_ADDR']);
}