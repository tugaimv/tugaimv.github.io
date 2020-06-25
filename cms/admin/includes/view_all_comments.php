<?php
//Delete post logic
if (isset($_GET['delete'])) {
  $the_comment_id = $_GET['delete'];
  $query = "DELETE from comments WHERE comment_id = {$the_comment_id}";
  $delete_query = mysqli_query($connection, $query);
}
// Approve
if(isset($_GET['approve'])){
  $comment_id = $_GET['approve'];
  $query = "UPDATE comments set comment_status = 'approve' WHERE comment_id = {$comment_id}";
  $update_query = mysqli_query($connection, $query);
}
// Unapprove
if(isset($_GET['unapprove'])){
  $comment_id = $_GET['unapprove'];
  $query = "UPDATE comments set comment_status = 'unapprove' WHERE comment_id = {$comment_id}";
  $update_query = mysqli_query($connection, $query);
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
 

        $query_select_post = "select * from posts where post_id = {$comment_post_id}";
        $select_post = mysqli_query($connection, $query_select_post);
        while ($row = mysqli_fetch_assoc($select_post)){
          $post_title = $row['post_title'];
          $post_id = $row['post_id'];
        }

      echo "<tr>
              <td>{$comment_id}</td>
              <td>{$comment_author}</td>
              <td>{$comment_content}</td>
              <td>{$comment_email}</td>
              <td>{$comment_status}</td>
              <td><a href='../post.php?p_id={$post_id}'>{$post_title}</a></td>
              <td>{$comment_date}</td>
              <td><a href='comments.php?approve={$comment_id}'>Aprrove</a></td>
              <td><a href='comments.php?unapprove={$comment_id}'>Unapprove</a></td>
              <td><a href='comments.php?delete={$comment_id}'>Delete</a></td>
            </tr>";
    }
    ?>
  </tbody>
</table>