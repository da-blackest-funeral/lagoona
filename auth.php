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

?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" href="css/auth.css" />
    <title>Authentication</title>
  </head>
  <body>
    <main class="main">
      <div class="form__container">
      <form action="auth.php" method="post">
        <div class="imgcontainer">
          <img src="img/img_avatar2.png" alt="Avatar" class="avatar" />
        </div>

        <div class="container">
          <label for="login">
            <b> Login </b>
          </label>
          <input
            type="text"
            placeholder="Enter Login"
            name= "login"
            required
          />

          <?php
            if (isset($_POST['login'])) {
              if (!$db->checkExistingUser($_POST['login'])) { ?>
                <br><strong>Неверный логин!<strong/><br>
          <?php }
            }  ?>
            
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
	              required />

		      <?php } 
            if (isset($user->password)) { 
              if ($user->auth($userRealPassword)) { 
                header("Location: index.php");
    	        } else { ?>
                <br>
                <b>Неверный пароль!</b>
          <?php }
            } ?>

          <button type="submit">Login</button>
        </div>
        <div class="container" style="background-color: #f1f1f1">
          <button type="button"
            class="cancelbtn"
            onclick="location.href='index.php'">Cancel
          </button>
          <?php if (!isset($_GET['update_password'])) { ?>
            <a href="?update_password=true"> Forgot password? </a>
          <?php } ?>
        </div>
      </form>
    </main>
  </body>
</html>


