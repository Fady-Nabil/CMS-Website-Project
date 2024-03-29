<?php
if(isset($_POST['checkBoxArray'])) {
    foreach($_POST['checkBoxArray'] as $PostValueId) {
        $bulk_options = $_POST['bulk_options'];
        switch($bulk_options) {
            case 'published':
            $bulk_options = $_POST['bulk_options'];
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$PostValueId} ";
            $update_to_published_status = mysqli_query($connection,$query);
            break;
            case 'draft':
            $bulk_options = $_POST['bulk_options'];
            $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$PostValueId} ";
            $update_to_draft_status = mysqli_query($connection,$query);
            break;
            case 'delete':
            $bulk_options = $_POST['bulk_options'];
            $query = "DELETE FROM posts WHERE post_id = {$PostValueId} ";
            $update_to_delete_status = mysqli_query($connection,$query);
            break;
        }
    }
}
?>
<form method="post">
    <div id="bulkOptionsCountainer" class="form-group col-xs-4">
        <select class="form-control" name="bulk_options" id="">
            <option value="">Select Options :</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
        </select>
    </div>
    <div class="form-group col-xs-4">
        <input class="btn btn-success" type="submit" name="submit" value="Apply">
        <a class="btn btn-primary" href="posts.php?source=add_post">Add New</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
            <tr> 
                <th><input id="selectAllBoxes" type="checkbox"></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        //find and show all posts query
        $query = "SELECT * FROM posts";
        $select_posts = mysqli_query($connection, $query);
        while($row = mysqli_fetch_assoc($select_posts)) {
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_author = $row['post_author'];
            $post_date = $row['post_date'];
            $post_image = $row['post_image'];
            $post_content= $row['post_content'];
            $post_tags = $row['post_tags'];
            $post_comments = $row['post_comment_count'];
            $post_status = $row['post_status'];
            echo "<tr>";
                ?>
                <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
                <?php
                echo "<td>{$post_id}</td>";
                echo "<td>{$post_author}</td>";
                echo "<td>{$post_title}</td>";
                $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
                $select_categories_id = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($select_categories_id)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                }   
                echo"<td>{$cat_title}</td>";
                echo"<td>{$post_status}</td>";
                echo "<td><img width= '100' class='img-responsive' src='../images/{$post_image}' alt='image'></td>";
                echo "<td>{$post_tags}</td>";
                echo "<td>{$post_comments}</td>";
                echo "<td>{$post_date}</td>";
                echo "<td><a class='btn btn-info btn-xs' href='../post.php?p_id={$post_id}'>View Post</a></td>";
                echo "<td><a class='btn btn-success btn-xs' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" class='btn btn-danger btn-xs' href='posts.php?delete={$post_id}'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php
    if(isset($_GET['delete'])) {
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$the_post_id}";
        $delete_query = mysqli_query($connection,$query);
        header("Location:posts.php");
    }
    ?>
</form>