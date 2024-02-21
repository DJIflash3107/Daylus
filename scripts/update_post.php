<?php
if (isset($_POST['update'])) {
    $picture_id = $_GET['picture'];
    $album = null;
    if ($_POST['album'] != "" && $_POST['album'] != null) {
        $album = $_POST['album'];
    }
    $user_id = $_COOKIE['user_id'];
    $title = $_POST['title'];
    $title = htmlentities($title);
    $descriptionRaw = $_POST['description'];
    $description = htmlentities($descriptionRaw);
    $description = nl2br($description);
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $photo = $_FILES['photo'];
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
                    unlink($previmg);
                    if ($album != null && $album != "") {
                        $result = mysqli_query($connection, "UPDATE picture SET title = '$title', description = '$description', file_location = '$photoDest', album_id = '$album' WHERE id = '$picture_id' AND user_id = '$user_id'");
                        if ($result == 1) {
                            echo "<script>window.location.href = 'profile.php';</script>";
                        } else {
                            echo "<script>window.location.href = 'profile.php';</script>";
                        }
                    } else {
                        $result = mysqli_query($connection, "UPDATE picture SET title = '$title', description = '$description', file_location = '$photoDest', album_id = null WHERE id = '$picture_id' AND user_id = '$user_id'");
                        if ($result == 1) {
                            echo "<script>window.location.href = 'profile.php';</script>";
                        } else {
                            echo "<script>window.location.href = 'profile.php';</script>";
                        }
                    }
                } else {
                    echo "<script>ErrorCustom('image', 'Image cannot be bigger than 40mb!')</script>";
                }
            } else {
                echo "<script>ErrorCustom('image', 'Your image is error!')</script>";
            }
        } else {
            echo "<script>ErrorCustom('image', 'You cannot upload this file!')</script>";
        }
    } else {
        if ($album != null && $album != "") {
            $result = mysqli_query($connection, "UPDATE picture SET title = '$title', description = '$description', album_id = '$album' WHERE id = '$picture_id' AND user_id = '$user_id'");
            if ($result == 1) {
                echo "<script>window.location.href = 'profile.php';</script>";
            } else {
                echo "<script>window.location.href = 'profile.php';</script>";
            }
        } else {
            $result = mysqli_query($connection, "UPDATE picture SET title = '$title', description = '$description', album_id = null WHERE id = '$picture_id' AND user_id = '$user_id'");
            if ($result == 1) {
                echo "<script>window.location.href = 'profile.php';</script>";
            } else {
                echo "<script>window.location.href = 'profile.php';</script>";
            }
        }
    }
}
?>