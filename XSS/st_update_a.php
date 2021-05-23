<?php
session_start();
if(!isset($_SESSION['student']) || !$_SESSION['student']){
  header('Location: login.php');
}
if(isset($_POST['submit'])){
    if(hash_equals($_SESSION['csrf'],$_POST['csrf'])){
        if(!preg_match("/^\s*[a-zA-Z0-9_]{5,30}\s*$/",$_POST['pass']))
        { 
            header('Location: st_update.php?password=error');
        }
        else if ($_POST['pass'] != $_POST['cpass']){   
            header('Location: st_update.php?confirm=error');
        }
        else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            header('Location: st_update.php?email=error');
        }
        else if(!preg_match("/^[0-9]{10}$/",$_POST['phonenum'])){
            header('Location: st_update.php?phone=error');
        }
        else{
            $con13 = new mysqli("localhost","kali","kali","class");
            $stmt = $con13->prepare('UPDATE student SET password=?, email=?, phonenum=? WHERE username=?');
            $stmt->bind_param("ssss", $_POST['pass'],$_POST['email'],$_POST['phonenum'],$_SESSION['user']);
            if($stmt->execute()){    
                header('Location: st_update.php?status=success');
            } else {
                echo "Failed";
            }
        }
    } else{
        header('Location: login.php');
    }
}
?>
