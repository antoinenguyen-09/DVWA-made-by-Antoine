<?php
session_start();
if(!isset($_SESSION['teacher']) || !$_SESSION['teacher']){
   header('Location: login.php');
}
if(!preg_match("/^\s*[a-zA-Z0-9_]{5,30}\s*$/",$_POST['pass']))
{ 
    header('Location: addstu.php?password=error');
}
else if ($_POST['pass'] != $_POST['cpass']){   
    header('Location: addstu.php?confirm=error');
}
else if (!preg_match("/^\s*[a-z0-9_]{4,30}\s*$/",$_POST['username'])){
    header('Location: addstu.php?username=error');
}
else if(!preg_match("/^[A-Z][a-zA-Z]{1,10}(?: [A-Z][a-z]*){1,10}$/",$_POST['fullname'])){ 
    header('Location: addstu.php?fullname=error');
}
else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
    header('Location: addstu.php?email=error');
}
else if(!preg_match("/^[0-9]{10}$/",$_POST['phonenum'])){
    header('Location: addstu.php?phone=error');
}
else{
    $con5 = new mysqli("localhost","kali","kali","class");
    if ($con5->connect_error) {
        die("Connection failed: " . $con5->connect_error);
    } 
    $stmt = $con5->prepare("SELECT * FROM student WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    if($stmt->fetch() == 1){
        header('Location: addstu.php?status=failed');
    }
    else{
        $con6 = new mysqli("localhost","kali","kali","class");
        $stmt1 = $con6->prepare('INSERT INTO student (username,password,fullname,email,phonenum) VALUES (?,?,?,?,?)');
        $stmt1->bind_param("sssss", $_POST['username'],$_POST['pass'],$_POST['fullname'],$_POST['email'],$_POST['phonenum']);
        $con7 = new mysqli("localhost","kali","kali","message");
        $sql = "CREATE TABLE `$_POST[username]` (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, sender VARCHAR(30) NOT NULL, content VARCHAR(10000) NOT NULL)";
        if($stmt1->execute() && $con7->query($sql)){    // 
            header('Location: addstu.php?status=success');
        } else {
            echo "Failed";
        }
    }
} 
?>