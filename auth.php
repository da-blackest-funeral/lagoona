<?php
require_once dirname(__FILE__) . '/classes/User.php';
require_once dirname(__FILE__) . '/classes/Database.php';
require_once dirname(__FILE__) . '/classes/Printer.php';

$db = new Db();
$user = new User();
$uniqueCode = '228'; // На будущее для восстановление пароля (через почту)

/**
 * Если страница auth.php уже получила
 * данные из форм и редиректнулась сама на себя
 */
if (isset($user->password)) {
    $db->checkExistingUser($user->login);
    $userRealPassword = $db->getUserPassword($user->login);
}

// Если это восстановление пароля
if (isset($_POST['new_password'])) {
    if (password_verify($user->password, $userRealPassword)) {
        $db->updateUserPassword($_POST['login'], $_POST['new_password']);
    }
}

if (isset($user->password) && $user->auth($userRealPassword)) {
    header("Location: index.php");
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/lagona/templates/auth/top.html';

if (isset($_POST['login'])) {
    if (!$db->checkExistingUser($_POST['login'])) {
        Printer::wrongLogin();
    }
}

Printer::passwordInput();

if (isset($_POST['password'])) {
    Printer::wrongPassword();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/lagona/templates/auth/buttons.html';

if (!isset($_GET['update_password'])) {
    Printer::forgotPassword();
} ?>

</div>
</form>
</main>
</body>
</html>


