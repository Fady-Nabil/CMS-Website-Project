<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
if(isset($_POST['submit'])) {
    $username  = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];

    if(!empty($username) && !empty($firstname) && !empty($lastname) &&!empty($email) && !empty($password)) {
        $username  = mysqli_real_escape_string($connection, $username);
        $firstname = mysqli_real_escape_string($connection, $firstname);
        $lastname  = mysqli_real_escape_string($connection, $lastname);
        $email     = mysqli_real_escape_string($connection, $email);
        $password  = mysqli_real_escape_string($connection, $password);
    
        $query = "SELECT randSalt FROM users"; 
        $select_randslat_query = mysqli_query($connection, $query);
    
        $row = mysqli_fetch_array($select_randslat_query);
        $salt = $row['randSalt'];
        //encrpt password using salt and encrpt function
        $password = crypt($password, $salt);

        $query  = "INSERT INTO users (username, user_firstname, user_lastname, user_email, user_password, user_role)";
        $query .="VALUES ('{$username}','{$firstname}','{$lastname}','{$email}','$password','subscriber')";
        $register_user_query = mysqli_query($connection, $query);
        //confirm_query($register_user_query);
        ?>
        <div class="text-center alert alert-success">
            Your Registration has been submitted.
        </div>
        <?php
        header("Location:index.php");
    }//end if
    else {
        ?>
        <div class="text-center alert alert-danger">
        Fields can't be empty.
        </div>
        <?php
    }//end else
}// end if
else {
    $message = "";
}//end else
?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="sr-only">firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter Desired Firstname">
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="sr-only">Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Desired Lastname">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
