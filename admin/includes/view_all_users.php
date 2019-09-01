<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <!--<th>Image</th>-->
            <th>Role</th>
            <th>Approve</th>
            <th>Unapprove</th>
            <th>change</th>
            <th>change</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    <?php
    //find and show all comments query
    $query = "SELECT * FROM users";
    $select_users = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        echo "<tr>";
            echo "<td>{$user_id}</td>";
            echo "<td>{$username}</td>";
            echo "<td>{$user_firstname}</td>";
            echo"<td>{$user_lastname}</td>";
            echo"<td>{$user_email}</td>";
            //echo"<td>{$user_image}</td>";
            echo"<td>{$user_role}</td>";
            echo "<td><a class='btn btn-success btn-xs' href='users.php?approve=$user_id'>Approve</a></td>";
            echo "<td><a class='btn btn-danger btn-xs' href='users.php?unapprove=$user_id'>Unapprove</a></th>";
            echo "<td><a class='btn btn-success btn-xs' href='users.php?change_to_admin=$user_id'>to admin</a></td>";
            echo "<td><a class='btn btn-danger btn-xs' href='users.php?change_to_sub=$user_id'>to sub</a></th>";
            echo "<td><a class='btn btn-success btn-xs' href='users.php?source=edit_user&u_id=$user_id'>Edit</a></th>";
            echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?'); \" class='btn btn-danger btn-xs' href='users.php?delete=$user_id'>Delete</a></th>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
<?php
//change to admin user query
if(isset($_GET['change_to_admin'])) {
    $the_user_id = $_GET['change_to_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
    $chang_to_admin_query = mysqli_query($connection,$query);
    header("Location:users.php");
}
//change to subscriber user query
if(isset($_GET['change_to_sub'])) {
    $the_user_id = $_GET['change_to_sub'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id}";
    $chang_to_subscriber_query = mysqli_query($connection,$query);
    header("Location:users.php");
}
//approve comment query
if(isset($_GET['approve'])) {
    $the_comment_id = $_GET['approve'];
    $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id ";
    $approve_comment_query = mysqli_query($connection,$query);
    header("Location:comments.php");
}
//unapprove comment query
if(isset($_GET['unapprove'])) {
    $the_comment_id = $_GET['unapprove'];
    $query = "UPDATE comments SET comment_status = 'unapproved'  WHERE comment_id = $the_comment_id ";
    $unapprove_comment_query = mysqli_query($connection,$query);
    header("Location:comments.php");
}
//delete user query
if(isset($_GET['delete'])) {
    $the_user_id = $_GET['delete'];
    $query = "DELETE FROM users WHERE user_id = {$the_user_id}";
    $delete_query = mysqli_query($connection,$query);
    header("Location:users.php");
}
?>