<?php
require_once dirname(__FILE__) . '/classes/User.php';
require_once dirname(__FILE__) . '/classes/Database.php';

$db = new Db();
$user = new User();

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" href="css/auth.css"/>
    <title>Registration</title>
</head>
<body>
<main class="main">
    <div class="form__container">
        <form action="register.php" method="post">
            <div class="imgcontainer">
                <img src="img/img_avatar2.png" alt="Avatar" class="avatar"/>
            </div>
            <?php
            // Проверка на существование аккаунта
            if (isset($_POST['login'])) {
                if ($db->checkExistingUser($_POST['login'])) { ?>
                    <p style="color: red;">У вас уже есть аккаунт!</p>
                    <a href="auth.php">Желаете войти?</a>
                    <br>
                <?php } else {
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