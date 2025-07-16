<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "zikra_shop";

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
