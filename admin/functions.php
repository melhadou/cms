<?php
include "../includes/db.php";

function insert_categories()
{
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST[('cat_title')];

        if ($cat_title == "" || empty($cat_title)) {
            echo "You need to Type Somthing";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";

            $creat_cat_query = mysqli_query($connection, $query);
            if (!$creat_cat_query) {
                die("QUERY FAILED" . mysqli_error($connection));
            }
        }
    }

}

function delete_cat()
{
    global $connection;
    if (isset($_GET['delete'])) {

        $the_cat_id = $_GET['delete'];

        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";

        $delete_query = mysqli_query($connection, $query);

        // refraiche the page , to show data after deleting categories
        header("Location: categories.php");

        if (!$delete_query) {
            die("QUERY FAILED" . mysqli_error($connection));
        }
    }

}

function FindAllCategories()
{
    global $connection;
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_categories)) {
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "</tr>";

    }

}