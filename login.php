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
    <title>Login</title>
</head>

<body>
    <?php
    include("./scripts/eye_password.php");
    if (isset($_COOKIE['user_id'])) {
        header("location: index.php");
    }
    ?>
    <div class="min-h-screen flex p-8">
        <div class="m-auto rounded-md shadow border-cust cust-form p-8">
            <div class="mr-auto w-fit"><img onclick="Redirect('landing.php')" class="back-cust"
                    src="./assets/icons/back-arrow.svg"></div>
            <form action="process.php" onsubmit="ValidateLogin(event)" method="post" class="flex flex-col gap-4">
                <img class="img-kedir mx-auto" src="./assets/icons/logo-daylus.png">
                <p class="text-center text-sm">LogIn To Continue</p>
                <?php
                if (isset($_GET['registered'])) {
                    ?>
                    <span class="text-xs text-green-600 font-normal text-center">Your data has been successfully
                        registered. Please login to continue.</span>
                    <?php
                }
                ?>
                <div>
                    <label class="text-sm font-semibold text-gray-500" for="email">Email</label>
                    <input name="email" onblur="Validate('email')" class="w-full btn-copli" type="text" id="email"
                        placeholder="example@gmail.com">
                    <span id="errorEmail" class="text-xs text-red-600 font-normal hidden">Invalid email address. Please
                        enter a valid email.</span>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-500" for="password">Password</label>
                    <div class="relative">
                        <input name="password" onblur="Validate('password')" class="w-full btn-copli" type="password"
                            id="password" placeholder="••••••••">
                        <img id="eye-pass" onclick="ShowPass()" class="eye-pass" src="./assets/icons/eye.svg">
                    </div>
                    <span id="errorPassword" class="text-xs text-red-600 font-normal hidden">Password must have 8-16
                        characters, must contain at least one number and no spaces.</span>
                </div>
                <button type="submit" class="btn-regist" name="login">LogIn</button>
                <?php
                if (isset($_GET['error']) && $_GET['error'] == "true") {
                    ?>
                    <span id="errorSubmit" class="text-xs text-red-600 font-normal text-center">Data Invalid.
                        Please Try Again</span>
                    <?php
                }
                ?>
                <p class="text-gray-500 text-sm">Don't have an account yet? <span
                        class="highlight font-semibold cursor-pointer"
                        onclick="Redirect('register.php')">Register</span></p>
            </form>
        </div>
    </div>
    <?php
    include("./scripts/validate.php");
    ?>
    <script>
        function Redirect(string) {
            window.location.href = string;
        }
    </script>
</body>

</html>