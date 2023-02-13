<?php
session_start();
//delete session
$_SESSION['username'] = null;
$_SESSION['first_name'] = null;
$_SESSION['role'] = null;
$_SESSION['email'] = null;
$_SESSION['id'] = null;

header("Location: index.php");
