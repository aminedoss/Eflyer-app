<?php
session_start();

include('../config/dbconn.php');

if(isset($_POST['bt_register']))
{
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $check_email_query= "SELECT * FROM users WHERE Email=:email";
    $check_email_stmt = $pdo->prepare($check_email_query);
    $check_email_stmt->execute(array(':email' => $email));
    
    if($check_email_stmt->rowCount() > 0)
    {
        $_SESSION['message'] = "Email already registered";
        header('Location: ../register.php'); 
        exit();
    }
    else
    {
        if($password == $cpassword)
        { 
            $insert_query = "INSERT INTO users(name, Email, phone, password) VALUES(:name, :email, :phone, :password)";
            $insert_stmt = $pdo->prepare($insert_query);
            $insert_stmt->execute(array(
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':password' => $password
            ));

            $_SESSION['message'] = "Registered Successfully";
            header('Location: ../login.php'); 
        }
        else
        { 
            $_SESSION['message'] = "Passwords do not match";
            header('Location: ../register.php'); 
        }
    }
}
elseif(isset($_POST['login_btn']))
{
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $login_query = "SELECT * FROM users WHERE Email=:Email AND password=:password";
    $login_stmt = $pdo->prepare($login_query);
    $login_stmt->execute(array(
        ':Email' => $email,
        ':password' => $password
    ));

    if($login_stmt->rowCount() > 0)
    {
        $_SESSION['auth'] = true;
        $userdata = $login_stmt->fetch(PDO::FETCH_ASSOC);
        $userid = $userdata['id'];
        $username = $userdata['name'];
        $useremail = $userdata['email'];
        $role_as = $userdata['role_as'];
        $_SESSION['auth_user'] = [
            'user_id'=>$userid,
            'name' => $userdata['name'], 
            'Email' => $userdata['Email']

        ];
        $_SESSION['message'] = "Logged In Successfully"; 
            header('Location: ../index.php');
        $_SESSION['role_as'] = $role_as;
        if ($role_as == 1) {
            $_SESSION['message'] = "Welcome To Dashboard";
            header('Location: ../admin/Dashboard.php');
        } else {
            $_SESSION['message'] = "Logged In Successfully"; 
            header('Location: ../index.php');
        }     
    }
    else
    {
        $_SESSION['message'] = "Invalid Credentials";
        header('Location: ../login.php');
    }
}
?>