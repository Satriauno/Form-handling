<?php
require_once __DIR__ . "/connection.php";
$name = isset($_GET["user_fullname"]) ? $_GET["user_fullname"] : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<body>
    <h1>Selamat Datang <?= $name ?></h1>
    <table border="1">
        <tr>
            <td>No</td>
            <td>Email</td>
            <td>Nama</td>
            <td>Nama</td>
        </tr>
        <?php
        $sql = "SELECT * FROM user_detail";
        $result = mysqli_query($koneksi, $sql);
        $no = 1;
        while ($row = mysqli_fetch_array($result)) {
            $userMail = $row["user_email"];
            $userName = $row["user_fullname"];
        ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $userMail ?></td>
                <td><?= $userName ?></td>
                <td>
                    <a href="edit.php?id=<?= $row["id"] ?>">Edit</a>
                    <a href="hapus.php?id=<?= $row["id"] ?>">Hapus</a>
                </td>
            </tr>
        <?php
            $no++;
        } ?>
    </table>
</body>

</html>