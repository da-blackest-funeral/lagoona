<?php

class Printer
{
    public static function index(string $template)
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/lagona/templates/index/' . $template . '.html';
    }

    public static function wrongLogin()
    {
        echo '<br><strong>Неверный логин!</strong><br>';
    }

    public static function wrongPassword()
    {
        echo '<br><b>Неверный пароль!</b>';
    }

    public static function forgotPassword()
    {
        echo '<a href="?update_password=true"> Forgot password? </a>';
    }

    public static function loginInput()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/lagona/templates/register/forms-1.html';?>
        value="<?php if (isset($_SESSION['login'])) echo $_SESSION['login']; ?>"
        name="login"
        required
        />
        <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/lagona/templates/register/forms-2.html';
    }

    public static function passwordInput()
    { ?>
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
            required/>
    <?php if (isset($_GET['update_password'])) { ?>
        <label for="psw">
            <b>
                New Password
            </b>
        </label>
        <input type="password"
        placeholder="Enter New Password"
        name="new_password"
        required>
    <?php
        }
    }
}