<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafeteria | Login</title>
    <link rel="stylesheet" href="./css/reset.css">
    <link rel="stylesheet" href="./css/login_signup.css">
    <script src="./js/manage-login.js" defer></script>
</head>
<body>
    <div class="container--Overlay"></div>
    <div class="container">
        <fieldset class="sub-container">
            <form action="./php/manage_login.php" method="get">
                <div class="form__logo">
                    <img src="./assets/imgs/logo.png" alt="Cafe Management System">
                </div>
                <div class="form__inputs">
                    <div class="form__inputs--username">
                        <img src="./assets/icons/user-solid.svg" alt="User">
                        <input type="text" placeholder="Enter your username" name="username" id="username" autocomplete="off">
                    </div>
                    <div class="form__inputs--password">
                        <img src="./assets/icons/lock-solid.svg" alt="Password">
                        <input type="password" placeholder="Enter your password" name="password" id="password">
                    </div>
                    <select id="role" class="role" name="role">
                        <option value="" selected>Choose a role</option>
                        <option value="Customer">Customer</option>
                        <option value="Manager">Manager</option>
                    </select>
                </div>
                <div class="form__submission">
                    <input type="submit" value="Login" name="submit" id="submitButton" disabled>
                </div>
            </form>
            <p class="OR" >OR</p>
            <div class="form__submission">
                <a href="./signup.html"><input type="submit" value="Sign up"></a>
            </div>
        </fieldset>
    </div>
    
</body>
</html>