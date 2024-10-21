<?php
require_once __DIR__ . "/connection.php";

if (isset($_POST["submit"])) {
    $userId = $_POST["txt_id"];
    $userMail = $_POST["txt_email"];
    $userPass = $_POST["txt_password"];
    $userName = $_POST["txt_name"];

    if (!empty($userPass)) {
        $query = "UPDATE user_detail SET user_password = ?, user_fullname = ? WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssi", $userPass, $userName, $userId);
    } else {
        $query = "UPDATE user_detail SET user_fullname = ? WHERE id = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("si", $userName, $userId);
    }

    if ($stmt->execute()) {
        header("Location: home.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$id = $_GET["id"];
$query = "SELECT * FROM user_detail WHERE id = ?";
$stmtSelect = $koneksi->prepare($query);
$stmtSelect->bind_param("i", $id);
$stmtSelect->execute();
$result = $stmtSelect->get_result();

if ($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $userMail = $row["user_email"];
    $userPass = $row["user_password"];
    $userName = $row["user_fullname"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
    <form action="edit.php" method="post">
        <p><input type="hidden" name="txt_id" value="<?= htmlspecialchars($id); ?>"></p>
        <p>Email: <input type="text" name="txt_email" value="<?= htmlspecialchars($userMail); ?>" readonly></p>
        <p>Password: <input type="password" name="txt_password" placeholder="Leave blank if you don't want to change"></p>
        <p>Name: <input type="text" name="txt_name" value="<?= htmlspecialchars($userName); ?>"></p>
        <button type="submit" name="submit">Update</button>
    </form>
    <p><a href="home.php">Kembali</a></p>
</body>
</html>
<?php 
} else {
    echo "User not found.";
}

$stmtSelect->close();
$koneksi->close();
?>