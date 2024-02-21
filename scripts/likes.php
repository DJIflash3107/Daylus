<?php
$likes = array();
$res = mysqli_query($connection, "SELECT * FROM `like` WHERE user_id = $user_id");

if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $likes[] = $row;
    }
} else {
    echo "<script>console.log('Cannot get likes')</script>";
}

if (isset($_POST['like'])) {
    $unixid = time();
    $picture_id = $_POST['like'];
    $res = mysqli_query($connection, "INSERT INTO `like` (`id`, `picture_id`, `user_id`, `created_at`) VALUES ('$unixid', '$picture_id', '$user_id', NOW())");
    if ($res == 1) {
        header("refresh:0;");
    } else {
        echo "<script>console.log('Cannot create like')</script>";
    }
}

if (isset($_POST['dislike'])) {
    $id = $_POST['dislike'];
    $res = mysqli_query($connection, "DELETE FROM `like` WHERE id = '$id'");
    if ($res == 1) {
        header("refresh:0;");
    } else {
        echo "<script>console.log('Cannot delete like')</script>";
    }
}
?>