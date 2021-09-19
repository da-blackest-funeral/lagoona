<?php
require_once dirname(__FILE__) . '/classes/User.php';
require_once dirname(__FILE__) . '/classes/Printer.php';

$user = new User();
if (isset($_GET['out']))
    if ($_GET['out'] == 1)
        $user->out();

Printer::index('top');

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth']) {
    Printer::index('is-auth');
} else {
    Printer::index('is-not-auth');
}

Printer::index('header-bottom');
Printer::index('main');
Printer::index('footer');


