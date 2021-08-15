<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Author</th>
            <th>Comment</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

        <?php

$query = "SELECT * FROM comments";
$select_comments = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_comments)) {
    $comment_id = $row['comment_id'];
    $comment_post_id = $row['post_post_id'];
    $comment_author = $row['comment_author'];
    $comment_email = $row['comment_email'];
    $comment_status = $row['comment_status'];
    $comment_content = $row['comment_content'];
    $comment_date = $row['comment_date'];

    echo "<tr>";
    echo "<td> $comment_id</td>";
    echo "<td> $comment_author</td>";
    echo "<td> $comment_content</td>";

    // $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
    // $select_categories = mysqli_query($connection, $query);
    // while ($row = mysqli_fetch_assoc($select_categories)) {
    //     $cat_title = $row['cat_title'];
    //     $cat_id = $row['cat_id'];
    //     echo "<td> $cat_title</td>";
    // }

    echo "<td> $comment_email</td>";
    echo "<td> $comment_status</td>";
    echo "<td> in response </td>";
    echo "<td> $comment_date</td>";
    echo "<td><a href='posts.php?delete={$post_id}'>Approve</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Unapprove</a></td>";
    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
    echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";

    echo "</tr>";
}
?>
        <?php
// delete categories from db
delete_post();
?>
    </tbody>
</table>