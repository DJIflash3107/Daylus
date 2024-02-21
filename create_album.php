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
    <title>Post</title>
</head>

<body>
    <div class="content-container">
        <?php
        include("./components/sidebar.php");
        include("./components/navbar.php");
        ?>
        <div class="content">
            <div class="border-cust p-4 rounded-md flex flex-col gap-4">
                <div class="box flex">
                    <div class="m-auto">
                        <img class="cutip" src="./assets/icons/album-black.svg">
                        <p>Browse or drag image</p>
                    </div>
                </div>
                <div class="input-cont">
                    <label class="text-xs font-light text-gray-600" for="title">Title</label>
                    <input id="title" class="input-post" type="text" placeholder="Enter title">
                </div>
                <div class="input-cont">
                    <label class="text-xs font-light text-gray-600" for="description">Description</label>
                    <textarea id="description" class="input-post text-area" type="text"
                        placeholder="Enter description"></textarea>
                </div>
                <div class="input-cont">
                    <label class="text-xs font-light text-gray-600" for="album">Album</label>
                    <div>
                        <input class="input-post" type="text" value="No Album" readonly>
                        <button class="btn-cust">Select Album</button>
                    </div>
                </div>
                <button class="btn-post">UPLOAD</button>
            </div>
        </div>
    </div>
</body>

</html>