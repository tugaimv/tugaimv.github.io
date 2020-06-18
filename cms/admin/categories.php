<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<?php include 'functions.php'; ?>
<?php include '../includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include 'includes/navigation.php'; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to admin
                            <small>Author</small>
                        </h1>

                        <div class="col-xs-6">
                            <?php insertCategories(); ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="category_title">Add Category</label>
                                    <input type="text" class="form-control" name="category_title">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category">
                                </div>
                            </form>
                            <?php  
                            // Show edit form if button edit clicked
                                if(isset($_GET['edit'])){
                                    $cat_id = $_GET['edit'];
                                    $query_get_by_id_category = "SELECT * FROM categories where cat_id = {$cat_id}";
                                    $query_get_by_id_category_exec = mysqli_query($connection, $query_get_by_id_category);
                                        while ($row = mysqli_fetch_assoc($query_get_by_id_category_exec)){
                                            $cat_title = $row['cat_title'];
                            ?>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="category_update">Edit Category</label>
                                        <input type="text" class="form-control" name="category_update" value="<?php if(isset($cat_title)){echo $cat_title;} ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" name="submit_edit" value="Edit Category">
                                    </div>
                                </form>
                                            
                            <?php } } ?>
                            
                            <?php include 'includes/edit_category.php'; ?>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        //Display categories in table
                                        getAllCategroies();
                                        //Delete category logic
                                        deleteCategory();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include 'includes/footer.php'; ?>

</body>

</html>
