<?php 
$host = "localhost";
$username= "root";
$password= "root";
$db_name = "loginapp";
$conn = mysqli_connect($host, $username, $password, $db_name);
if(!$conn){
    // echo "connected db";
    die("Conection failled". mysqli_connect_error());
} else {
    // "Not connected". mysqli_error($conn);
    // echo "Connected";
}

function check_query($conn,$result){
    if(!$result){
        return "Error" . mysqli_error($conn);
    }
    return true;
}

function create_user($conn,$username, $email, $password){
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email) VALUES ('$username', '$passwordHash', '$email')";
    return mysqli_query($conn, $sql);
}

function update_user($conn, $user_id, $update_username, $update_email){
    $sql = "UPDATE users SET email = '$update_email', username = '$update_username' WHERE id = $user_id";
    return mysqli_query($conn, $sql);
}

function delete_user($conn, $user_id){
    $sql = "DELETE FROM users WHERE id= $user_id";
    return mysqli_query($conn, $sql);
}

?>