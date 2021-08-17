<?php include "db.php";?>
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
    while ($row = mysqli_fetch_array($select_username_query)) {
        echo $db_id = $row['user_firstname'];
    }}