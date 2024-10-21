<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "user";

$koneksi = mysqli_connect($host, $user, $password, $db);

if (mysqli_connect_errno()) {
    echo "Koneksi gagal : " . mysqli_connect_error();
}
