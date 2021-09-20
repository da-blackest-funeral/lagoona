<?php
require_once dirname(__FILE__) . '/classes/User.php';
require_once dirname(__FILE__) . '/classes/Database.php';

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

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/auth/top.html';

if (isset($_POST['login'])) {
    if (!$db->checkExistingUser($_POST['login'])) { ?>
        <br><strong>Неверный логин!</strong><br>
    <?php }
} ?>

<label for="psw">
    <b>
        <?php
        if (isset($_GET['update_password'])) {
            echo 'Old password';
        } else {
            echo 'Enter password';
        } ?>
    </b>
</label>
<input
        type="password"
        placeholder="<?php
        if (isset($_GET['update_password'])) {
            echo 'Enter Old password';
        } else {
            echo 'Enter password';
        } ?>"
        name="password"
        required
/>

<?php
if (isset($_GET['update_password'])) { ?>
    <b> New Password </b>
    <input
            type="password"
            placeholder="Enter New Password"
            name="new_password"
            required/>

    <?php
    if (!$user->isAuth()) { ?>
        <br>
        <b>Неверный пароль!</b>
    <?php }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/auth/buttons.html';

if (!isset($_GET['update_password'])) { ?>
    <a href="?update_password=true"> Forgot password? </a>
<?php } ?>

</div>
</form>
</main>
</body>
</html>


