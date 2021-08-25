<?php
if ($_SESSION['user_role'] == 'admin') {

    ?>
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
      <th>Edit</th>
      <th>Delete</th>
      <th>Change Role</th>


    </tr>
  </thead>
  <tbody>

    <?php

    $query = "SELECT * FROM users";
    $select_user = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($select_user)) {
        $user_id = escape($row['user_id']);
        $username = escape($row['username']);
        $user_firstname = escape($row['user_firstname']);
        $user_lastname = escape($row['user_lastname']);
        $user_email = escape($row['user_email']);
        $user_role = escape($row['user_role']);
        $user_image = escape($row['user_image']);

        if ($username != $_SESSION['username']) {

            echo "<tr>";
            echo "<td> $user_id</td>";
            echo "<td><img src='../users_images/$user_image' width='50' </td>";
            echo "<td> $username</td>";
            echo "<td> $user_firstname</td>";
            echo "<td> $user_lastname</td>";
            echo "<td> $user_email</td>";
            echo "<td> $user_role</td>";
            echo "<td><a href='users.php?source=edit_user&edit_user=$user_id'>Edit</a></td>";
            echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
            echo "<td><a href='users.php?to_admin=$user_id'>Admin</a> <br>";
            echo "<a href='users.php?to_subs=$user_id'>Subscriber</a></td>";

            echo "</tr>";
        }
    }
    ?>
    <?php

// change role to admin
    if (isset($_GET['to_admin'])) {
        $the_user_id = escape($_GET['to_admin']);

        $query = "UPDATE users SET user_role  = 'admin' WHERE user_id = $the_user_id ";

        $change_to_admin_query = mysqli_query($connection, $query);
        // refraiche the page , to show data after changing role to admin
        header("Location: users.php");
        confirm($change_to_admin_query);
    }
// change role to subscriber
    if (isset($_GET['to_subs'])) {
        $the_user_id = escape($_GET['to_subs']);

        $query = "UPDATE users SET user_role  = 'subscriber' WHERE user_id = $the_user_id ";

        $change_to_subs_query = mysqli_query($connection, $query);
        // refraiche the page , to show data after changing role to subscriber
        header("Location: users.php");
        confirm($change_to_subs_query);
    }

// delete user from db

    if (isset($_GET['delete'])) {

        $the_user_id = escape($_GET['delete']);

        $query = "DELETE FROM users WHERE user_id = {$the_user_id}";

        $delete_user_query = mysqli_query($connection, $query);

        // refraiche the page , to show data after deleting a user
        header("Location: users.php");

        confirm($delete_user_query);}
    ?>

  </tbody>
</table>
<?php
} else {
    echo "You cant See This Page";
}
?>