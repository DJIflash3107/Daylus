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
    <title>Home</title>
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
        include("./scripts/likes.php");
        include("./components/comment.php");
        include("./scripts/cut_string.php");
        ?>
        <div class="content">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $search = htmlentities($search);
                $res = mysqli_query($connection, "SELECT picture.*, user.username FROM picture JOIN user ON picture.user_id = user.id 
                WHERE user.username LIKE '%$search%' OR picture.title LIKE '%$search%' OR picture.description LIKE '%$search%' ORDER BY 
                CASE WHEN LOWER(user.username) = LOWER('$search') THEN 1 WHEN picture.title LIKE '$search%' THEN 2 WHEN picture.title LIKE
                '%$search%' THEN 3 WHEN picture.title LIKE '%$search' THEN 4 WHEN picture.description LIKE '$search%' THEN 5 WHEN
                picture.description LIKE '%$search%' THEN 6 WHEN picture.description LIKE '%$search' THEN 7 ELSE 8 END,
                picture.created_at DESC");
            } else {
                $res = mysqli_query($connection, "SELECT picture.*, user.username FROM picture JOIN user ON picture.user_id = user.id ORDER BY picture.created_at DESC");
            }
            while ($data = mysqli_fetch_array($res)) {
                include("./scripts/time_ago.php");
                include("./components/picture_posts.php");
            }
            ?>
        </div>
    </div>
</body>

</html>