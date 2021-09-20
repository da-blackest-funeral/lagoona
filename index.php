<?php
require_once dirname(__FILE__) . '/classes/User.php';

$user = new User();
if (isset($_GET['out']))
    if ($_GET['out'] == 1)
        $user->out();

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/index/top.html';

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth']) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/index/is-auth.html';
} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/index/is-not-auth.html';
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/index/header-bottom.html';

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/index/main.html';

require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/index/footer.html';


