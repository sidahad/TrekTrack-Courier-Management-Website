<?php
$host = "sql204.infinityfree.com";
$user = "if0_42094444";
$pw   = 'DUgkTp8nU1d';
$db   = "if0_42094444_trek_track";

$conn = mysqli_connect($host, $user, $pw, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
