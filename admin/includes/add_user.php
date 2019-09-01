<?php
    if (isset($_POST['create_user'])) {
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        //$post_image = $_FILES['image']['name'];
       // $post_image_temp = $_FILES['image']['tmp_name'];
        //move_uploaded_file($post_image_temp,"../images/$post_image");
        $query = "INSERT INTO users(user_firstname,user_lastname,user_role,username,user_email,user_password)";
        $query .= "VALUES('{$user_firstname}','{$user_lastname}','{$user_role}','{$username}','{$user_email}',{$user_password})";
        $ceate_user_query = mysqli_query($connection,$query);
        //confirm_query($ceate_user_query);
        echo "<div class='alert alert-success' role='alert'>user created: ". " " . " <a href='users.php'>View users</a></div>";
    }
?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_firstname"><b>Firstname</b></label>
        <input class="form-control" type="text" name="user_firstname">
    </div> 
    <div class="form-group">
        <label for="user_lastname"><b>Lastname</b></label>
        <input class="form-control" type="text" name="user_lastname">
    </div> 
    <div class="form-group">
        <label for="user_role"><b>User Role</b></label>
        <select class="form-control" name="user_role" id="">
        <option value="subscriber">Select options :</option>
        <option value="admin">Admin</option>
        <option value="subscriber">Subscriber</option>
        </select>
    </div>
    <!--<div class="form-group">
        <label for="post_image"><b>Post Image</b></label>
        <input class="form-control" type="file" name="image">
    </div> -->
    <div class="form-group">
        <label for="username"><b>Username</b></label>
        <input class="form-control" type="text" name="username">
    </div> 
    <div class="form-group">
        <label for="user_email"><b>Email</b></label>
        <input class="form-control" type="text" name="user_email">
    </div> 
    <div class="form-group">
        <label for="user_email"><b>Password</b></label>
        <input class="form-control" type="password" name="user_password">
    </div> 
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>
</form>