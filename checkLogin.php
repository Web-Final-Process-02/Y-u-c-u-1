<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<?php
require_once("connectdb.php");
session_start();

if (isset($_POST["btn_submit"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
  
    $username = strip_tags($username);
    $username = addslashes($username);
    $password = strip_tags($password);
    $password = addslashes($password);
    if ($username == "" || $password =="") {
        echo "username hoặc password bạn không được để trống!";
    }else{
        $sql = "select * from users where username = '$username' and password = '$password' ";
        $query = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows==0) {
            echo "<div class='container mt-3'>
            <table class='table table-bordered '>
            <tr>
                    <td colspan='4'><h4><center>tên đăng nhập hoặc mật khẩu không đúng !</center></h4></td>
                </tr>
            </div>";
        }else{
            while($data = mysqli_fetch_array($query)){
            $_SESSION['username'] = $data['username'];
            $_SESSION['permission'] = $data['permission'];
            $_SESSION['fullname'] = $data['fullname'];
            $permission = $_SESSION['permission'];
            if($permission == 'user'){
                header('Location: user.php');
            }
            else if($permission == 'instructor'){
                header('Location: instructor.php');
            }
            else if($permission == 'admin'){
                header('Location: admin.php');
            }
            
        }

        }
    }
}
?>
</html>
