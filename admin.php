<?php 
include "partials/header.php";
include "partials/navigation.php";

if(!is_user_logged_in()){
    header("Location:login.php");
}

$result = mysqli_query($conn,"SELECT id, username, email, reg_date FROM users" );
// var_dump($result);

if($_SERVER['REQUEST_METHOD'] === "POST"){
    if(isset($_POST['edit_user'])){
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $update_email = mysqli_real_escape_string($conn, $_POST['email']);
        $update_username= mysqli_real_escape_string($conn, $_POST['username']);
        $query_status = check_query($conn,update_user($conn, $user_id, $update_username, $update_email));
        if($query_status === true){
            $_SESSION['message'] = "Updated successfully";
            $_SESSION['msg_type'] = "success";
            header("Location:admin.php");
        }
    } else if(isset($_POST['delete_user'])){
        $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
        $query_status = check_query($conn,delete_user($conn, $user_id));
        if($query_status === true){
            $_SESSION['message'] = "Deleted successfully";
            $_SESSION['msg_type'] = "success";
            header("Location: admin.php");
        }
    }
}
// print_r($_SESSION);
?>

<h1>Manage Users</h1>
<div class="container">

    <!-- <?php if(isset($_SESSION['message'])): ?>
        <div class="notification <?php echo $_SESSION['msg_type'];?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                unset($_SESSION['msg_type']);
            ?>
        </div>
    <?php endif;?> -->
    <table class="user-table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Registration Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>

        <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo $user['id'];  ?></td>
            <td><?php echo $user['username'];  ?></td>
            <td><?php echo $user['email'];  ?></td>
            <td><?php echo date("F j, Y", strtotime($user['reg_date'])); ?>
            </td>
            <td>
                <form method="POST" style="display:inline-block;">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <input type="text" name="username" value="<?php echo $user['username']; ?>" required>
                    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                    <button class="edit" type="submit" name="edit_user">Edit</button>
                </form>
                <form method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this user?');">
                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                    <button class="delete" type="submit" name="delete_user">Delete</button>
                </form>
            </td>
        </tr>

        <?php endwhile; ?>

        <!-- Additional user rows can go here -->
        </tbody>
    </table>
</div>

<?php  include "partials/footer.php"; 
mysqli_close($conn);
?>