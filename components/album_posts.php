<?php
$album_id = $data['id'];
$subres = mysqli_query($connection, "SELECT COUNT(*) AS total FROM picture WHERE album_id ='$album_id'");
$subdata = mysqli_fetch_array($subres);
$image = $data['file_location'];
?>
<div class="card">
    <?php
    $path = $_SERVER['REQUEST_URI'];
    if (str_contains($path, "profile.php")) {
        ?>
        <div class="flex relative gap-4">
            <div class="flex flex-col flex-1 max-w-custar">
                <p class="text-xs font-normal mb-1">
                    <?php echo "@" . $data['username'] . " &bull; Album &bull; Created " . $timeAgo; ?>
                </p>
                <p onclick="Redirect('album_pictures.php?album=<?php echo $data['id']; ?>')"
                    class="text-base font-semibold mb-1 cursor-pointer w-fit max-w-full">
                    <?php $name = $data['name'];
                    $name = CutString($name, 110);
                    echo $name;
                    ?>
                </p>
                <p onclick="Redirect('album_pictures.php?album=<?php echo $data['id']; ?>')"
                    class="text-sm font-normal mb-4 cursor-pointer w-fit max-w-full">
                    <?php $description = $data['description'];
                    $description = CutString($description, 200);
                    echo $description; ?>

                </p>
            </div>
            <button class="h-fit">
                <img onclick="ShowOptn(<?= $data['id']; ?>)" id="btn-optn-<?= $data['id']; ?>"
                    class="img-koki cursor-pointer" src="../assets/icons/ellipsis.svg">
            </button>
            <div id="optn-<?= $data['id']; ?>" class="options shadow-md hidden">
                <button onclick="Redirect('edit.php?album=<?= $data['id']; ?>')">Edit this album</button>
                <button onclick="ShowAlbumAlert(<?php echo $data['id']; ?>)">Delete this album</button>
            </div>
        </div>
        <?php
    } else {
        ?>
        <p class="text-xs font-normal mb-1">
            <?php echo "@" . $data['username'] . " &bull; Album &bull; Created " . $timeAgo; ?>
        </p>
        <p onclick="Redirect('album_pictures.php?album=<?php echo $data['id']; ?>')"
            class="text-base font-semibold mb-1 cursor-pointer w-fit max-w-full">
            <?php $name = $data['name'];
            $name = CutString($name, 110);
            echo $name;
            ?>
        </p>
        <p onclick="Redirect('album_pictures.php?album=<?php echo $data['id']; ?>')"
            class="text-sm font-normal mb-4 cursor-pointer w-fit max-w-full">
            <?php $description = $data['description'];
            $description = CutString($description, 200);
            echo $description;
            ?>
        </p>
        <?php
    }
    ?>
    <div onclick="Redirect('album_pictures.php?album=<?php echo $data['id']; ?>')" class="relative bopul">
        <img class="cust-img mb-4 <?php if ($image == null || $image == "") {
            echo "gituk";
        } ?>" src="<?php if ($image != "" && $image != null) {
             echo $image;
         } else {
             echo "./assets/icons/image-placeholder.jpg";
         } ?>">
        <div class="label-cust">
            <img src="./assets/icons/album.svg">
            <p>
                <?php echo $subdata['total']; ?>
            </p>
        </div>
        <div class="seeall">
            <p class="text-seeall">VIEW ALBUM</p>
        </div>
    </div>
    <div class="text-gray-700 text-sm">
        <?php
        $dubres = mysqli_query($connection, "SELECT * FROM picture WHERE album_id = '$album_id' ORDER BY created_at DESC LIMIT 3");
        while ($dubdata = mysqli_fetch_array($dubres)) {
            ?>
            <div class="flex gap-1">
                <p>&bull;</p>
                <p onclick="Redirect('picture_detail.php?picture=<?= $dubdata['id'] ?>')"
                    class="max-w-full cursor-pointer hover:underline">
                    <?php $dubtitle = $dubdata['title'];
                    $dubtitle = CutString($dubtitle, 110);
                    echo $dubtitle; ?>
                </p>
            </div>
            <?php
        }
        ?>
    </div>
</div>