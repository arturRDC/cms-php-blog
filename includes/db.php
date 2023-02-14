<?php
if (!defined('DB_HOST')) define('DB_HOST', 'containers-us-west-58.railway.app');
if (!defined('DB_USER')) define('DB_USER', 'root');
if (!defined('DB_PASSWORD')) define('DB_PASSWORD', 'KuBgU6P5cwgwZVGo1o78');
if (!defined('DB_NAME')) define('DB_NAME', 'railway');
if (!defined('DB_NAME')) define('DB_PORT', '5447');

$dbConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
