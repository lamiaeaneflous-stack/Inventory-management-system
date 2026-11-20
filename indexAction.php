
<?php
include("config.php");
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $myusername = trim($_POST['username']);
    $mypassword = $_POST['password'];

    $sql = "SELECT id, username, password FROM user WHERE username = ? LIMIT 1";
    $stmt = mysqli_prepare($db, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "s", $myusername);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id, $username, $storedPassword);

        if (mysqli_stmt_fetch($stmt)) {
            $passwordValid = password_verify($mypassword, $storedPassword);

            // Support old passwords and upgrade them after successful login
            if (!$passwordValid && $storedPassword === $mypassword) {
                $passwordValid = true;
                $newPassword = password_hash($mypassword, PASSWORD_DEFAULT);

                $update = mysqli_prepare($db, "UPDATE user SET password = ? WHERE id = ?");
                if ($update) {
                    mysqli_stmt_bind_param($update, "si", $newPassword, $id);
                    mysqli_stmt_execute($update);
                    mysqli_stmt_close($update);
                }
            }

            if ($passwordValid) {
                session_regenerate_id(true);
                $_SESSION['login_user'] = $username;
                header("location:dashboard.php");
                exit;
            }
        }

        mysqli_stmt_close($stmt);
    }

    $error = "Your Login Name or Password is invalid";
}
?>
