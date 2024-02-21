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
    <title>Album Pictures</title>
</head>

<body>
    <div class="content-container">
        <?php
        if (!isset($_COOKIE['user_id'])) {
            header("location: landing.php");
        } else {
            $user_id = $_COOKIE['user_id'];
        }
        if (!isset($_GET['album'])) {
            header("location: index.php");
        } else {
            $album_id = $_GET['album'];
        }
        include("./components/sidebar.php");
        include("./components/navbar.php");
        include("./db/db_connection.php");
        include("./scripts/likes.php");
        include("./components/comment.php");
        include("./scripts/cut_string.php");
        ?>
        <div class="content">
            <div class="flex flex-col">
                <?php
                $mainres = mysqli_query($connection, "SELECT album.*, user.username FROM album JOIN user ON album.user_id = user.id WHERE album.id = '$album_id'");
                $maindata = mysqli_fetch_array($mainres);
                $data = $maindata;
                include("./scripts/time_ago.php");
                ?>
                <p class="text-xs font-normal text-gray-500 mb-1">
                    <?php echo "@" . $maindata['username'] . " &bull; Album &bull; Created " . $timeAgo; ?>
                </p>
                <p class="text-lg font-semibold mb-1">
                    <?= $maindata['name']; ?>
                </p>
                <p class="text-base font-normal mb-2">
                    <?= $maindata['description']; ?>
                </p>
                <div class="flex"><img src="./assets/icons/album-black.svg" class="kosakop">
                    <p class="text-xs my-auto font-bold max-w-full break-words text-gray-500">
                        <?php
                        $tupres = mysqli_query($connection, "SELECT COUNT(*) AS total_picture FROM picture WHERE album_id = '$album_id'");
                        $tupdata = mysqli_fetch_array($tupres);
                        $total_pic = $tupdata['total_picture'];
                        if ($total_pic > 1) {
                            echo $total_pic . " Photos";
                        } else {
                            echo $total_pic . " Photo";
                        }
                        ?>
                    </p>
                </div>
            </div>
            <div class="flex flex-col gap-4">
                <?php
                $res = mysqli_query($connection, "SELECT picture.*, user.username FROM picture JOIN user ON picture.user_id = user.id WHERE picture.album_id = '$album_id' ORDER BY picture.created_at DESC");
                while ($data = mysqli_fetch_array($res)) {
                    include("./scripts/time_ago.php");
                    include("./components/picture_posts.php");
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>