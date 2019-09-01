<?php
    if (isset($_POST['create_post'])) {
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category'];
        
        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        //$post_comment_count = 4;
        $post_status = $_POST['post_status'];

        move_uploaded_file($post_image_temp,"../images/$post_image");
        $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_date,post_image,post_content,post_tags,post_status)";
        $query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(),'{$post_image}','{$post_content}','{$post_tags}','{$post_status}')";
        $ceate_post_query = mysqli_query($connection,$query);
        confirm_query($ceate_post_query);
        $the_post_id = mysqli_insert_id($connection);//this method get the last id registered
        echo "<div class='alert alert-success' role='alert'>post created: ". " " . " <a href='../post.php?p_id={$the_post_id}'>View post</a></div>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="email"><b>Post Title</b></label>
        <input class="form-control" type="text" name="post_title">
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
        <input class="form-control" type="text" name="post_author">
    </div>
    <!-- 
    <div class="form-group">
        <label for="post_status"><b>Post Status</b></label>
        <input class="form-control" type="text" name="post_status">
    </div> 
    -->
    <div class="form-group">
        <select class="form-control" name="post_status" id="">
            <option value="draft">Select Options :</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label for="post_image"><b>Post Image</b></label>
        <input class="form-control" type="file" name="image">
    </div> 
    <div class="form-group">
        <label for="post_tags"><b>Post Tags</b></label>
        <input class="form-control" type="text" name="post_tags">
    </div> 
    <div class="form-group">
        <label for="post_content"><b>Post Content</b></label>
        <textarea rows="5" cols="30" class="form-control" type="text" name="post_content"></textarea>
    </div> 
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Add Post">
    </div>
</form>