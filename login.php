<?php

require_once __DIR__ . "/connection.php";

session_start();

if (isset($_POST["submit"])) {
    $email = $_POST["txt_email"];
    $password = $_POST["txt_password"];

    if (!empty(trim($email)) && !empty(trim($password))) {
        $sql = "SELECT * FROM user_detail WHERE user_email = '$email'";
        $result = mysqli_query($koneksi, $sql);
        $num = mysqli_num_rows($result);

        if ($row = mysqli_fetch_array($result)) {
            $id = $row["id"];
            $user_email = $row["user_email"];
            $user_fullname = $row["user_fullname"];
            $user_password = $row["user_password"];
            $level = $row["level"];
        }

        if ($num != 0) {
            if ($password == $user_password) {
                header("Location: /home.php");
            } else {
                $error = "User atau password salah";
                header("Location: /login.php");
                echo $error;
            }
        } else {
            $error = "User tidak ditemukan";
            header("Location: /login.php");
            echo $error;
        }
    } else {
        $error = "Data tidak boleh kosong";
        echo $error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Email &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="txt_email"></p>
        <p>Password &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="password" name="txt_password"></p>
        <button type="submit" name="submit">Sign In</button>
    </form>
</body>

</html>