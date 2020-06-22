<?php
//Delete post logic
if (isset($_GET['delete'])) {
  $the_post_id = $_GET['delete'];
  $query = "DELETE from posts WHERE post_id = {$the_post_id}";
  $delete_query = mysqli_query($connection, $query);
}
?>
<table class="table table-bordered table-hover">
  <thead>
    <tr>
      <td>Id</td>
      <td>Author</td>
      <td>Title</td>
      <td>Category</td>
      <td>Status</td>
      <td>Image</td>
      <td>Tags</td>
      <td>Comments</td>
      <td>Date</td>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "select * from posts";
    $select_posts = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_posts)) {
      $post_id = $row['post_id'];
      $post_author = $row['post_author'];
      $post_title = $row['post_title'];
      $post_category_id = $row['post_category_id'];
      $post_status = $row['post_status'];
      $post_image = $row['post_image'];
      $post_tags = $row['post_tags'];
      $post_comment_count = $row['post_comment_count'];
      $post_date = $row['post_date'];

      echo "<tr>
              <td>{$post_id}</td>
              <td>{$post_author}</td>
              <td>{$post_title}</td>
              <td>{$post_category_id}</td>
              <td>{$post_status}</td>
              <td><img width='100px' src='../images/{$post_image}' alt='image'/></td>
              <td>{$post_tags}</td>
              <td>{$post_comments_count}</td>
              <td>{$post_date}</td>
              <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
              <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
            </tr>";
    }
    ?>
  </tbody>
</table>