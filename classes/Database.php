<?php

class Db extends PDO
{

    /**
     * Думаю, что стоит вынести эти значения в отдельный файл config.php
     */

    private $hostname = 'localhost';
    private $dbusername = 'root';
    private $dbpass = '';
    private $dbname = 'authtest';
    private $table = 'authinfo';
    private $dsn;

    // Array of options for __construct() method
    const OPTIONS = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public function __construct()
    {
        $this->dsn = "mysql:host=$this->hostname;dbname=$this->dbname;";
        parent::__construct($this->dsn, $this->dbusername, $this->dbpass, $this::OPTIONS);
    }

    /* создать метод updateUserPassword($login) */

    // Функция, записывающая логин и пароль пользователя в базу данных
    public function doInserting(User $user)
    {
        $querry = $this->prepare("INSERT INTO authinfo (login, password) VALUES (:login, :password)");

        // Querry
        $querry->execute([
            'login' => $user->login,
            'password' => password_hash($user->password, PASSWORD_DEFAULT)
        ]);
    }

    /**
     *  Функция проверяет, существует ли пользователь
     *  по заданному логину
     */
    public function checkExistingUser(string $login)
    {
        $querry = $this->prepare("SELECT * FROM authinfo WHERE login=?");
        $querry->execute([$login]);

        return !empty($querry->fetch());
    }

    /**
     *  Функция возвращает пароль уже зарегистрированного
     *  пользователя из базы данных
     */

    public function updateUserPassword(string $login, string $newPassword)
    {
        $querry = $this->prepare("UPDATE authinfo SET password =:password WHERE login=:login");
        $querry->execute([
            'login' => $login,
            'password' => password_hash($newPassword, PASSWORD_DEFAULT)
        ]);
    }

    /**
     *
     * */

    public function getUserPassword(string $login)
    {
        $querry = $this->prepare("SELECT password FROM authinfo WHERE login=?");
        $querry->execute([$login]);

        if ($this->checkExistingUser($login)) {
            return $querry->fetchAll()[0]["password"];
        }
    }
}
