<?php
session_start();

class User {

	public $login;
	public $password;

	public function __construct() {

		if (isset($_POST['login'])) {
			$this->login = $_POST['login'];
		}

		if (isset($_POST['password'])) {
			$this->password = $_POST['password'];
		}
	}

	/**
     * Проверяет, авторизован пользователь или нет
     * Возвращает true если авторизован, иначе false
     * @return boolean 
     */
    public function isAuth() {
        if (isset($_SESSION["is_auth"])) { 
            return $_SESSION["is_auth"]; 
        }
        else return false; 
    }

    /**
     * Авторизация пользователя
     * @param string $userRealPassword - хешированный пароль
     * пользователя из базы данных
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
     * Метод возвращает логин авторизованного пользователя 
     */
    public function getLogin() {
        if ($this->isAuth()) { //Если пользователь авторизован
            return $_SESSION["login"]; //Возвращаем логин, который записан в сессию
        }
    }
     
    public function out() {
        $_SESSION = array(); //Очищаем сессию
        session_destroy(); //Уничтожаем
    }

//    public function passwordReset() {
//
//
//    }
}