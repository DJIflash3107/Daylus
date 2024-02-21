<div onclick="ClickOutside(event)" id="comment" class="comment p-8 hidden">
    <div id="comment-form" class="mx-auto mb-auto bg-wolp p-4 rounded-cust toki flex flex-col gap-4">
        <div class="flex">
            <p class="font-semibold text-base my-auto">Send Comment</p>
            <img onclick="CloseComment()" class="x ml-auto cursor-pointer jokap" src="./assets/icons/x.svg">
        </div>
        <div class="break-words">
            <p id="status-comment" class="text-xs font-light mb-1">
            </p>
            <p id="title-comment" class="text-base font-semibold mb-1">
            </p>
            <p id="description-comment" class="text-sm font-normal mb-4">
            </p>
            <img id="img-comment" class="img-com" src="">
        </div>
        <form class="relative flex" onsubmit="ValidateComment(event)" method="post">
            <input class="hidden" value="" id="id-comment" name="picture_id" type="text" hidden>
            <textarea id="content-comment" name="content" class="input-com" type="text"
                placeholder="Post your comment"></textarea>
            <button type="submit" name="comment">
                <img class="img-fidut cursor-pointer pocuk" src="../assets/icons/paper-plane.svg">
            </button>
        </form>
    </div>
</div>
<script>
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

    function Comment(id) {
        const comment = document.getElementById("comment");
        const imgComment = document.getElementById("img-comment");
        const statusComment = document.getElementById("status-comment");
        const titleComment = document.getElementById("title-comment");
        const descriptionComment = document.getElementById("description-comment");
        const contentComment = document.getElementById("content-comment");
        const idComment = document.getElementById("id-comment");
        const imgContent = document.getElementById("img-" + id);
        const statusContent = document.getElementById("status-" + id);
        const titleContent = document.getElementById("title-" + id);
        const descriptionContent = document.getElementById("description-" + id);
        document.body.style.overflowY = 'hidden';
        comment.classList.remove("hidden");
        comment.classList.add("flex");
        imgComment.src = imgContent.src;
        statusComment.innerHTML = statusContent.innerHTML;
        titleComment.innerHTML = titleContent.innerHTML;
        descriptionComment.innerHTML = descriptionContent.innerHTML;
        contentComment.focus();
        idComment.setAttribute("value", id);
    }

    function CloseComment() {
        const comment = document.getElementById("comment");
        document.body.style.overflowY = 'auto';
        comment.classList.remove("flex");
        comment.classList.add("hidden");
    }
</script>
<?php
if (isset($_POST['comment'])) {
    $picture_id = $_POST['picture_id'];
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
?>