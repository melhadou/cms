<?php
include "../includes/db.php";

/************ escape data befor sedning it to db ******* */
function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
/************ confirm the query  ************ */
function confirm($result)
{
    global $connection;
    if (!$result) {
        return die("QUERY FAILED" . mysqli_error($connection));
    }

}
/*********** redirecting to specfique url *********** */
function redirect($url)
{
    global $connection;
    header("Location: $url");
}
/******** insert category to db ******* */
function insert_categories()
{if (isset($_SESSION['user_role'])) {

    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST[('cat_title')];

        if ($cat_title == "" || empty($cat_title)) {
            echo "You need to Type Somthing";
        } else {
            $stmt = mysqli_prepare($connection, "INSERT INTO categories(cat_title) VALUE(?)");
            mysqli_stmt_bind_param($stmt, 's', $cat_title);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

        }
    }
}
}
/****  delete category from db ********** */
function delete_cat()
{if (isset($_SESSION['user_role'])) {

    global $connection;
    if (isset($_GET['delete'])) {

        $the_cat_id = escape($_GET['delete']);

        $stmt = mysqli_prepare($connection, "DELETE FROM categories WHERE cat_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $the_cat_id);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        // refraiche the page , to show data after deleting categories
        redirect("categories.php");

    }
}
}

/************ show catgeory from db ********* */
function FindAllCategories()
{if (isset($_SESSION['user_role'])) {
    global $connection;

    $query = "SELECT cat_title,cat_id FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = escape($row['cat_title']);
        $cat_id = escape($row['cat_id']);
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }
    confirm($select_categories);}

}
/************* delete post from db*********** */
function delete_post()
{if (isset($_SESSION['user_role'])) {
    global $connection;
    if (isset($_POST['delete'])) {

        $the_post_id = escape($_POST['post_id']);

        $stmt = mysqli_prepare($connection, "DELETE FROM posts WHERE post_id = ?");
        mysqli_stmt_bind_param($stmt, 'i', $the_post_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        // refraiche the page , to show data after deleting a post
        redirect("posts.php");
    }
}
}

/******* show categorys ********* */
function showCategories()
{if (isset($_SESSION['user_role'])) {
    global $connection;
    $query = "SELECT * FROM categories ";
    $select_categories = mysqli_query($connection, $query);
    confirm($select_categories);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = escape($row['cat_title']);
        $cat_id = escape($row['cat_id']);
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
    }
}
}

// give table name   . and return how much data is there , exemple: count posts .
function counter($table_name)
{
    global $connection;
    $query = "SELECT * FROM {$table_name}";
    $send_query = mysqli_query($connection, $query);
    $result_count = mysqli_num_rows($send_query);
    return $result_count;
}

/******** check how much users are online ****** */
function users_online()
{

    global $connection;

    $session = session_id();
    $time = time();
    $time_out_in_seconds = 05;
    $time_out = $time - $time_out_in_seconds;

    $query = "SELECT * FROM users_online WHERE session = '$session'";
    $send_query = mysqli_query($connection, $query);
    $count = mysqli_num_rows($send_query);

    if ($count == null) {
        mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session','$time')");
    } else {
        mysqli_query($connection, "UPDATE users_online SET time = '$time' WHERE session = '$session'");

    }
    $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
    $count_users = mysqli_num_rows($users_online_query);
    return $count_users;

}
/****** get how much of passed argument exist in db ********** */
function comment_counter($comment_post_id)
{
    global $connection;

    $query = "SELECT * FROM comments WHERE comment_post_id = {$comment_post_id}";
    $comment_counter_query = mysqli_query($connection, $query);
    $comment_count = escape(mysqli_num_rows($comment_counter_query));
    return $comment_count;
}

/********** CODE FOR INDEX PAGE********* */
function checkStatus($table, $table_column, $table_column_data)
{
    global $connection;
    $qeury = "SELECT * FROM $table WHERE $table_column = '$table_column_data'";
    $check_posts_query = mysqli_query($connection, $qeury);
    $posts_count = escape(mysqli_num_rows($check_posts_query));
    return $posts_count;
}
/********* check if password is strong ****** */
function checkPassword($pwd)
{

    if (strlen($pwd) < 8) {
        $errors = error_type("Password too short!");
    }

    if (!preg_match("#[0-9]+#", $pwd)) {
        $errors = error_type("Password must include at least one number!");
    }

    if (!preg_match("#[a-zA-Z]+#", $pwd)) {
        $errors = error_type("Password must include at least one letter!");
    }

    return $errors;
}

/****** check email is valid *********** */
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL)
    && preg_match('/@.+\./', $email);
}

/*************** check if user is admin *************** */
function isAdmin($username)
{
    global $connection;
    $query = "SELECT user_role FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($result);
    if ($row['user_role'] == 'admin') {
        return true;
    } else {
        return false;
    }
}

/********** check if user exist ********/
function isUserExist($user)
{
    global $connection;
    $query = "SELECT username FROM users WHERE username = '$user'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

/********** check if email exist ********/
function isEmailExist($email)
{
    global $connection;
    $query = "SELECT user_email FROM users WHERE user_email = '$email'";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) > 0) {
        return true;
    } else {
        return false;
    }
}

/************* show errot typee in registration page ***************/
function error_type($msg)
{
    return "<script>
              function notempthy() {
                            const pp = document.querySelector('#error');
                            pp.innerText = '$msg';}
                            function clearFeilds(){
                          const username =  document.querySelector('#username');
                          const pp = document.querySelector('#error');
                           username.addEventListener('keydown',()=>{
                              pp.innerText = '';
                            })}

                  </script>";
}

/*****************register users ***********************/
function signup($username, $user_password, $user_firstname, $user_lastname, $user_email)
{
    global $connection;

    //Escapes special characters in a string for use in an SQL statement

    $username = escape($_POST['username']);
    $user_email = escape($_POST['email']);
    $user_password = escape($_POST['password']);
    $user_firstname = escape($_POST['user_firstname']);
    $user_lastname = escape($_POST['user_lastname']);
    //crypt password
    $user_password = password_hash($user_password, PASSWORD_BCRYPT, array("cost" => 12));
    if (!isUserExist($username)) {
        if (!isEmailExist($user_email)) {

            $query = "INSERT INTO users (username,user_password,user_email,user_role,user_firstname,user_lastname,user_image) ";
            $query .= "VALUES('{$username}' , '{$user_password}' , '{$user_email}' ,'subscriber', '{$user_firstname}', '{$user_lastname}', 'user_default_image.png') ";

            $register_user_query = mysqli_query($connection, $query);
            if (!$register_user_query) {
                die("QUERY FAILD" . mysqli_error($connection));
            }
            $meassage = "you successfully registered wait for admin approval";
        } else {
            echo error_type('This email Exist , try another one');
        }
    } else {
        echo error_type('This username Exist , try another one');

    }
}

/**************** login users ************** */