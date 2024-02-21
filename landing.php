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
    <title>Daylus - The Best Way To Nostalgia</title>
</head>

<body>
    <?php
    if (isset($_COOKIE['user_id'])) {
        header("location: index.php");
    }
    ?>
    <div class="flex min-h-screen">
        <div class="color-primary w-2/3 p-8 flex flex-col">
            <img class="cust-loji" src="./assets/icons/text-daylus-white.png">
            <div class="mt-auto mb-auto mr-auto p-8 flex flex-col gap-4">
                <p class="text-col-white text-3xl font-semibold">Preserve Your Memories Forever</p>
                <p class="text-col-white text-xl">Store and Organize Your Photos Effortlessly, Creating Lasting Albums
                    to Cherish. Join Our Community
                    to Share, Connect, and Relive Precious Moments Together.</p>
            </div>
        </div>
        <div class="flex-1 flex">
            <div class="mt-auto mb-auto p-8 flex flex-col gap-8">
                <p class="text-4xl font-semibold text-center">Start today and feel the difference!</p>
                <div class="flex gap-4">
                    <div class="flex flex-col gap-2 w-full">
                        <button onclick="Redirect('login.php')" class="btn-siki">LogIn</button>
                        <p class="text-center text-xs">Already have an account?</p>
                    </div>
                    <div class="flex flex-col gap-2 w-full">
                        <button onclick="Redirect('register.php')" class="btn-siki">Register</button>
                        <p class="text-center text-xs">Don't have an account yet?</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function Redirect(string) {
            window.location.href = string;
        }
    </script>
</body>

</html>