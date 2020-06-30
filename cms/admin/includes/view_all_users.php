<?php
//Delete post logic
if (isset($_GET['delete'])) {
  $the_user_id = $_GET['delete'];
  $query = "DELETE from users WHERE user_id = {$the_user_id}";
  $delete_query = mysqli_query($connection, $query);
}
// change to admin
if (isset($_GET['change_to_admin'])) {
  $user_id = $_GET['change_to_admin'];
  $query = "UPDATE users set user_role = 'admin' WHERE user_id = {$user_id}";
  $update_query = mysqli_query($connection, $query);
}
// change to sub
if (isset($_GET['change_to_sub'])) {
  $user_id = $_GET['change_to_sub'];
  $query = "UPDATE users set user_role = 'subscriber' WHERE user_id = {$user_id}";
  $update_query = mysqli_query($connection, $query);
}
?>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <td>Id</td>
      <td>Username</td>
      <td>Firstname</td>
      <td>Lastname</td>
      <td>Email</td>
      <td>Role</td>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "select * from users";
    $select_users = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_users)) {
      $user_id = $row['user_id'];
      $username = $row['username'];
      $user_password = $row['user_password'];
      $user_firstname = $row['user_firstname'];
      $user_lastname = $row['user_lastname'];
      $user_email = $row['user_email'];
      $user_image = $row['user_image'];
      $user_role = $row['user_role'];

      // $query_select_post = "select * from categories where cat_id = {$post_category_id}";
      // $select_category = mysqli_query($connection, $query_select_post);
      // while ($row = mysqli_fetch_assoc($select_category)) {
      //   $cat_title = $row['cat_title'];
      //   $cat_id = $row['cat_id'];
      // }

      echo "<tr>
              <td>{$user_id}</td>
              <td>{$username}</td>
              <td>{$user_firstname}</td>
              <td>{$user_lastname}</td>
              <td>{$user_email}</td>
              <td>{$user_role}</td>
              <td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>
              <td><a href='users.php?change_to_sub={$user_id}'>Subscriber</a></td>
              <td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>
              <td><a href='users.php?delete={$user_id}'>Delete</a></td>
            </tr>";
    }
    ?>
  </tbody>
</table>