<?php include "db.php"; ?>
<?php session_start(); ?>
<?php 
//login query
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $paaword  = $_POST['password'];

    $username = mysqli_real_escape_string($connection, $username);
    $password = mysqli_real_escape_string($connection, $paaword);

    $query = "SELECT * FROM users WHERE username = '{$username}' ";
    $select_user_query = mysqli_query($connection, $query);
    //confirm_query($select_user_query);
    while($row = mysqli_fetch_array($select_user_query)) {
        $db_user_id        =  $row['user_id'];
        $db_username       =  $row['username'];
        $db_user_password  =  $row['user_password'];
        $db_user_firstname =  $row['user_firstname'];
        $db_user_lastname  =  $row['user_lastname'];
        $db_user_role      =  $row['user_role'];    
    }
    /*
    if($username !== $db_username && $password !== $db_user_password) {
        header("Location: ../index.php");
    } else if ($username == $db_username && $password == $db_user_password) {
        $_SESSION['username']   = $db_username;
        $_SESSION['firstname']  = $db_user_firstname;
        $_SESSION['lastname']   = $db_user_lastname; 
        $_SESSION['user_role']  = $db_user_role;  
        header("Location: ../admin/index.php");
    } else {
        header("Location: ../index.php");
    }
    */

     //encrpt password using salt and encrpt function
     $password = crypt($password, $db_user_password);
    if($username === $db_username && $password === $db_user_password) {
        $_SESSION['username']   = $db_username;
        $_SESSION['firstname']  = $db_user_firstname;
        $_SESSION['lastname']   = $db_user_lastname; 
        $_SESSION['user_role']  = $db_user_role;  
        header("Location: ../admin/index.php");
    } else {
        header("Location: ../index.php");
    }
}

?>