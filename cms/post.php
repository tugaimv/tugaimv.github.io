<!DOCTYPE html>
<html lang="en">

<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<body>

    <!-- Navigation -->
    <?php include 'includes/navigation.php'; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <?php
                if (isset($_GET['p_id'])) {
                    $post_id = $_GET['p_id'];
                    $query_post = "SELECT * FROM posts where post_id = {$post_id}";
                    $query_exec_posts = mysqli_query($connection, $query_post);
                    while ($row = mysqli_fetch_assoc($query_exec_posts)) {
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                    }
                ?>


                    <h1 class="page-header">
                        Page Heading
                        <small>Secondary Text</small>
                    </h1>

                    <!-- First Blog Post -->
                    <h2>
                        <a href="#"><?= $post_title ?></a>
                    </h2>
                    <p class="lead">
                        by <a href="index.php"><?= $post_author ?></a>
                    </p>
                    <p><span class="glyphicon glyphicon-time"></span><?= $post_date ?></p>
                    <hr>
                    <img class="img-responsive" src="images/<?= $post_image ?>" alt="">
                    <hr>
                    <p><?= $post_content ?></p>
                    <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                    <hr>

                    <!-- Blog Comments -->
                    <?php
                    if (isset($_POST['create_comment'])) {
                        $the_post_id = $_GET['p_id'];

                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_content = $_POST['comment_content'];

                        $query = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
                        $query .= "VALUES ($the_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                        $create_comment_query = mysqli_query($connection, $query);

                        if (!$create_comment_query) {
                            die("QUERY FAILED ." . mysqli_error($connection));
                        }

                        $query_update = "UPDATE posts set post_comment_count = post_comment_count + 1 where post_id = {$the_post_id}";
                        $query_update_exec = mysqli_query($connection, $query_update);
                    }
                    ?>
                    <!-- Comments Form -->
                    <div class="well">
                        <h4>Leave a Comment:</h4>
                        <form role="form" action="" method="post">
                            <div class="form-group">
                                <label for="comment_author">Author</label>
                                <input type="text" class="form-control" name="comment_author">
                            </div>
                            <div class="form-group">
                                <label for="comment_email">Email</label>
                                <input type="email" class="form-control" name="comment_email">
                            </div>
                            <div class="form-group">
                                <label for="comment_content">Comment</label>
                                <textarea class="form-control" rows="3" name="comment_content"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="create_comment">Create comment</button>
                        </form>
                    </div>

                    <hr>

                    <!-- Posted Comments -->
                    <?php
                    $post_id = $_GET['p_id'];
                    $query_comment = "SELECT * from comments where comment_post_id = {$post_id} and comment_status = 'approve' order by comment_id desc";
                    $query_comment_exec = mysqli_query($connection, $query_comment);
                    if (!$query_comment_exec) {
                        die("QUERY FAILED ." . mysqli_error($connection));
                    }
                    while ($row = mysqli_fetch_assoc($query_comment_exec)) {
                        $comment_author = $row['comment_author'];
                        $comment_date = $row['comment_date'];
                        $comment_content = $row['comment_content'];


                    ?>
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $comment_author; ?>
                                    <small><?php echo $comment_date; ?></small>
                                </h4>
                                <?php echo $comment_content; ?>
                            </div>
                        </div>

                        <!-- Comment -->


                <?php }
                } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include 'includes/sidebar.php'; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include 'includes/footer.php'; ?>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>