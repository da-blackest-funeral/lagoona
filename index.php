<?php
require_once __DIR__ . '/classes/User.php';

$user = new User();
if (isset($_GET['out']))
    if ($_GET['out'] == 1)
        $user->out();

require_once __DIR__ . '/templates/index.html';