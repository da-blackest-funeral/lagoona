<?php
require_once dirname(__FILE__) . '/classes/User.php';

require_once dirname(__FILE__) . '/classes/Database.php';

$db = new Db();
$user = new User();

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/register/top.html';

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
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/register/forms-1.html' ?>

    value="<?php if (isset($_SESSION['login'])) echo $_SESSION['login']; ?>"

<? require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/register/forms-2.html';

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/register/bottom.html';