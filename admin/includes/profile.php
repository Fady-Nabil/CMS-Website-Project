<?php include "includes/admin_header.php"; ?>
    <?php
        if(isset($_SESSION['username'])) {

        }
    ?>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                                Welcome To Admin
                                <small>Author</small>
                        </h1>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="email"><b>Post Title</b></label>
                                <input class="form-control" type="text" name="post_title" value="<?php if(isset($post_title)) {echo $post_title;} ?>">
                            </div> 
                            <div class="form-group">
                                <label for="post_category"><b>Post Category</b></label>
                                <select class="form-control" name="post_category" id="">
                                </select>
                            </div> 
                            <div class="form-group">
                                <label for="post_author"><b>Post Author</b></label>
                                <input class="form-control" type="text" name="post_author" value="v">
                            </div> 
                            <div class="form-group">
                                <label for="post_status"><b>Post Status</b></label>
                                <input class="form-control" type="text" name="post_status" value=" v">
                            </div> 
                            <div class="form-group">
                                <label for="post_image"><b>Post Image</b></label>
                                <img width="100" src="vvv" alt="">
                                <input class="form-control" type="file" name="image">
                            </div> 
                            <div class="form-group">
                                <label for="post_tags"><b>Post Tags</b></label>
                                <input class="form-control" type="text" name="post_tags" value="vv">
                            </div> 
                            <div class="form-group">
                                <label for="post_content"><b>Post Content</b></label>
                                <textarea rows="10" cols="30" class="form-control" type="text" name="post_content"><?php echo $post_content; ?></textarea>
                            </div> 
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_post" value="Edit Post">
                            </div>
                        </form> <!--form -->
                    </div><!--col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
<?php include "includes/admin_footer.php"; ?>