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
      <td>Comment</td>
      <td>Email</td>
      <td>Status</td>
      <td>In response to</td>
      <td>Date</td>
      <td>Approve</td>
      <td>Unapprove</td>
      <td>Delete</td>
    </tr>
  </thead>
  <tbody>
    <?php
    $query = "select * from comments";
    $select_comments = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($select_comments)) {
      $comment_id = $row['comment_id'];
      $comment_post_id = $row['comment_post_id'];
      $comment_author = $row['comment_author'];
      $comment_email = $row['comment_email'];
      $comment_content = $row['comment_content'];
      $comment_status = $row['comment_status'];
      $comment_date = $row['comment_date'];
 

        $query_select_post = "select * from categories where cat_id = {$post_category_id}";
        $select_category = mysqli_query($connection, $query_select_post);
        while ($row = mysqli_fetch_assoc($select_category)){
          $cat_title = $row['cat_title'];
          $cat_id = $row['cat_id'];
        }

      echo "<tr>
              <td>{$comment_id}</td>
              <td>{$comment_author}</td>
              <td>{$comment_content}</td>
              <td>{$comment_email}</td>
              <td>{$comment_status}</td>
              <td>{$comment_date}</td>
              <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Aprrove</a></td>
              <td><a href='posts.php?delete={$post_id}'>Unapprove</a></td>
              <td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>
              <td><a href='posts.php?delete={$post_id}'>Delete</a></td>
            </tr>";
    }
    ?>
  </tbody>
</table>