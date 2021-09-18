<?php
require_once dirname(__FILE__) . '/classes/User.php';
require_once dirname(__FILE__) . '/classes/Database.php';

$user = new User();
$db = new Db();

if (isset($_POST['new_password'])) {
    if (password_verify($user->password, $db->getUserPassword($_SESSION['login']))) {

        $db->updateUserPassword(
            $_SESSION['login'],
            $_POST['new_password']
        );
        echo '<b style="color:green"> Успешно! </b><br>';
    } else {
        echo '<b style="color:red"> Пароль неверный! </b><br>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1> Личный кабинет пользователя
    <?php if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
    } ?> </h1>
<form action="mypage.php" method="post">
    <b> Редактировать пароль: </b>
    <p> Введите старый пароль</p>
    <input type="text"
           placeholder="Enter Password"
           name="password"
           required>
    <br>
    <p> Введите новый пароль </p>
    <input type="text"
           placeholder="Enter New Password"
           name="new_password">
    <br>
    <input type="submit"
           value="Отправить"
           required>
</form>
</body>
</html>