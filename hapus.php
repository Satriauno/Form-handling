<?php

require_once __DIR__ . "/connection.php";
$id = $_GET["id"];
mysqli_query($koneksi, "DELETE FROM user_detail WHERE id = $id");

header("Location: home.php");
exit();
