<?php
include "../includes/db.php";

function escape($string)
{
    global $connection;
    return mysqli_real_escape_string($connection, trim($string));
}
function confirm($result)
{
    global $connection;
    if (!$result) {
        return die("QUERY FAILED" . mysqli_error($connection));
    }

}
function insert_categories()
{if (isset($_SESSION['user_role'])) {

    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = escape($_POST[('cat_title')]);

        if ($cat_title == "" || empty($cat_title)) {
            echo "You need to Type Somthing";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";

            $creat_cat_query = mysqli_query($connection, $query);
            confirm($creat_cat_query);
        }
    }
}
}

function delete_cat()
{if (isset($_SESSION['user_role'])) {

    global $connection;
    if (isset($_GET['delete'])) {

        $the_cat_id = escape($_GET['delete']);

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

        $delete_query = mysqli_query($connection, $query);

        // refraiche the page , to show data after deleting categories
        header("Location: categories.php");

        confirm($delete_query);
    }
}
}

function FindAllCategories()
{if (isset($_SESSION['user_role'])) {
    global $connection;
    $query = "SELECT * FROM categories";
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
function delete_post()
{if (isset($_SESSION['user_role'])) {
    global $connection;
    if (isset($_GET['delete'])) {

        $the_post_id = escape($_GET['delete']);

        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";

        $delete_query = mysqli_query($connection, $query);

        // refraiche the page , to show data after deleting a post
        header("Location: posts.php");

        confirm($delete_query);
    }
}
}

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

function users_online()
{

    global $connection;

    $session = session_id();

    $time = time();
    $time_out_in_seconds = 30;
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

function comment_counter($comment_post_id)
{
    global $connection;

    $query = "SELECT * FROM comments WHERE comment_post_id = {$comment_post_id}";
    $comment_counter_query = mysqli_query($connection, $query);
    $comment_count = escape(mysqli_num_rows($comment_counter_query));
    return $comment_count;
}