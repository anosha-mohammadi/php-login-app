<?php

include "partials/header.php";
include "partials/navigation.php"; 

$error = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if($password !== $confirm_password){
        $error = "Passwords do not match";
    } else {

        // $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        // $result = mysqli_query($conn, $sql);

        // var_dump($result);

        if(userExists($conn, $username)){
            $error = "Username already exist! Please choose another";
        }
        else {
            if(check_query($conn,create_user($conn,$username, $email, $password))){
                $_SESSION['logged_in'] = true;
                $_SESSION['username'] = $username;
                header("Location: admin.php");
                exit;
            } else {
                $error = "SOMETHING HAPPENED not data inserted." . mysqli_error($conn);
            }
        }
    }
}

?>
<div class="container">
    <div class="form-container">
        <form method="POST" action="">
            <h2>Create your account</h2>

            <?php if($error): ?>
            <p style="color: red"> <?php echo $error; ?></p>
            <?php endif;?>

            <label for="username">Username: </label><br>
            <input value="<?php echo isset($username) ? $username : '';?>" type="text" name="username" required/><br><br>

            <label for="email">Email: </label><br>
            <input value="<?php echo isset($email) ? $email : '';?>" type="email" name="email" required/><br><br>

            <label for="password">Password: </label><br>
            <input type="password" name="password" required/><br><br>


            <label for="confirm_password">Confirm Password: </label><br>
            <input type="password" name="confirm_password" required/><br><br>

            <input type="submit" value="Register">
        </form>
    </div>
 </div>
<?php include "partials/footer.php"; ?>

<?php 
mysqli_close($conn);
?>