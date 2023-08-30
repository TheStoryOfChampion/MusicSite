<?php

define('DB_SERVER', 'wheatley.cs.up.ac.za');
define('DB_USERNAME', 'u18045881');
define('DB_PASSWORD', 'BV68YBgp');
define('DB_NAME', 'u18045881_PA03');

$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($link === false)
{
    die("ERROR: Couldn't connect... " . mysqli_connect_error());
}

?>