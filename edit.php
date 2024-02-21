<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./tailwindcss/output.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="/assets/icons/logo-daylus.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <title>Edit</title>
</head>

<body>
    <div class="content-container">
        <?php
        if (!isset($_COOKIE['user_id'])) {
            header("location: landing.php");
        } else {
            $user_id = $_COOKIE['user_id'];
        }
        if (!isset($_GET['album']) && !isset($_GET['picture']) && !isset($_GET['page'])) {
            header("location: index.php");
        } else if (isset($_GET['album'])) {
            $album_id = $_GET['album'];
        } else if (isset($_GET['picture'])) {
            $picture_id = $_GET['picture'];
        }
        include("./components/sidebar.php");
        include("./components/navbar.php");
        include("./db/db_connection.php");
        include("./scripts/cut_string.php");
        ?>
        <div class="content">
            <?php
            if (isset($_GET['album'])) {
                $res = mysqli_query($connection, "SELECT * FROM album WHERE id = '$album_id' AND user_id = '$user_id'");
                $data = mysqli_fetch_array($res);
                include("./components/album_form_edit.php");
            }
            if (isset($_GET['picture'])) {
                $res = mysqli_query($connection, "SELECT * FROM picture WHERE id = '$picture_id' AND user_id = '$user_id'");
                $data = mysqli_fetch_array($res);
                include("./components/picture_form_edit.php");
            }
            if (isset($_GET['page']) && $_GET['page'] == "profile") {
                $res = mysqli_query($connection, "SELECT username, fullname, address FROM user WHERE id = '$user_id'");
                $data = mysqli_fetch_array($res);
                ?>
                <div class="border-cust p-4 rounded-md shadow flex flex-col gap-4">
                    <p class="text-base font-semibold">Edit Your Profile</p>
                    <form onsubmit="ValidateProfile(event)" class="flex flex-col gap-4" method="post">
                        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
                            <label class="text-xs font-normal text-gray-600 colop" for="fullname">Fullname</label>
                            <input onblur="Validate('fullname')" name="fullname" id="fullname" class="input-polop"
                                type="text" placeholder="Enter your fullname" value="<?= $data['fullname'] ?>">
                            <span id="errorFullname" class="text-xs text-red-600 font-normal hidden"></span>
                        </div>
                        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
                            <label class="text-xs font-normal text-gray-600 colop" for="username">Username</label>
                            <input onblur="Validate('username')" name="username" id="username" class="input-polop"
                                type="text" placeholder="Enter your username" value="<?= $data['username'] ?>">
                            <span id="errorUsername" class="text-xs text-red-600 font-normal hidden"></span>
                        </div>
                        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
                            <label class="text-xs font-normal text-gray-600 colop" for="address">Address</label>
                            <textarea onblur="Validate('address')" name="address" id="address" class="input-polop jitikop"
                                placeholder="Enter your address"><?= $data['address'] ?></textarea>
                            <span id="errorAddress" class="text-xs text-red-600 font-normal hidden"></span>
                        </div>
                        <button type="submit" name="update_profile" class="btn-post">Update Profile</button>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
    include("./scripts/validate.php");
    include("./scripts/update_post.php");
    include("./scripts/update_album.php");
    if (isset($_POST['update_profile'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $address = htmlentities($address);
        $res = mysqli_query($connection, "UPDATE user SET username = '$username', fullname = '$fullname', address = '$address' WHERE id = '$user_id'");
        if ($res == 1) {
            echo "<script>window.location.href = 'profile.php'</script>";
        }
    }
    ?>
</body>

</html>