<?php
   include('config.php');
   session_start();

   $user_check = $_SESSION['login_user'];

   $stmt = mysqli_prepare($db, "SELECT * FROM user WHERE username = ?");
   mysqli_stmt_bind_param($stmt, "s", $user_check);
   mysqli_stmt_execute($stmt);
   $ses_sql = mysqli_stmt_get_result($stmt);

   $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

   $login_session = $row['username'];

   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }

   mysqli_stmt_close($stmt);
?>
