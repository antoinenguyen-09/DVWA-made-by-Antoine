<?php
session_start();
if(!isset($_SESSION['teacher']) || !$_SESSION['teacher']){
   header('Location: login.php');
}
if(isset($_POST['submit'])){
   if(hash_equals($_SESSION['csrf'],$_POST['csrf'])){
    if(!preg_match("/^\s*[a-zA-Z0-9_]{5,30}\s*$/",$_POST['pass']))
    { 
        header('Location: tec_update.php?password=error');
    }
    else if ($_POST['pass'] != $_POST['cpass']){   
        header('Location: tec_update.php?confirm=error');
    }
    else if (!preg_match("/^\s*[a-z0-9_]{4,30}\s*$/",$_POST['username'])){
        eader('Location: tec_update.php?username=error');
    }
    else if(!preg_match("/^[A-Z][a-zA-Z]{1,10}(?: [A-Z][a-z]*){1,10}$/",$_POST['fullname'])){ 
        header('Location: tec_update.php?fullname=error');
    }
    else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        header('Location: tec_update.php?email=error');
    }
    else if(!preg_match("/^[0-9]{10}$/",$_POST['phonenum'])){
        header('Location: tec_update.php?phone=error');
    }
    else{
            $con11 = new mysqli("localhost","kali","kali","class");
            $stmt1 = $con11->prepare('UPDATE student SET username=?, password=?, fullname=?, email=?, phonenum=? WHERE id=?');
            $stmt1->bind_param("ssssss",$_POST['username'],$_POST['pass'],$_POST['fullname'],$_POST['email'],$_POST['phonenum'], $_SESSION['id']);
            $con12 = new mysqli("localhost","kali","kali","class");
            $x = 0;
            $arr = array();
            $stmt2 = $con12->prepare("SELECT * FROM student WHERE id=?");
            $stmt2->bind_param("s",$_SESSION['id']);
            $stmt2->execute();
            $result = $stmt2->get_result();
            while ($row = $result->fetch_array(MYSQLI_NUM))
            {
                foreach ($row as $r)
                {
                    $arr[$x] = "$r";
                    $x++;
                }
            }
            $con13 = new mysqli("localhost","kali","kali","message");
            $sql = "ALTER TABLE `$arr[1]` RENAME TO `$_POST[username]`";
            if($stmt1->execute() && $con13->query($sql)){    // 
                header('Location: tec_update.php?status=success');
            } else {
                echo 'Failed';
            }
    }
  } else{
    header('Location: login.php');
  }
}
?>
