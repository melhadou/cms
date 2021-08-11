<?php

function insert_categories()
{

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