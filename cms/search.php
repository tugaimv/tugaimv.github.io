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

                            if(isset($_POST['submit'])){
                                $search = $_POST['search'];
                                $search_query = "SELECT * FROM posts where post_tags like '%$search%'";
                                $search_query_exec = mysqli_query($connection, $search_query);
                                if(!$search_query_exec){
                                    die("QUERY FAILED" . mysqli_error($connection));
                                } 
                                
                                $count = mysqli_num_rows($search_query_exec);
                                
                                if ($count !== 0){

                                    while ($row = mysqli_fetch_assoc($search_query_exec)){
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
                            <?php }} else {
                                echo "<h1>Ничего не найдено</h1>";
                            }} ?>            
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
