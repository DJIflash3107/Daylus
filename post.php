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
    <title>Post</title>
</head>

<body>
    <div class="content-container">
        <?php
        if (!isset($_COOKIE['user_id'])) {
            header("location: landing.php");
        } else {
            $user_id = $_COOKIE['user_id'];
        }
        include("./components/sidebar.php");
        include("./components/navbar.php");
        include("./db/db_connection.php");
        include("./components/notification.php");
        include("./scripts/cut_string.php");
        ?>
        <div class="content">
            <?php
            if (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == "picture")) {
                include("./components/picture_form.php");
            } else if (isset($_GET['page']) && $_GET['page'] == "album") {
                include("./components/album_form.php");
            }
            ?>
        </div>
    </div>
    <?php
    include("./scripts/upload_post.php");
    include("./scripts/create_album.php");
    ?>
</body>

</html>