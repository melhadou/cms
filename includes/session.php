<?php session_start();?>
<?php

if (!isset($_SESSION['user_role'])) {
    header("Location: ../index.php");
} else {
    if ($_SESSION['user_role'] !== 'admin') {
        header("Location: ../index.php");
    }

}