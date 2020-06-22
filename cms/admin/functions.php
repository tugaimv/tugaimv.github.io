<?php

function confirmQuery($result)
{
    global $connection;

    if (!$result) {
        die("QUERY FAILED ." . mysqli_error($connection));
    }

    return $result;
}

function insertCategories()
{
    global $connection;
    //Add category logic
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['category_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo "This field not be empty";
        } else {
            $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);
            if (!$create_category_query) {
                die('QUERY FAILED' . mysqli_error($connection));
            }
        }
    }
}

function getAllCategroies()
{
    global $connection;
    $query = 'SELECT * FROM categories';
    $query_exec = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_exec)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr><td>{$cat_id}</td><td>{$cat_title}</td><td><a href='categories.php?delete={$cat_id}'>Delete</a></td><td><a href='categories.php?edit={$cat_id}'>Edit</a></td></tr>";
    }
}

function deleteCategory()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $cat_id_for_delete = $_GET['delete'];
        $query = "DELETE from categories where cat_id = {$cat_id_for_delete}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: categories.php");
    }
}
