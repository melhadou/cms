<?php include "db.php";?>
<?php session_start();?>
<?php
function loginuser($username, $password)
{
    global $connection;
    $query = "SELECT * FROM users WHERE username = '{$username}' ";

    $select_username_query = mysqli_query($connection, $query);
    if (!$select_username_query) {
        die("QEURY FAILD " . mysqli_error($connection));
    }
    while ($row = mysqli_fetch_assoc($select_username_query)) {
        $db_user_id = mysqli_real_escape_string($connection, $row['user_id']);
        $db_username = mysqli_real_escape_string($connection, $row['username']);
        $db_user_password = mysqli_real_escape_string($connection, $row['user_password']);
        $db_user_firstname = mysqli_real_escape_string($connection, $row['user_firstname']);
        $db_user_lastname = mysqli_real_escape_string($connection, $row['user_lastname']);
        $db_user_email = mysqli_real_escape_string($connection, $row['user_email']);
        $db_user_role = mysqli_real_escape_string($connection, $row['user_role']);
    }

    if (password_verify($password, $db_user_password)) {

        $_SESSION['username'] = mysqli_real_escape_string($connection, $db_username);
        $_SESSION['firstname'] = mysqli_real_escape_string($connection, $db_user_firstname);
        $_SESSION['lastname'] = mysqli_real_escape_string($connection, $db_user_lastname);
        $_SESSION['user_role'] = mysqli_real_escape_string($connection, $db_user_role);

        header("Location: ../admin");
    } else {header("Location: ../index.php");
    }
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $username = mysqli_real_escape_string($connection, trim($username));
    $password = mysqli_real_escape_string($connection, trim($password));
    loginuser($username, $password);
}