<?php
    require_once '../classes/database.php';
    $page_title = 'Forecast - Login';

    //we start session since we need to use session values
    session_start();
    //creating an array for list of users can login to the system
    $conn=mysqli_connect("localhost","root","","forecast");  
     $error="";  
    if (isset($_POST['submit'])) {  
      //echo "<pre>";  
      //print_r($_POST);  
      $username=mysqli_real_escape_string($conn,$_POST['username']);  
      $password=mysqli_real_escape_string($conn,$_POST['password']);  
      $sql=mysqli_query($conn,"select * from userz where username='$username' && password='$password'");  
      $num=mysqli_num_rows($sql);  
      if ($num>0) {  
           //echo "found";  
           $row=mysqli_fetch_assoc($sql);  
           $_SESSION['logged-in'] = $username;
           $_SESSION['fullname']=$row['firstname'] . ' ' . $row['lastname'];
           $_SESSION['user_type'] = $row['type'];

            header('location: ../admin/dashboard.php');
      }
        //set the error message if account is invalid
        $error = 'Invalid username/password. Try again.';
    }

    require_once '../includes/header.php';

?>
    <div class="login-container">
        <form class="login-form" action="login.php" method="post">
            <div class="logo-details">
                <i class='bx bx-meteor'></i>
                <span class="logo-name">forecast</span>
            </div>
            <hr class="divider">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter username" required tabindex="1">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter password" required tabindex="2">
            <input class="button" type="submit" value="Login" name="submit" tabindex="3">
            <?php
                //Display the error message if there is any.
                if(isset($error)){
                    echo '<div><p class="error">'.$error.'</p></div>';
                }
                
            ?>
        </form>
    </div>
<?php
    require_once '../includes/footer.php';
?>