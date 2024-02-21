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
    <title>Picture</title>
</head>

<body>
    <div id="content-container" class="content-container">
        <?php
        if (!isset($_COOKIE['user_id'])) {
            header("location: landing.php");
        } else {
            $user_id = $_COOKIE['user_id'];
        }
        if (!isset($_GET['picture'])) {
            header("location: index.php");
        } else {
            $picture_id = $_GET['picture'];
        }
        include("./components/sidebar.php");
        include("./components/navbar.php");
        include("./db/db_connection.php");
        include("./scripts/likes.php");
        $res = mysqli_query($connection, "SELECT picture.*, user.username FROM picture JOIN user ON picture.user_id = user.id WHERE picture.id = '$picture_id'");
        $data = mysqli_fetch_array($res);
        $liked = false;
        $like_id = 0;
        foreach ($likes as $like) {
            if ($like['picture_id'] == $data['id']) {
                $liked = true;
                $like_id = $like['id'];
            }
        }
        include("./scripts/time_ago.php");
        ?>
        <div class="content">
            <div class="border-cust p-4 rounded-md flex flex-col gap-4 shadow">
                <div class="flex flex-col">
                    <p class="text-sm font-normal mb-1 text-gray-500">
                        <?php echo "@" . $data['username'] . " &bull; " . $timeAgo; ?>
                    </p>
                    <p class="text-lg font-semibold mb-1">
                        <?php echo $data['title']; ?>
                    </p>
                    <p class="text-base font-normal mb-2">
                        <?php echo $data['description']; ?>
                    </p>
                    <div class="flex gap-4">
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
                                echo "img-supa";
                            } else {
                                echo "img-supo";
                            }
                            ?>" src="./assets/icons/<?php
                            if ($liked == true) {
                                echo "star-solid.svg";
                            } else {
                                echo "star-gray.svg";
                            }
                            ?>"></button></form>
                            <span class="text-bmop my-auto font-normal">
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
                            <button onclick="FocusComment()" class="my-auto"><img class="img-jobar"
                                    src="./assets/icons/comment-gray.svg"></button>
                            <span class="text-bmop my-auto font-normal">
                                <?php
                                $subres = mysqli_query($connection, "SELECT COUNT(*) AS total FROM comment WHERE picture_id = '$picture_id'");
                                $subdata = mysqli_fetch_array($subres);
                                $total = $subdata['total'];
                                if ($total > 1) {
                                    echo $total . " comments";
                                } else {
                                    echo $total . " comment";
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
                <img src="<?php echo $data['file_location']; ?>" class="img-lokapo select-none">
                <div class="flex flex-col">
                    <form onsubmit="Check(event)" method="post" class="relative flex mb-4"><textarea name="content"
                            id="comment-detail" class="input-pijerid jopig border-cust-b" type="text"
                            placeholder="Post your comment"></textarea>
                        <button type="submit" name="comment"><img src="./assets/icons/paper-plane-gray.svg"
                                class="img-fidut cursor-pointer pocuk"></button>
                    </form>
                    <?php
                    $dubres = mysqli_query($connection, "SELECT comment.*, user.username FROM comment JOIN user ON comment.user_id = user.id WHERE comment.picture_id = '$picture_id' ORDER BY comment.created_at DESC");
                    while ($dubdata = mysqli_fetch_array($dubres)) {
                        $data = $dubdata;
                        include("./scripts/time_ago.php");
                        ?>
                        <div class="border-cust-b py-2">
                            <?php
                            if ($dubdata['user_id'] == $user_id) {
                                ?>
                                <div class="flex relative gap-4">
                                    <p class="text-xs font-normal text-gray-500 mb-2 flex-1">
                                        <?= "@" . $dubdata['username'] . " &bull; " . $timeAgo ?>
                                    </p>
                                    <button class="h-fit">
                                        <img onclick="ShowOptn(<?= $dubdata['id']; ?>)" id="btn-optn-<?= $dubdata['id']; ?>"
                                            class="img-koki cursor-pointer" src="../assets/icons/ellipsis.svg">
                                    </button>
                                    <div id="optn-<?= $dubdata['id']; ?>" class="options shadow-md hidden">
                                        <button
                                            onclick="EditComment('<?= $dubdata['content']; ?>', '<?= $dubdata['id']; ?>')">Edit
                                            this
                                            comment</button>
                                        <button onclick="ShowCommentAlert(<?php echo $dubdata['id']; ?>)">Delete
                                            this
                                            comment</button>
                                    </div>
                                </div>
                                <?php
                            } else {
                                ?>
                                <p class="text-xs font-normal text-gray-500 mb-2">
                                    <?= "@" . $dubdata['username'] . " &bull; " . $timeAgo ?>
                                </p>
                                <?php
                            }
                            ?>

                            <p class="text-sm font-normal">
                                <?= $dubdata['content']; ?>
                            </p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div onclick="ClickOutsideAlert(event)" id="alert" class="alert hidden">
        <div id="alert-form" class="m-auto bg-wolp rounded-md">
            <p id="alert-title" class="text-center text-base font-bold bg-wolp p-4 rounded-t-md">Are you sure to delete
                this comment?</p>
            <div class="flex gap-ol">
                <button onclick="HideAlert()" class="flex-1 font-semibold btn-no">No</button>
                <form method="post" class="flex-1 btn-yes">
                    <button id="yes-alert" type="submit" value="" name="delete_comment"
                        class="w-full font-semibold">Yes</button>
                </form>
            </div>
        </div>
    </div>
    <div onclick="ClickOutside(event)" id="comment" class="comment p-8 hidden">
        <div id="comment-form" class="mx-auto mb-auto bg-wolp p-4 rounded-cust toki flex flex-col gap-4">
            <div class="flex">
                <p class="font-semibold text-base my-auto">Edit Comment</p>
                <img onclick="CloseComment()" class="x ml-auto cursor-pointer jokap" src="./assets/icons/x.svg">
            </div>
            <form class="relative flex" onsubmit="ValidateComment(event)" method="post">
                <input id="id-comment" name="comment_id" type="text" value="" hidden class="hidden">
                <textarea id="content-comment" name="content" class="input-com h-kopi" type="text"
                    placeholder="Post your comment"></textarea>
                <button type="submit" name="edit_comment">
                    <img class="img-fidut cursor-pointer pocuk" src="../assets/icons/paper-plane.svg">
                </button>
            </form>
        </div>
    </div>
    <script>
        function FocusComment() {
            const commentDetail = document.getElementById("comment-detail");
            commentDetail.focus();
        }
        function Check(e) {
            const commentDetail = document.getElementById("comment-detail");
            if (commentDetail.value.length == 0) {
                e.preventDefault();
            }
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
        function ShowCommentAlert(id) {
            const alert = document.getElementById("alert");
            const yes = document.getElementById("yes-alert");
            alert.classList.remove("hidden");
            alert.classList.add("flex");
            yes.setAttribute("value", id);
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
        function EditComment(string, id) {
            const comment = document.getElementById("comment");
            const contentComment = document.getElementById("content-comment");
            const idComment = document.getElementById("id-comment");
            document.body.style.overflowY = 'hidden';
            comment.classList.remove("hidden");
            comment.classList.add("flex");
            idComment.setAttribute("value", id);
            contentComment.value = string;
            contentComment.focus();
        }
        function ValidateComment(e) {
            const contentComment = document.getElementById("content-comment");
            if (contentComment.value.length == 0) {
                e.preventDefault();
            }
        }

        function ClickOutside(e) {
            const comment = document.getElementById("comment");
            const commentForm = document.getElementById("comment-form");
            if (!commentForm.contains(e.target)) {
                CloseComment();
            }
        }
        function CloseComment() {
            const comment = document.getElementById("comment");
            const contentComment = document.getElementById("content-comment");
            document.body.style.overflowY = 'auto';
            comment.classList.remove("flex");
            comment.classList.add("hidden");
        }
    </script>
    <?php
    if (isset($_POST['comment'])) {
        $contentRaw = $_POST['content'];
        $content = htmlentities($contentRaw);
        $content = nl2br($content);
        $unixid = time();
        $res = mysqli_query($connection, "INSERT INTO comment (`id`, `picture_id`, `user_id`, `content`, `created_at`) VALUES ('$unixid', '$picture_id', '$user_id', '$content', NOW())");
        if ($res == 1) {
            $path = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href = '$path';</script>";
        }
    }
    if (isset($_POST['delete_comment'])) {
        $comment_id = $_POST['delete_comment'];
        $res = mysqli_query($connection, "DELETE FROM comment WHERE id = '$comment_id' AND user_id = '$user_id'");
        if ($res == 1) {
            $path = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href = '$path';</script>";
        }
    }
    if (isset($_POST['edit_comment'])) {
        $comment_id = $_POST['comment_id'];
        $content = $_POST['content'];
        $content = htmlentities($content);
        $res = mysqli_query($connection, "UPDATE comment SET content = '$content' WHERE id = '$comment_id' AND user_id = '$user_id'");
        if ($res == 1) {
            $path = $_SERVER['REQUEST_URI'];
            echo "<script>window.location.href = '$path';</script>";
        }
    }
    ?>
</body>

</html>