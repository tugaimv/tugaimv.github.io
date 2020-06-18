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
                            $query_post = 'SELECT * FROM posts';
                            $query_exec_posts = mysqli_query($connection, $query_post);
                            while ($row = mysqli_fetch_assoc($query_exec_posts)){
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_image = $row['post_image'];
                                $post_content = $row['post_content'];
                        ?>

        
                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>
        
                        <!-- First Blog Post -->
                        <h2>
                            <a href="#"><?=$post_title?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?=$post_author?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span><?=$post_date?></p>
                        <hr>
                        <img class="img-responsive" src="images/<?=$post_image?>" alt="">
                        <hr>
                        <p><?=$post_content?></p>
                        <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
        
                        <hr>

                        <?php } ?>
        
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
