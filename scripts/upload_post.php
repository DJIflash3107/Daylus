<?php
if (isset($_POST['upload'])) {
    $album = null;
    if ($_POST['album'] != "" && $_POST['album'] != null) {
        $album = $_POST['album'];
    }
    $unixid = time();
    $user_id = $_COOKIE['user_id'];
    $photo = $_FILES['photo'];
    $title = $_POST['title'];
    $title = htmlentities($title);
    $descriptionRaw = $_POST['description'];
    $description = htmlentities($descriptionRaw);
    $description = nl2br($description);
    $photoName = $photo['name'];
    $photoError = $photo['error'];
    $photoSize = $photo['size'];
    $photoTmp = $photo['tmp_name'];
    $photoExt = explode('.', $photoName);
    $photoRealExt = strtolower(end($photoExt));
    $allowed = array('jpg', 'jpeg', 'png');
    $maxFileSize = 40 * 1024 * 1024;
    if (in_array($photoRealExt, $allowed)) {
        if ($photoError === 0) {
            if ($photoSize < $maxFileSize) {
                $photoNameNew = uniqid('', true) . "." . $photoRealExt;
                $photoDest = 'assets/images/' . $photoNameNew;
                move_uploaded_file($photoTmp, $photoDest);
                if ($album != null && $album != "") {
                    $result = mysqli_query($connection, "INSERT INTO picture (`id`, `title`, `description`, `created_at`, `file_location`, `album_id`, `user_id`) VALUES ('$unixid', '$title', '$description', NOW(), '$photoDest', '$album', '$user_id')");
                    if ($result == 1) {
                        echo "<script>window.location.href = 'post.php?success=true';</script>";
                    } else {
                        echo "<script>window.location.href = 'post.php?success=false';</script>";
                    }
                } else {
                    $result = mysqli_query($connection, "INSERT INTO picture (`id`, `title`, `description`, `created_at`, `file_location`, `user_id`) VALUES ('$unixid', '$title', '$description', NOW(), '$photoDest', '$user_id')");
                    if ($result == 1) {
                        echo "<script>window.location.href = 'post.php?success=true';</script>";
                    } else {
                        echo "<script>window.location.href = 'post.php?success=false';</script>";
                    }
                }
            } else {
                echo "<script>ErrorCustom('image', 'Image cannot be bigger than 40mb!')</script>";
            }
        } else {
            echo "<script>ErrorCustom('image', 'Your image is error!')</script>";
        }
    } else {
        echo "<script>ErrorCustom('image', 'You cannot upload file with type other than jpg, jpeg, or png!')</script>";
    }
}
if (isset($_GET['success'])) {
    if ($_GET['success'] == true) {
        echo "<script>Notification('Picture successfully uploaded!', 'custom')</script>";
    } else {
        echo "<script>Notification('Failed uploaded picture', 'red')</script>";
    }
}
?>