<?php
$path = $_SERVER['REQUEST_URI'];
?>
<div class="fixed top-0 left-0 h-full pt-4 flex flex-col kisop select-none">
    <div class="pl-16 pr-16 flex mb-4"><img class="logo-img" src="../assets/icons/logo-daylus.png">
        <p class="mt-auto mb-auto ml-1 text-lg font-semibold font-cust">Daylus</p>
    </div>
    <button onclick="Redirect('index.php')" class="flex jipo <?php if (str_contains($path, "/index") || $path == "/") {
        echo ("btn-active");
    } ?>"><img src="./assets/icons/<?php if (str_contains($path, "/index") || $path == "/") {
         echo ("home-solid.svg");
     } else {
         echo ("home.svg");
     } ?>"></img>
        <p>Home</p>
    </button>
    <button class="flex jipo <?php if (str_contains($path, "/album")) {
        echo ("btn-active");
    } ?>" onclick="Redirect('album.php')"><img src="./assets/icons/<?php if (str_contains($path, "/album")) {
         echo ("album-solid.svg");
     } else {
         echo ("album.svg");
     } ?>"></img>
        <p>Album</p>
    </button>
    <div class="flex flex-col">
        <button class="flex jipo <?php if (str_contains($path, "/post")) {
            echo ("btn-active mb-4");
        } ?>" onclick="Redirect('post.php')"><img src="./assets/icons/<?php if (str_contains($path, "/post")) {
             echo ("camera-solid.svg");
         } else {
             echo ("camera.svg");
         } ?>"></img>
            <p>Post</p>
        </button>
        <?php
        if (str_contains($path, "/post")) {
            ?>
            <div class="posal">
                <form><button name="page" value="picture" class="child-btn <?php if (!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] == "picture")) {
                    echo "child-active";
                } ?>">Post New Picture</button></form>
                <form><button name="page" value="album" class="child-btn <?php if (isset($_GET['page']) && $_GET['page'] == "album") {
                    echo "child-active";
                } ?>">Create New Album</button></form>
            </div>
            <?php
        }
        ?>
    </div>
    <button class="flex jipo <?php if (str_contains($path, "/profile")) {
        echo ("btn-active");
    } ?>" onclick="Redirect('profile.php')"><img src="./assets/icons/<?php if (str_contains($path, "/profile")) {
         echo ("profile-solid.svg");
     } else {
         echo ("profile.svg");
     } ?>"></img>
        <p>Profile</p>
    </button>
    <button class="flex jipo <?php if ($path == "/favorites.php") {
        echo ("btn-active");
    } ?>" onclick="Redirect('favorites.php')"><img src="./assets/icons/<?php if ($path == "/favorites.php") {
         echo ("star-solid.svg");
     } else {
         echo ("star.svg");
     } ?>"></img>
        <p>Favorites</p>
    </button>
</div>

<script>
    function Redirect(string) {
        window.location.href = string;
    }
</script>