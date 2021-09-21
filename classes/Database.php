<?php 

class Db extends PDO {

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
  	  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  	  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  	  PDO::ATTR_EMULATE_PREPARES   => false,
	);

	public function __construct() {
		$this->dsn = "mysql:host=$this->hostname;dbname=$this->dbname;";
		parent::__construct($this->dsn, $this->dbusername, $this->dbpass, $this::OPTIONS);
	}

	/* создать метод updateUserPassword($login) */

	// Функция, записывающая логин и пароль пользователя в базу данных 
	public function doInserting(User $user) {
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
     * @param string $login
     * @return bool
	 */
	public function checkIfExists(string $login) {
	 	$query = $this->prepare("SELECT * FROM authinfo WHERE login=?");
	 	$query->execute([$login]);

	 	return !empty($query->fetch());
	} 

	

	public function updatePassword(string $login, string $newPassword) {
		$query = $this->prepare("UPDATE authinfo SET password =:password WHERE login=:login");
	 	$query->execute([
	 		'login' => $login,
			'password' => password_hash($newPassword, PASSWORD_DEFAULT)
	 	]);
	}

    /**
     *  Функция возвращает хешированный пароль уже 
     *  зарегистрированного пользователя из базы данных
     *  @param string $login
     *  @return string
     */
	public function getPassword(string $login) {
		$query = $this->prepare("SELECT password FROM authinfo WHERE login=?");
		$query->execute([$login]);

		if ($this->checkIfExists($login)) {
			return $query->fetchAll()[0]["password"];
		}
	}
}
