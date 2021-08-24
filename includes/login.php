<?php include "db.php";?>
<?php session_start();?>
<?php

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $password);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_username_query = mysqli_query($connection, $query);
    if (!$select_username_query) {
        die("QEURY FAILD " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($select_username_query)) {
        $db_user_id = escape($row['user_id']);
        $db_username = escape($row['username']);
        $db_user_password = escape($row['user_password']);
        $db_user_firstname = escape($row['user_firstname']);
        $db_user_lastname = escape($row['user_lastname']);
        $db_user_email = escape($row['user_email']);
        $db_user_role = escape($row['user_role']);
    }}

if (password_verify($password, $db_user_password)) {

    $_SESSION['username'] = escape($db_username);
    $_SESSION['firstname'] = escape($db_user_firstname);
    $_SESSION['lastname'] = escape($db_user_lastname);
    $_SESSION['user_role'] = escape($db_user_role);

    header("Location: ../admin");
} else {header("Location: ../index.php");}