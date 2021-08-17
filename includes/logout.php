<?php include "db.php";?>
<?php session_start();?>
<?php

$_SESSION['username'] = null;
$_SESSION['password'] = null;
$_SESSION['firstname'] = null;
$_SESSION['lastname'] = null;
$_SESSION['user_role'] = null;
header("Location: ../index.php");