<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/connection.php";

if (isset($_POST["submit"])) {
    $email = trim($_POST["txt_email"]);
    $password = trim($_POST["txt_password"]);
    $name = trim($_POST["txt_name"]);
    $level = $_POST["level"]; 

    if (empty($email) || empty($password) || empty($name)) {
        echo "All fields are required!";
        exit();
    }

    $stmt = $koneksi->prepare("INSERT INTO user_detail (user_email, user_password, user_fullname, level) VALUES (?, ?, ?, ?)");

    if (!$stmt) {
        echo "Prepare failed: (" . $koneksi->errno . ") " . $koneksi->error;
        exit();
    }

    $stmt->bind_param("sssi", $email, $password, $name, $level);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$koneksi->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p>Email: <input type="text" name="txt_email" required></p>
        <p>Password: <input type="password" name="txt_password" required></p>
        <p>Name: <input type="text" name="txt_name" required></p>
        <input type="hidden" name="level" value="1">
        <button type="submit" name="submit">Sign Up</button>
    </form>
</body>
</html>