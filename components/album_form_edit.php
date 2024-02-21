<?php
$prevname = $data['name'];
$prevdescription = $data['description'];
?>
<div class="border-cust p-4 rounded-md shadow flex flex-col gap-4">
    <p class="text-base font-semibold">Edit Your Album</p>
    <form onsubmit="ValidateAlbum(event)" class="flex flex-col gap-4" method="post">
        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
            <label class="text-xs font-normal text-gray-600 colop" for="name">Album Name</label>
            <input name="album_name" id="album_name" class="input-polop" type="text" placeholder="Enter your album name"
                <?php if ($prevname !== null && $prevname !== "") {
                    echo "value='" . $prevname . "'";
                } ?>>
            <span id="errorAlbumName" class="text-xs text-red-600 font-normal hidden"></span>
        </div>
        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
            <label class="text-xs font-normal text-gray-600 colop" for="album_description">Album Description</label>
            <textarea name="album_description" id="album_description" class="input-polop jitikop"
                placeholder="Enter your album description"><?php if ($prevdescription !== null && $prevdescription !== "") {
                    echo $prevdescription;
                } ?></textarea>
        </div>
        <button type="submit" name="update_album" class="btn-post">Update Album</button>
    </form>
</div>

<script>
    function ValidateAlbum(e) {
        const albumName = document.getElementById("album_name");
        const errorAlbumName = document.getElementById("errorAlbumName");
        if (albumName.value == 0) {
            e.preventDefault();
            errorAlbumName.innerHTML = "Album name cannot be empty";
            errorAlbumName.classList.remove("hidden");
        }
    }
</script>