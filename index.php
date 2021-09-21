<?php
require_once dirname(__FILE__) . '/classes/User.php';

$user = new User();
if (isset($_GET['out']))
    if ($_GET['out'] == 1)
        $user->out();

require_once $_SERVER['DOCUMENT_ROOT'] . '/lagona/templates/index.html';