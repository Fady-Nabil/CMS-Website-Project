<?php
   if(isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
    $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
    $select_posts_id = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_posts_id)) {
        $post_id = $row['post_id'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_author = $row['post_author'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_comments = $row['post_comment_count'];
        $post_status = $row['post_status'];

        if(isset($_POST['update_post'])) {
            $post_title = $_POST['post_title'];
            $post_category_id = $_POST['post_category'];
            $post_author = $_POST['post_author'];
            $post_image =  $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $post_content = $_POST['post_content'];
            $post_tags = $_POST['post_tags'];
            $post_status = $_POST['post_status'];
            move_uploaded_file($post_image_temp,"../images/$post_image");

            if(empty($post_image)) {
                $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
                $select_image = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($select_image)) {
                    $post_image = $row['post_image'];
                }
            }
            $query = "UPDATE posts SET ";
            $query .="post_title  = '{$post_title}', ";
            $query .="post_category_id = '{$post_category_id}', ";
            $query .="post_date   =  now(), ";
            $query .="post_author = '{$post_author}', ";
            $query .="post_status = '{$post_status}', ";
            $query .="post_tags   = '{$post_tags}', ";
            $query .="post_content= '{$post_content}', ";
            $query .="post_image  = '{$post_image}' ";
            $query .= "WHERE post_id = {$the_post_id} ";
            $update_post = mysqli_query($connection,$query);
            confirm_query($update_post);
            echo "<div class='alert alert-success' role='alert'>Post Updated:  ". " " . " <a href='../post.php?p_id={$the_post_id}'>View Post</a> OR <a href='posts.php'>View Posts</a></div>";
        }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email"><b>Post Title</b></label>
                <input class="form-control" type="text" name="post_title" value="<?php if(isset($post_title)) {echo $post_title;} ?>">
            </div> 
            <div class="form-group">
                <label for="post_category"><b>Post Category</b></label>
                <select class="form-control" name="post_category" id="">
                <?php
                    //find and show all categories query
                    $query = "SELECT * FROM categories";
                    $select_categories = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($select_categories)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<option value='$cat_id'>{$cat_title}</option>";
                    }
                ?>
                </select>
            </div> 
            <div class="form-group">
                <label for="post_author"><b>Post Author</b></label>
                <input class="form-control" type="text" name="post_author" value="<?php echo $post_author; ?>">
            </div>
            <!-- 
            <div class="form-group">
                <label for="post_status"><b>Post Status</b></label>
                <input class="form-control" type="text" name="post_status" value="<?php echo $post_status; ?>">
            </div> 
            -->
            <div class="form-group">
                <select class="form-control" name="post_status" id="">
                    <option value='<?php echo $post_status ?>'><?php echo $post_status ?></option>
                    <?php
                        if($post_status == 'published') {
                            echo "<option value='draft'>Draft</option>";
                        } else {
                            echo "<option value='published'>Publish</option>";
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="post_image"><b>Post Image</b></label>
                <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
                <input class="form-control" type="file" name="image">
            </div> 
            <div class="form-group">
                <label for="post_tags"><b>Post Tags</b></label>
                <input class="form-control" type="text" name="post_tags" value="<?php echo $post_tags; ?>">
            </div> 
            <div class="form-group">
                <label for="post_content"><b>Post Content</b></label>
                <textarea rows="10" cols="30" class="form-control" type="text" name="post_content"><?php echo $post_content; ?></textarea>
            </div> 
            <div class="form-group">
                <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
            </div>
        </form>
        <?php
    }
}

?>



