<div class="border-cust p-4 rounded-md shadow">
    <p class="text-base font-semibold mb-4">Post New Picture</p>
    <form enctype="multipart/form-data" onsubmit="ValidateUpload(event)" class="flex flex-col gap-4" method="post">
        <label for="file-input">
            <div id="box" ondragenter="ImgEnter()" ondragleave="ImgLeave()" ondragover="AllowDrop(event)"
                ondrop="Drop(event)" class="box flex">
                <div id="box-placeholder" class="m-auto -z-20">
                    <img class="cutip" src="./assets/icons/album-black.svg">
                    <p>Browse or drag image</p>
                </div>
                <img id="prev-img" class="cust-koplo hidden" src="">
            </div>
        </label>
        <span id="errorImage" class="text-xs text-red-600 font-normal text-center hidden"></span>
        <input onblur="Validate('photo')" name="photo" accept="image/*" id="file-input" type="file" onchange="Preview()"
            hidden>
        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
            <label class="text-xs font-normal text-gray-600 colop" for="title">Title</label>
            <input onblur="Validate('title')" id="title" name="title" class="input-polop" type="text"
                placeholder="Enter your picture title">
            <span id="errorTitle" class="text-xs text-red-600 font-normal hidden"></span>
        </div>
        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
            <label class="text-xs font-normal text-gray-600 colop" for="description">Description</label>
            <textarea name="description" id="description" class="input-polop text-area" type="text"
                placeholder="Enter your picture description"></textarea>
        </div>
        <div class="input-cont p-2 border-cust rounded-md gap-2 polop">
            <label class="text-xs font-normal text-gray-600 colop" for="album">Album</label>
            <select id="album" name="album" class="input-polop">
                <option value="" selected>No Album</option>
                <?php
                $res = mysqli_query($connection, "SELECT * FROM album WHERE user_id = '$user_id' ORDER BY created_at DESC");
                while ($data = mysqli_fetch_array($res)) {
                    ?>
                    <option value="<?php echo $data['id']; ?>">
                        <?php $name = $data['name'];
                        $name = CutString($name, 40);
                        echo $name; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn-post" name="upload">Upload</button>
        <span id="errorSubmit" class="text-xs text-red-600 font-normal text-center hidden">Data Invalid.
            Please Try Again</span>
    </form>
</div>

<script>
    function ErrorCustom(type, message) {
        const errorSubmit = document.getElementById("errorSubmit");
        const errorImage = document.getElementById("errorImage");
        if (type == "upload") {
            errorSubmit.innerHTML = message;
            errorSubmit.classList.remove("hidden");
        }
        if (type == "image") {
            errorImage.innerHTML = message;
            errorImage.classList.remove("hidden");
        }
    }

    function ValidateUpload(e) {
        const photo = document.getElementById("file-input");
        const title = document.getElementById("title");
        const errorImage = document.getElementById("errorImage");
        const errorTitle = document.getElementById("errorTitle");
        if (photo.value == "" || title.value == "") {
            e.preventDefault();
        }
        if (photo.value == "") {
            errorImage.classList.remove("hidden");
            errorImage.innerHTML = "Image cannot be empty";
        }
        if (title.value == "") {
            errorTitle.classList.remove("hidden");
            errorTitle.innerHTML = "Tittle cannot be empty";
        }
    }

    function Validate(string) {
        const photo = document.getElementById("file-input");
        const title = document.getElementById("title");
        const errorImage = document.getElementById("errorImage");
        const errorTitle = document.getElementById("errorTitle");
        if (string == "photo") {
            errorImage.classList.add("hidden");
            errorImage.innerHTML = "";
        }
        if (string == "title") {
            errorTitle.classList.add("hidden");
            errorTitle.innerHTML = "";
        }
    }

    function AllowDrop(ev) {
        ev.preventDefault();
    }

    function ImgEnter() {
        const box = document.getElementById("box");
        box.classList.add("cust-bg");
    }

    function ImgLeave() {
        const box = document.getElementById("box");
        box.classList.remove("cust-bg");
    }

    function Preview() {
        const img = document.getElementById("prev-img");
        const box = document.getElementById("box");
        const placeholder = document.getElementById("box-placeholder");
        const input = document.getElementById("file-input");
        if (input.files.length > 0) {
            box.classList.add("cust-max-h");
            placeholder.classList.add("hidden");
            img.classList.remove("hidden");
            img.src = URL.createObjectURL(input.files[0]);
        } else {
            box.classList.remove("cust-max-h");
            box.classList.remove("cust-bg");
            placeholder.classList.remove("hidden");
            img.classList.add("hidden");
            img.src = "";
        }
    }

    function Drop(ev) {
        ev.preventDefault();
        const input = document.getElementById("file-input");
        input.files = ev.dataTransfer.files;
        Preview();
    }
</script>