<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="./Views/css/main.css">
<!-- FONTAWESOME -->

    <script src="https://kit.fontawesome.com/20fb0bfa14.js" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
<?php
session_abort();
?>
    <div class="logo">
        <img src="./Views/img/Logo.png">
    </div>
    <div class="form">
        <form action=./Controller/siginController.php method="POST" class="form login">

            <div class="form__field">
                <label for="login__username"><svg class="icon">
                    <use xlink:href="#icon-user"></use>
                </svg><span class="hidden">DNI</span></label>
                <input autocomplete="username" id="login__username" type="text" name="dni" class="form__input" placeholder="DNI" required>
            </div>

            <div class="form__field">
                <label for="login__password"><svg class="icon">
                    <use xlink:href="#icon-lock"></use>
                </svg><span class="hidden">Password</span></label>
                <input id="login__password" type="password" name="password" class="form__input" placeholder="Password" required>
            </div>

            <div class="form__field">
                <input type="submit" name="button-login" value="Sign In">
            </div>

        </form>
        <p class="text--center">Not a member? <a href="./Views/singup.html">Sign up now</a> <svg class="icon">
            <use xlink:href="#icon-arrow-right"></use>
        </svg></p>
        <?php
            if (isset($_GET['error'])&& $_GET['error']=='true'){
                echo "Datos incorrectos";
            }
        ?>



    </div>
</body>
</html>