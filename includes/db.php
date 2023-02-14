<?php
if (!defined('DB_HOST')) define('DB_HOST', $_ENV['MYSQLHOST']);
if (!defined('DB_USER')) define('DB_USER', $_ENV['MYSQLUSER']);
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', $_ENV['MYSQLPASSWORD']);
if (!defined('DB_NAME')) define('DB_NAME', $_ENV['MYSQLDATABASE']);
if (!defined('DB_PORT')) define('DB_PORT', $_ENV['MYSQLPORT']);

$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
