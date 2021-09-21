<?php
require_once dirname(__FILE__) . '/classes/User.php';
require_once dirname(__FILE__) . '/classes/Database.php';

$db = new Db();
$user = new User();
$uniqueCode = '228'; // На будущее для восстановление пароля (через почту)

/*
  Если страница auth.php уже получила
  данные из форм и редиректнулась сама на себя
*/
if (isset($user->password)) {
    $db->checkIfExists($user->login);
    $realPassword = $db->getPassword($user->login);
}

// Если это восстановление пароля
if (isset($_POST['new_password'])) {
    if (password_verify($user->password, $realPassword)) {
        $db->updatePassword($user->login, $_POST['new_password']);
    }
}

if (isset($user->password) && $user->auth($realPassword) ) {
        header("Location: index.php");
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/lagona/templates/auth.html';