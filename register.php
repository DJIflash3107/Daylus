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
    <title>Register</title>
</head>

<body>
    <?php
    include("./scripts/eye_password.php");
    include("./db/db_connection.php");
    if (isset($_COOKIE['user_id'])) {
        header("location: index.php");
    }
    ?>
    <div class="min-h-screen flex p-8">
        <div class="m-auto rounded-md shadow border-cust cust-form p-8">
            <div class="mr-auto w-fit"><img onclick="Redirect('landing.php')" class="back-cust"
                    src="./assets/icons/back-arrow.svg"></div>
            <form onsubmit="ValidateRegister(event)" class="flex flex-col gap-4" method="post">
                <img class="img-kedir mx-auto" src="./assets/icons/logo-daylus.png">
                <p class="text-center text-sm">Register To Continue</p>
                <div>
                    <label class="text-sm font-semibold text-gray-500" for="fullname">Fullname</label>
                    <input onblur="Validate('fullname')" class="btn-copli" type="text" name="fullname" id="fullname"
                        placeholder="fullname">
                    <span id="errorFullname" class="text-xs text-red-600 font-normal hidden">Fullname must be at least 3
                        characters long, without numbers or symbols.</span>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-500" for="username">Username</label>
                    <input onblur="Validate('username')" class="btn-copli" type="text" name="username" id="username"
                        placeholder="username">
                    <span id="errorUsername" class="text-xs text-red-600 font-normal hidden">Username must have 3-12
                        characters, cannot contain symbols other than underscore and should not use spaces.</span>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-500" for="address">Address</label>
                    <textarea onblur="Validate('address')" class="btn-copli text-area" name="address" id="address"
                        placeholder="address"></textarea>
                    <span id="errorAddress" class="text-xs text-red-600 font-normal hidden">Address cannot be
                        empty</span>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-500" for="email">Email</label>
                    <input onblur="Validate('email')" class="btn-copli" name="email" type="text" id="email"
                        placeholder="example@gmail.com">
                    <span id="errorEmail" class="text-xs text-red-600 font-normal hidden">Invalid email address. Please
                        enter a valid email.</span>
                </div>
                <div>
                    <label class="text-sm font-semibold text-gray-500" for="password">Password</label>
                    <div class="relative">
                        <input onblur="Validate('password')" class="btn-copli w-full" name="password" type="password"
                            id="password" placeholder="••••••••">
                        <img id="eye-pass" onclick="ShowPass()" class="eye-pass" src="./assets/icons/eye.svg">
                    </div>
                    <span id="errorPassword" class="text-xs text-red-600 font-normal hidden">Password must have 8-16
                        characters, must contain at least one number and no spaces.</span>
                </div>
                <button type="submit" class="btn-regist" name="register">Register</button>
                <span id="errorSubmit" class="text-xs text-red-600 font-normal text-center hidden">Data Invalid.
                    Please Try Again</span>
                <p class="text-gray-500 text-sm">Already have an account? <span
                        class="highlight font-semibold cursor-pointer" onclick="Redirect('login.php')">LogIn</span></p>
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
    <?php
    if (isset($_POST['register'])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $address = $_POST['address'];
        $address = htmlentities($address);
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $unixid = time();
        $res = mysqli_query($connection, "SELECT * from user where email = '$email'");
        if ($res) {
            $data = mysqli_fetch_array($res);
            if ($data) {
                echo "<script>SubmitCustomError('Email already been registered')</script>";
            } else {
                $res = mysqli_query($connection, "INSERT INTO user (`id`, `username`, `password`, `email`, `fullname`, `address`) VALUES ('$unixid', '$username', '$hashed_password', '$email', '$fullname', '$address')");
                if ($res) {
                    echo ("<script>Redirect('login.php?registered=true')</script>");
                } else {
                    echo ("<script>SubmitError()</script>");
                }
            }
        } else {
            echo "<script>SubmitError()</script>";
        }
    }
    ?>
</body>

</html>