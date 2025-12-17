<?php 

include ('connection.php');
include ('functions/main.php');

$theUsers = new Main;

if(isset($_POST['register'])){
    $fullName = $_POST['fullName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    $userCount = $theUsers->fetchUser($username);
    
    $errors = null;

    if(empty($fullName) or empty($email) or empty($username) or empty($password) or empty($confirmPassword)){
        $errors = '<div class="alert alert-warning"><strong> All fields are required! </strong> Please try again 😒</div>';
    }else if($password != $confirmPassword){
        $errors = '<div class="alert alert-warning"><strong> Both Passwords should Match! </strong> Please try again 😒</div>';
    }else if($userCount > 0){
        $errors = '<div class="alert alert-warning"><strong> Username is Taken </strong> Please Try Another one 😒</div>';
    }

    if($errors){
        $_SESSION['registration_errors'] = $errors;
        header('Location: signup.php');
        exit;
    } else {
        $dbPassword = md5($password);
        $query = $pdo->prepare("INSERT INTO `crud`.`user` ( `username` ,`userEmail`, `fullName`,`password`)
        VALUES ( ?,?,?,?)");
        $query->bindValue(1, $username);    
        $query->bindValue(2, $email);
        $query->bindValue(3, $fullName);
        $query->bindValue(4, $dbPassword);
                            
        $query -> execute(); 
        $_SESSION['message'] = '<div class="alert alert-success">Registration successful! Please log in.</div>';
        header('Location: login.php');
        exit;
    }
} else {
    header('Location: signup.php');
    exit;
}
?>