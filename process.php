<?php
include("./db/db_connection.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $res = mysqli_query($connection, "SELECT id, password FROM user WHERE email = '$email'");
    if ($res) {
        $data = mysqli_fetch_array($res);
        if ($data) {
            $dbpass = $data['password'];
            $id = $data['id'];
            if (password_verify($password, $dbpass)) {
                setcookie('user_id', $data['id'], time() + 86400);
                header("location: index.php");
            } else {
                header("location: login.php?error=true");
            }
        } else {
            header("location: login.php?error=true");
        }
    } else {
        header("location: login.php?error=true");
    }
} else if (isset($_POST['logout'])) {
    setcookie('user_id', '', time() - 86400);
    header("location: landing.php");
} else if (isset($_COOKIE['user_id'])) {
    header("location: index.php");
} else {
    header("location: login.php");
}
?>