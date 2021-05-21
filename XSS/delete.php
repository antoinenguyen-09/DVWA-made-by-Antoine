<?php
session_start();
if(!isset($_SESSION['teacher']) || !$_SESSION['teacher']){
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <?php
        if(isset($_POST['delete'])){
            $con14 = new mysqli("localhost","kali","kali","class");
            $x = 0;
            $arr = array();
            $stmt = $con14->prepare("SELECT * FROM student WHERE id=?");
            $stmt->bind_param("s",$_SESSION['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_array(MYSQLI_NUM))
            {
                foreach ($row as $r)
                {
                    $arr[$x] = "$r";
                    $x++;
                }
            }
            $con15 = new mysqli("localhost","kali","kali","class");
            $stmt1 = $con15->prepare("DELETE FROM student WHERE id=?");
            $stmt1->bind_param("s",$_SESSION['id']);
            $con16 = new mysqli("localhost","kali","kali","message");
            $sql = "DROP TABLE `$arr[1]`";
            if($stmt1->execute() && $con16->query($sql)){    
                $msg = "This student has been deleted!";
            }
        }
    ?>
    <br/>
    <h1 style="color: green;"><?php if(isset($msg)) echo $msg; ?></h1>
    <?php if(isset($msg))  echo '<a href="index.php"><button type="button" class="btn btn-secondary">Come back to home page</button></a>'; ?>
</body>
</html>