<?php
if (isset($_GET['p_id'])) {
  $post_id = $_GET['p_id'];

  $query = "SELECT * from posts where post_id = {$post_id}";
  $select_posts = mysqli_query($connection, $query);
  while ($row = mysqli_fetch_assoc($select_posts)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
  }

  if(isset($_POST['edit_post'])){
    $post_title = $_POST['title'];
    $post_author = $_POST['author'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
  
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
  
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){
      $query = "SELECT * from posts where post_id = {$post_id}";
      $select_image = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($select_image)){
        $post_image = $row['post_image'];
      }
    }

    $query = "UPDATE posts set ";
    $query .= "post_title = '{$post_title}',";
    $query .= "post_category_id = {$post_category_id},";
    $query .= "post_date = now(),";
    $query .= "post_author = '{$post_author}',";
    $query .= "post_status = '{$post_status}',";
    $query .= "post_tags = '{$post_tags}',";
    $query .= "post_content = '{$post_content}',";
    $query .= "post_image = '{$post_image}'";
    $query .= "WHERE post_id = {$post_id}";

    $update_post = mysqli_query($connection, $query);
    confirmQuery($update_post);
  }
}

?>

<form action="" method="post" enctype="multipart/form-data">

  <div class="form-group">
    <label for="title">Post Title</label>
    <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
  </div>

  <div class="form-group">
    <label for="post_category">Post Category</label><br>
    <select name="post_category" id="post_category">
      <?php
      $query = 'SELECT * FROM categories';
      $query_exec = mysqli_query($connection, $query);
      confirmQuery($query_exec);
      while ($row = mysqli_fetch_assoc($query_exec)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<option value='{$cat_id}'>{$cat_title}</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="author">Post Author</label>
    <input value="<?php echo $post_author; ?>" type="text" class="form-control" name="author">
  </div>

  <div class="form-group">
    <label for="post_status">Post Status</label>
    <input value="<?php echo $post_status; ?>" type="text" class="form-control" name="post_status">
  </div>

  <div class="form-group">
    <label for="post_image">Post Image</label><br>
    <img name="post_image" width="100px" src="../images/<?php echo $post_image; ?>" alt=""><br>
    <input type="file" name="image">
  </div>

  <div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
  </div>

  <div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea name="post_content" id="" cols="30" rows="10" class="form-control"><?php echo $post_content; ?>
    </textarea>
  </div>



  <div class="form-group">
    <input type="submit" class="bnt btn-primary" name="edit_post" value="Publish Post">
  </div>
</form>