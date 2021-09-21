<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="templates/css/auth.css"/>
    <title>Registration</title>
</head>
<body>
<main class="main">
    <div class="form__container">
        <form action="register.php" method="post">
            <div class="imgcontainer">
                <img src="templates/img/img_avatar2.png" alt="Avatar" class="avatar"/>
            </div>
            <?php
            if (isset($user->login)) {
                if ($db->checkIfExists($user->login)) { ?>
            <p style="color: #1c64db;">У вас уже есть аккаунт!</p>
            <a href="auth.php">Желаете войти?</a>
            <br>
            <?php } else {
                    // Занесение пользователя в базу данных и создание сессии
                    $db->doInserting($user);
                    $user->auth();
                    header('Location: index.php');
                }
            }
            ?>
            <div class="container">
                <label for="login"><b>Username</b></label>
                <input
                        type="text"
                        placeholder="Enter Login"
                        value="<?php if (isset($_SESSION['login'])) echo $_SESSION['login']; ?>"
                        name="login"
                        required
                />
                <label for="psw"><b>Password</b></label>
                <input
                        type="password"
                        placeholder="Enter Password"
                        name="password"
                        required
                />
                <div class="footer-app__bottom">
                    <button type="submit" class="footer-form__button">Отправить данные</button>
                    <div class="footer-form__checkbox">
                        <input type="checkbox" id="checkbox" required/>
                        <label for="checkbox" class="footer-form__agree"
                        >Согласен на обработку данных</label>
                    </div>
                </div>
        </form>
</main>
</body>
</html>