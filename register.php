<?php
require_once __DIR__ . '/classes/User.php';
require_once __DIR__ . '/classes/Database.php';

$db = new Db();
$user = new User();

require_once __DIR__ . '/templates/register.html';