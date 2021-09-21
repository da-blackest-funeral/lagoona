<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Database.php';

$user = new User();
$db = new Db();

if (isset($_POST['new_password'])) {
    if (password_verify($user->password, $db->getPassword($_SESSION['login']))) {

        $db->updatePassword(
            $_SESSION['login'],
            $_POST['new_password']
        );
        echo '<b style="color:green"> Успешно! </b><br>';
    } else {
        echo '<b style="color:red"> Пароль неверный! </b><br>';
    }
}

require_once __DIR__ . '/templates/mypage.html';