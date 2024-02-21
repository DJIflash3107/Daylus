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
    <title>Favorites</title>
</head>

<body>
    <div class="content-container">
        <?php
        if (!isset($_COOKIE['user_id'])) {
            header("location: landing.php");
        }
        include("./components/sidebar.php");
        include("./components/navbar.php");
        include("./db/db_connection.php");
        $user_id = $_COOKIE['user_id'];
        include("./scripts/likes.php");
        include("./scripts/cut_string.php");
        ?>
        <div class="content">
            <?php
            $res = mysqli_query($connection, "SELECT picture.*, user.username FROM picture JOIN user ON picture.user_id = user.id JOIN `like` ON picture.id = `like`.picture_id WHERE `like`.user_id = '$user_id' ORDER BY `like`.created_at DESC");
            while ($data = mysqli_fetch_array($res)) {
                include("./scripts/time_ago.php");
                include("./components/picture_posts.php");
            }
            ?>
        </div>
    </div>
    <?php
    include("./components/comment.php");
    ?>
</body>

</html>