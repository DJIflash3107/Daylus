<?php
$liked = false;
$like_id = 0;
foreach ($likes as $like) {
    if ($like['picture_id'] == $data['id']) {
        $liked = true;
        $like_id = $like['id'];
    }
}
$max_length = 200;
$title_max = 110;
$description = $data['description'];
$title = $data['title'];
if (strlen($description) > $max_length) {
    $description = substr($description, 0, $max_length) . "...";
}
if (strlen($title) > $title_max) {
    $title = substr($title, 0, $title_max) . "...";
}
$picture_id = $data['id'];
?>
<div class="card">
    <?php
    $path = $_SERVER['REQUEST_URI'];
    if (str_contains($path, "profile.php")) {
        ?>
        <div class="flex gap-4 relative">
            <div class="flex flex-col flex-1 max-w-custar">
                <p id="status-<?php echo $data['id']; ?>" class="text-xs font-light mb-1">
                    <?php echo "@" . $data['username'] . " &bull; " . $timeAgo; ?>
                </p>
                <p onclick="Redirect('picture_detail.php?picture=<?php echo $picture_id; ?>')"
                    class="text-base font-semibold mb-1 cursor-pointer w-fit max-w-full">
                    <?php echo $title ?>
                </p>
                <p id="title-<?php echo $data['id']; ?>" class="hidden">
                    <?php echo $data['title']; ?>
                </p>
                <p onclick="Redirect('picture_detail.php?picture=<?php echo $picture_id; ?>')"
                    class="text-sm font-normal poci cursor-pointer w-fit max-w-full mb-4">
                    <?php echo $description; ?>
                    <span class="ellipsos">...</span>
                </p>
                <p id="description-<?php echo $data['id']; ?>" class="hidden">
                    <?php echo $data['description'] ?>
                </p>
            </div>
            <button class="h-fit">
                <img onclick="ShowOptn(<?= $data['id']; ?>)" id="btn-optn-<?= $data['id']; ?>"
                    class="img-koki cursor-pointer" src="../assets/icons/ellipsis.svg">
            </button>
            <div id="optn-<?= $data['id']; ?>" class="options shadow-md hidden">
                <button onclick="Redirect('edit.php?picture=<?= $data['id']; ?>')">Edit this post</button>
                <button onclick="ShowAlert(<?php echo $data['id']; ?>, '<?php echo $data['file_location']; ?>')">Delete this
                    post</button>
            </div>
        </div>
        <?php
    } else {
        ?>
        <p id="status-<?php echo $data['id']; ?>" class="text-xs font-light mb-1">
            <?php echo "@" . $data['username'] . " &bull; " . $timeAgo; ?>
        </p>
        <p onclick="Redirect('picture_detail.php?picture=<?php echo $picture_id; ?>')"
            class="text-base font-semibold mb-1 cursor-pointer w-fit max-w-full">
            <?php echo $title ?>
        </p>
        <p id="title-<?php echo $data['id']; ?>" class="hidden">
            <?php echo $data['title']; ?>
        </p>
        <p onclick="Redirect('picture_detail.php?picture=<?php echo $picture_id; ?>')"
            class="text-sm font-normal poci cursor-pointer w-fit max-w-full mb-4">
            <?php echo $description; ?>
            <span class="ellipsos">...</span>
        </p>
        <p id="description-<?php echo $data['id']; ?>" class="hidden">
            <?php echo $data['description'] ?>
        </p>
        <?php
    }
    ?>
    <img onclick="Redirect('picture_detail.php?picture=<?php echo $picture_id; ?>')" id="img-<?php echo $data['id']; ?>"
        class="cust-img mb-4 cursor-pointer select-none" src="<?php echo $data['file_location']; ?>">
    <div class="mr-auto flex gap-4">
        <div class="flex gap-1">
            <form class="formi" method="post"><button type="submit" name="<?php
            if ($liked == true) {
                echo "dislike";
            } else {
                echo "like";
            }
            ?>" value="<?php
            if ($liked == true) {
                echo $like_id;
            } else {
                echo $data['id'];
            }
            ?>"><img class="<?php
            if ($liked == true) {
                echo "img-koti";
            } else {
                echo "img-kosap";
            }
            ?>" src="./assets/icons/<?php
            if ($liked == true) {
                echo "star-solid.svg";
            } else {
                echo "star-black.svg";
            }
            ?>"></button></form><span class="text-smop font-normal mt-auto">
                <?php
                $subres = mysqli_query($connection, "SELECT COUNT(*) AS total FROM `like` WHERE picture_id = '$picture_id'");
                $subdata = mysqli_fetch_array($subres);
                $total = $subdata['total'];
                if ($total > 1) {
                    echo $total . " likes";
                } else {
                    echo $total . " like";
                }
                ?>
            </span>
        </div>
        <div class="flex gap-1">
            <button onclick="Comment(<?php echo $data['id']; ?>)" class="my-auto"><img class="img-koki"
                    src="./assets/icons/comment.svg"></button>
            <span class="text-smop font-normal mt-auto">
                <?php
                $subres = mysqli_query($connection, "SELECT COUNT(*) AS total FROM comment WHERE picture_id = '$picture_id'");
                $subdata = mysqli_fetch_array($subres);
                $total = $subdata['total'];
                if ($total > 1) {
                    echo $total . " comments";
                } else {
                    echo $total . " comment";
                } ?>
            </span>
        </div>
    </div>
</div>