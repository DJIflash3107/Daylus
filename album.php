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
    <title>Album</title>
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
        include("./scripts/cut_string.php");
        ?>
        <div class="content">
            <?php
            if (isset($_GET['search'])) {
                $search = $_GET['search'];
                $search = htmlentities($search);
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
                WHERE user.username LIKE '%$search%' OR album.name LIKE '%$search%' OR album.description LIKE '%$search%' ORDER BY 
                CASE WHEN LOWER(user.username) = LOWER('$search') THEN 1 WHEN album.name LIKE '$search%' THEN 2 WHEN album.name LIKE
                '%$search%' THEN 3 WHEN album.name LIKE '%$search' THEN 4 WHEN album.description LIKE '$search%' THEN 5 WHEN
                album.description LIKE '%$search%' THEN 6 WHEN album.description LIKE '%$search' THEN 7 ELSE 8 END,
                album.created_at DESC");
            } else {
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
            ORDER BY album.created_at DESC;");
            }

            while ($data = mysqli_fetch_array($res)) {
                include("./scripts/time_ago.php");
                include("./components/album_posts.php");
            }
            ?>
        </div>
    </div>
</body>

</html>