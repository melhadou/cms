<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>User Image</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Delete</th>


        </tr>
    </thead>
    <tbody>

        <?php

$query = "SELECT * FROM users";
$select_user = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($select_user)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
    $user_image = $row['user_image'];

    echo "<tr>";
    echo "<td> $user_id</td>";
    echo "<td><img src='../users_images/$user_image' width='50' </td>";
    echo "<td> $username</td>";
    echo "<td> $user_firstname</td>";
    echo "<td> $user_lastname</td>";
    echo "<td> $user_email</td>";
    echo "<td> $user_role</td>";
    echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";

    echo "</tr>";
}
?>
        <?php

// unapprove comments
if (isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];

    $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id ";

    $unapprove_comment_query = mysqli_query($connection, $query);
    // refraiche the page , to show data after unapproving a comment
    header("Location: comments.php");
    confirm($unapprove_comment_query);
}
// approve comments
if (isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];

    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";

    $approve_comment_query = mysqli_query($connection, $query);
    // refraiche the page , to show data after approving a comment
    header("Location: comments.php");
    confirm($approve_comment_query);
}

// delete user from db

if (isset($_GET['delete'])) {

    $the_user_id = $_GET['delete'];

    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";

    $delete_user_query = mysqli_query($connection, $query);

    // refraiche the page , to show data after deleting a user
    header("Location: users.php");

    confirm($delete_user_query);}
?>

    </tbody>
</table>