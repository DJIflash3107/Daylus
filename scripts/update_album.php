<?php
if (isset($_POST['update_album'])) {
    $album_id = $_GET['album'];
    $album_name = $_POST['album_name'];
    $album_name = htmlentities($album_name);
    $album_description_raw = $_POST['album_description'];
    $album_description = htmlentities($album_description_raw);
    $album_description = nl2br($album_description);
    $res = mysqli_query($connection, "UPDATE album SET name = '$album_name', description = '$album_description' WHERE id = '$album_id' AND user_id = '$user_id'");
    if ($res == 1) {
        echo "<script>window.location.href = 'profile.php?page=albums';</script>";
    } else {
        echo "<script>window.location.href = 'profile.php?page=albums';</script>";
    }
}
?>