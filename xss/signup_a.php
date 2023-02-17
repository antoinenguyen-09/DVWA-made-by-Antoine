<?php
if(!preg_match("/^\s*[a-zA-Z0-9_]{5,30}\s*$/",$_POST['pass']))
{ 
    header('Location: signup.php?password=error');
}
else if ($_POST['pass'] != $_POST['cpass']){   
    header('Location: signup.php?confirm=error');
}
else if (!preg_match("/^\s*[a-z0-9_]{4,30}\s*$/",$_POST['username'])){
    header('Location: signup.php?username=error');
}
else{
    $con12 = new mysqli("localhost","kali","kali","class");
    if ($con12->connect_error) {
        die("Connection failed: " . $con12->connect_error);
    } 
    $stmt = $con12->prepare("SELECT * FROM teacher WHERE username=?");
    $stmt->bind_param("s", $_POST['username']);
    $stmt->execute();
    if($stmt->fetch() == 1){
        header('Location: signup.php?status=failed');
    }
    else{
        $con13 = new mysqli("localhost","kali","kali","class");
        $stmt1 = $con13->prepare('INSERT INTO teacher VALUES (?,?)');
        $stmt1->bind_param("ss", $_POST['username'],$_POST['pass']);
        if($stmt1->execute()){    // 
            header('Location: signup.php?status=success');
        } else {
            header('Location: signup.php?status=failed');
        }
    }
} 
?>