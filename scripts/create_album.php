<?php
if (isset($_POST['create_album'])) {
    $album_name = $_POST['album_name'];
    $album_name = htmlentities($album_name);
    $album_description_raw = $_POST['album_description'];
    $album_description = htmlentities($album_description_raw);
    $album_description = nl2br($album_description);
    $unixid = time();
    $res = mysqli_query($connection, "INSERT INTO album (id, name, description, created_at, user_id) VALUES ('$unixid', '$album_name', '$album_description', NOW(), '$user_id')");
    if ($res == 1) {
        echo "<script>window.location.href = 'post.php?page=album&success_album=true';</script>";
    } else {
        echo "<script>window.location.href = 'post.php?page=album&success_album=false';</script>";
    }
}
if (isset($_GET['success_album'])) {
    if ($_GET['success_album'] == true) {
        echo "<script>Notification('Album successfully created!', 'custom')</script>";
    } else {
        echo "<script>Notification('Failed creating album', 'red')</script>";
    }
}
?>