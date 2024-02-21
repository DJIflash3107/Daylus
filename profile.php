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
    <title>Profile</title>
</head>

<body>
    <div id="content-container" class="content-container">
        <?php
        if (!isset($_COOKIE['user_id'])) {
            header("location: landing.php");
        } else {
            $user_id = $_COOKIE['user_id'];
        }
        include("./components/sidebar.php");
        include("./components/navbar.php");
        include("./db/db_connection.php");
        include("./scripts/likes.php");
        include("./scripts/cut_string.php");
        ?>
        <div class="content">
            <div class="flex flex-col relative break-words">
                <?php
                $data;
                $res = mysqli_query($connection, "SELECT * FROM user WHERE id = '$user_id'");
                if ($res) {
                    $data = mysqli_fetch_array($res);
                } else {
                    echo "<script>console.log('Cannot get user')</script>";
                }
                $photoscres = mysqli_query($connection, "SELECT COUNT(*) AS total_picture FROM picture WHERE user_id = '$user_id'");
                $photocdata = mysqli_fetch_array($photoscres);
                $albumscres = mysqli_query($connection, "SELECT COUNT(*) AS total_album FROM album WHERE user_id = '$user_id'");
                $albumcdata = mysqli_fetch_array($albumscres);
                $likescres = mysqli_query($connection, "SELECT COUNT(*) AS total_like FROM `like` WHERE user_id = '$user_id'");
                $likecdata = mysqli_fetch_array($likescres);
                ?>
                <p class="text-xs font-bold text-gray-500">
                    <?php
                    $fullname = $data['fullname'];
                    if (strlen($fullname) > 30) {
                        $fullname = substr($fullname, 0, 30) . "...";
                    }
                    echo $fullname; ?>
                </p>
                <p class="text-lg font-bold mb-1">
                    <?php echo "@" . $data['username']; ?>
                </p>
                <p class="text-sm font-light text-gray-600 flex mb-1 max-w-full break-words"><img
                        src="./assets/icons/location.svg" class="locatop">
                    <?php $address = $data['address'];
                    if (strlen($address) > 30) {
                        $address = substr($address, 0, 30) . "...";
                    }
                    echo $address; ?>
                </p>
                <p class="text-sm font-normal text-gray-600">
                    <?php
                    $totalphoto = $photocdata['total_picture'];
                    if ($totalphoto > 1) {
                        $totalphoto = $totalphoto . " Photos";
                    } else {
                        $totalphoto = $totalphoto . " Photo";
                    }
                    $totalalbum = $albumcdata['total_album'];
                    if ($totalalbum > 1) {
                        $totalalbum = $totalalbum . " Albums";
                    } else {
                        $totalalbum = $totalalbum . " Album";
                    }
                    $totallike = $likecdata['total_like'];
                    if ($totallike > 1) {
                        $totallike = $totallike . " Favorites";
                    } else {
                        $totallike = $totallike . " Favorite";
                    }
                    echo $totalphoto . " &bull; " . $totalalbum . " &bull; " . $totallike ?>
                </p>
                <div class="flex mt-4">
                    <form>
                        <button name="page" value="photos" class="btn-prof <?php
                        if (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == "photos")) {
                            echo "prof-active";
                        }
                        ?>">Photos</button>
                    </form>
                    <form>
                        <button name="page" value="albums" class="btn-prof <?php
                        if (isset($_GET['page']) && $_GET['page'] == "albums") {
                            echo "prof-active";
                        }
                        ?>">Albums</button>
                    </form>
                    <button class="btn-add"><img id="showdrop" onclick="ShowDrop()"
                            src="./assets/icons/plus.svg"></button>
                </div>
                <div id="drop" class="cust-drop hidden">
                    <button onclick="Redirect('post.php?page=picture')">Create New Post</button>
                    <button onclick="Redirect('post.php?page=album')">Create New Album</button>
                    <button onclick="Redirect('edit.php?page=profile')">Edit Profile</button>
                    <form method="post" action="process.php"><button name="logout" class="w-full">LogOut</button></form>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <?php
                if (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == "photos")) {
                    $res = mysqli_query($connection, "SELECT picture.*, user.username FROM picture JOIN user ON picture.user_id = user.id WHERE picture.user_id = '$user_id' ORDER BY created_at DESC");
                    while ($data = mysqli_fetch_array($res)) {
                        include("./scripts/time_ago.php");
                        include("./components/picture_posts.php");
                    }
                    include("./components/comment.php");

                } else if (isset($_GET['page']) && $_GET['page'] == "albums") {
                    $res = mysqli_query($connection, "SELECT album.*, user.username, picture.file_location 
            FROM album 
            JOIN user ON album.user_id = user.id
            LEFT JOIN (
                SELECT album_id, file_location 
                FROM picture 
                WHERE (album_id, created_at) IN (
                    SELECT album_id, MAX(created_at) 
                    FROM picture 
                    GROUP BY album_id
                )
            ) AS picture ON album.id = picture.album_id
            WHERE album.user_id = '$user_id' 
            ORDER BY album.created_at DESC;");
                    while ($data = mysqli_fetch_array($res)) {
                        include("./scripts/time_ago.php");
                        include("./components/album_posts.php");
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div onclick="ClickOutsideAlert(event)" id="alert" class="alert hidden">
        <div id="alert-form" class="m-auto bg-wolp rounded-md">
            <p id="alert-title" class="text-center text-base font-bold bg-wolp p-4 rounded-t-md">Are you sure to delete
                this post?</p>
            <div class="flex gap-ol">
                <button onclick="HideAlert()" class="flex-1 font-semibold btn-no">No</button>
                <form method="post" class="flex-1 btn-yes">
                    <input id="image-alert" type="text" name="image_alert" value="" class="hidden" hidden>
                    <button id="yes-alert" type="submit" value="" name="delete_picture"
                        class="w-full font-semibold">Yes</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function Redirect(string) {
            window.location.href = string;
        }
        function ShowDrop() {
            const drop = document.getElementById("drop");
            const contentContainer = document.getElementById("content-container");
            drop.classList.remove("hidden");
            drop.classList.add("flex");
            setTimeout(() => {
                drop.classList.add("show-drop");
            }, 50);
            contentContainer.setAttribute("onclick", "HideDrop(event)");
        }
        function HideDrop(e) {
            const drop = document.getElementById("drop");
            const contentContainer = document.getElementById("content-container");
            const showdrop = document.getElementById("showdrop");
            if (!drop.contains(e.target) && e.target !== showdrop) {
                drop.classList.remove("show-drop");
                setTimeout(() => {
                    drop.classList.remove("flex");
                    drop.classList.add("hidden");
                }, 50);
                contentContainer.removeAttribute("onclick");
            }
        }
        function ShowAlert(id, imageSrc) {
            const alert = document.getElementById("alert");
            const yes = document.getElementById("yes-alert");
            const imageAlert = document.getElementById("image-alert");
            alert.classList.remove("hidden");
            alert.classList.add("flex");
            yes.setAttribute("value", id);
            imageAlert.setAttribute("value", imageSrc);
            document.body.style.overflow = "hidden";
        }
        function ShowAlbumAlert(id) {
            const alert = document.getElementById("alert");
            const yes = document.getElementById("yes-alert");
            const alertTitle = document.getElementById("alert-title");
            alert.classList.remove("hidden");
            alert.classList.add("flex");
            yes.setAttribute("value", id);
            yes.setAttribute("name", "delete_album");
            alertTitle.innerHTML = "Are you sure to delete this album?";
            document.body.style.overflow = "hidden";
        }
        function ClickOutsideAlert(e) {
            const alertForm = document.getElementById("alert-form");
            if (!alertForm.contains(e.target)) {
                HideAlert();
            }
        }
        function HideAlert() {
            const alert = document.getElementById("alert");
            alert.classList.add("hidden");
            document.body.style.overflow = "auto";
        }
        function ShowOptn(id) {
            const optn = document.getElementById("optn-" + id);
            const contentContainer = document.getElementById("content-container");
            optn.classList.remove("hidden");
            optn.classList.add("flex");
            setTimeout(() => {
                optn.classList.add("show-option");
            }, 10)
            contentContainer.setAttribute("onclick", "HideOptn(event, " + id + ")");
        }
        function HideOptn(e, id) {
            const optn = document.getElementById("optn-" + id);
            const btn = document.getElementById("btn-optn-" + id);
            const contentContainer = document.getElementById("content-container");
            if (!optn.contains(e.target) && e.target !== btn) {
                optn.classList.remove("show-option");
                setTimeout(() => {
                    optn.classList.remove("flex");
                    optn.classList.add("hidden");
                }, 100)
                contentContainer.removeAttribute("onclick");
            }
        }
    </script>
    <?php
    if (isset($_POST['delete_picture'])) {
        $picture_id = $_POST['delete_picture'];
        $image = $_POST['image_alert'];
        unlink($image);
        $res = mysqli_query($connection, "DELETE FROM picture WHERE id = '$picture_id' AND user_id = '$user_id'");
        if ($res == 1) {
            $path = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href = '$path';</script>";
        }
    }
    if (isset($_POST['delete_album'])) {
        $album_id = $_POST['delete_album'];
        $res = mysqli_query($connection, "SELECT file_location FROM picture WHERE album_id = '$album_id'");
        while ($row = mysqli_fetch_array($res)) {
            $image = $row['file_location'];
            unlink($image);
        }
        $res = mysqli_query($connection, "DELETE FROM album WHERE id = '$album_id' AND user_id = '$user_id'");
        if ($res == 1) {
            $path = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href = '$path';</script>";
        }
    }

    ?>
</body>

</html>