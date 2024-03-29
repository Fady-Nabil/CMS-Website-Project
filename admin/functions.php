<?php
function confirm_query($query_result) {
    global $connection;
    if(!$query_result) {
        die('Query Failed'. mysqli_error($connection));
    }
}
function insert_categories() {
    //add category to database
    global $connection;
    if (isset($_POST['submit'])) {
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)) {
            echo "this filed shouldn't be empty";
        }
        else {
            $query = "INSERT INTO categories (cat_title)";
            $query .= "VALUE('{$cat_title}')";
            $create_category_query = mysqli_query($connection, $query);
            if(!$create_category_query) {
                die('Query Failed'. mysqli_error($connection));
            }
        }
    }
}

function find_all_categories() {
    global $connection;
    //find and show all categories query
    $query = "SELECT * FROM categories";
    $select_categories = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_categories)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
            echo "<td>{$cat_id}</td>";
            echo "<td>{$cat_title}</td>";
            echo "<td><a class='btn btn-success btn-xs' href='categories.php?edit={$cat_id}'>Edit</a></td>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" class='btn btn-danger btn-xs' href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function delete_categories() {
    // delete query
    global $connection;
    if(isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM categories WHERE cat_id = {$the_cat_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location:categories.php");
    }
}

function update_categories() {
    global $connection;
    if (isset($_GET['edit'])) {
        $cat_id = $_GET['edit'];
        include "includes/update_categories.php";
    }
}
?>