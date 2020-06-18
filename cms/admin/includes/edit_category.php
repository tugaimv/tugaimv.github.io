<?php
//Edit category logic
    if(isset($_POST['submit_edit'])){
        if(isset($_POST['category_update'])){
            $cat_id = $_GET['edit'];
            $cat_title = $_POST['category_update'];
            $query_update = "UPDATE categories set cat_title = '{$cat_title}' where cat_id = {$cat_id}";
            $query_update_exec = mysqli_query($connection, $query_update);
            if(!$query_update_exec){
                die("QUERY FAILED" . mysqli_error($connection));
            }

            header("Location: categories.php"); 
        }
    }
?>