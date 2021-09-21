<?php
require_once dirname(__FILE__) . '/classes/User.php';
require_once dirname(__FILE__) . '/classes/Database.php';

$db = new Db();
$user = new User();

require_once $_SERVER["DOCUMENT_ROOT"] . '/lagona/templates/register.html';