<?php
if (isset($_GET['edit_user'])) {
  $the_user_id = $_GET['edit_user'];
  $query = "SELECT * FROM users where user_id = {$the_user_id}";
  $select_user = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($select_user)) {
    $user_firstname_data = $row['user_firstname'];
    $user_lastname_data = $row['user_lastname'];
    $user_role_data = $row['user_role'];
    $username_data = $row['username'];
    $user_email_data = $row['user_email'];
    $user_password_data = $row['user_password'];
  }
}

if (isset($_POST['edit_user'])) {
  $the_user_id = $_GET['edit_user'];
  $user_firstname = $_POST['user_firstname'];
  $user_lastname = $_POST['user_lastname'];
  $user_role = $_POST['user_role'];
  $username = $_POST['username'];
  $user_email = $_POST['user_email'];
  $user_password = $_POST['user_password'];


  $query = "UPDATE users set user_firstname = '{$user_firstname}',";
  $query .= "user_lastname = '{$user_lastname}',";
  $query .= "user_role = '{$user_role}',";
  $query .= "username = '{$username}',";
  $query .= "user_email = '{$user_email}',";
  $query .= "user_password = '{$user_password}'";
  $query .= "where user_id = '{$the_user_id}'";


  $edit_user = mysqli_query($connection, $query);

  confirmQuery($edit_user);

  header('Location: users.php');
}
?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="user_firstname">Firstname</label>
    <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname_data; ?>">
  </div>

  <div class="form-group">
    <label for="user_lastname">Lastname</label>
    <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname_data; ?>">
  </div>

  <div class="form-group">
    <label for="user_role">User role</label><br>
    <select name="user_role" id="user_role">
      <option value="<?php echo $user_role_data; ?>"><?php echo ucwords($user_role_data); ?></option>
      <?php
      if ($user_role_data == 'subscriber') {
        echo "<option value='admin'>Admin</option>";
      } else {
        echo "<option value='subscriber'>Subscriber</option>";
      }
      ?>
    </select>
  </div>


  <!-- <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
  </div> -->

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" name="username" value="<?php echo $username_data; ?>">
  </div>

  <div class="form-group">
    <label for="user_email">Email</label>
    <input type="email" class="form-control" name="user_email" value="<?php echo $user_email_data; ?>">
  </div>

  <div class="form-group">
    <label for="user_password">Password</label>
    <input type="text" class="form-control" name="user_password" value="<?php echo $user_password_data; ?>">
  </div>

  <div class="form-group">
    <input type="submit" class="bnt btn-primary" name="edit_user" value="Edit user">
  </div>
</form>