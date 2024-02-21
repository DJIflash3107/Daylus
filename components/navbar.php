<?php
$path = $_SERVER['REQUEST_URI'];
?>
<div class="navbar <?php if (str_contains($path, "index.php") || str_contains($path, "album.php") || $path == "/") {
    echo ("gap-4");
} ?>">
    <?php
    if (str_contains($path, "/album_pictures") || str_contains($path, "/picture_detail") || str_contains($path, "/edit")) {
        ?>
        <img onclick="GoBack()" src="../assets/icons/back-arrow.svg" class="yukop my-auto cursor-pointer mr-8">
        <p class="my-auto font-medium text-base">
            <?php if (str_contains($path, "/album_pictures")) {
                echo "Album Pictures";
            } else if (str_contains($path, "/picture_detail")) {
                echo "Picture";
            } else if (str_contains($path, "/edit.php") && isset($_GET['album'])) {
                echo "Edit Album";
            } else if (str_contains($path, "/edit.php") && isset($_GET['picture'])) {
                echo "Edit Post";
            } else if (str_contains($path, "/edit.php") && isset($_GET['page']) && $_GET['page'] == "profile") {
                echo "Edit Profile";
            } ?>
        </p>
        <?php
    }
    ?>
    <p class="mt-auto mb-auto h-fit font-medium">
        <?php if (str_contains($path, "index.php")) {
            echo ("Home");
        } else if (str_contains($path, "album.php")) {
            echo ("Album");
        } else if (str_contains($path, "post.php")) {
            echo ("Post");
        } else if (str_contains($path, "profile.php")) {
            echo ("Profile");
        } else if (str_contains($path, "favorites.php")) {
            echo ("Favorites");
        }
        ?>
    </p>
    <?php if (str_contains($path, "index.php") || str_contains($path, "album.php") || $path == "/") {
        if (str_contains($path, "index.php")) {
            $currentpath = "index.php";
        }
        if (str_contains($path, "album.php")) {
            $currentpath = "album.php";
        }
        ?>
        <div class="search-cont">
            <img src="../assets/icons/search.svg">
            <form onsubmit="ResetSearch(event, '<?php echo $currentpath; ?>')" class="w-full"><input id="search"
                    name="search" <?php if (isset($_GET['search'])) {
                        echo "value='" . $_GET['search'] . "'";
                    } ?> type="text" placeholder="Search..."><input type="submit" hidden class="hidden"></form>
        </div>
        <?php
    } ?>
    <p class="invisible-cust mt-auto mb-auto h-fit">
        <?php if (str_contains($path, "index.php")) {
            echo ("Home");
        } else if (str_contains($path, "album.php")) {
            echo ("Album");
        } else if (str_contains($path, "post.php")) {
            echo ("Post");
        } else if (str_contains($path, "profile.php")) {
            echo ("Profile");
        } else if (str_contains($path, "favorites.php")) {
            echo ("Favorites");
        }
        ?>
    </p>
</div>
<script>
    function GoBack() {
        window.history.back();
    }
    function ResetSearch(e, url) {
        const search = document.getElementById('search');
        if (search.value.length == 0) {
            e.preventDefault();
            window.location.href = url;
        }
    }
</script>