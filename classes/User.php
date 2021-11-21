<?php
session_start();

class User {

	private $login;
	private $password;

	public function __construct() {

		if (isset($_POST['login'])) {
			$this->login = $_POST['login'];
		}

		if (isset($_POST['password'])) {
			$this->password = $_POST['password'];
		}
	}

	/**
     * Проверяет, авторизован ли пользователь
     * @return boolean 
     */
    public function isAuth() {
        return $_SESSION["is_auth"] ?? false;
    }

    /**
     * Создание сессии и авторизация пользователя
     * @param string $userRealPassword - хешированный пароль
     * пользователя
     */
    public function auth(string $userRealPassword = NULL) {
        if (isset($userRealPassword)) {
            if (password_verify($this->password, $userRealPassword)) {
                $_SESSION["is_auth"] = true; // Делаем пользователя авторизованным
                $_SESSION["login"] = $this->login; // Записываем в сессию логин пользователя
                return true;
            } else {
                $_SESSION["is_auth"] = false;
                return false; 
            }
        } else {
            $_SESSION["is_auth"] = true; 
            $_SESSION["login"] = $this->login;
        }
    }
     
    /**
     * @return string
     */
    public function getLogin() {
        if ($this->isAuth()) { 
            return $_SESSION["login"];
        }
    }

    /**
     * Завершает сессию
     */
    public function out() {
        $_SESSION = array(); 
        session_destroy(); 
    }
}
