<?php 
session_start();
if (!isset($_SESSION['teacher']) || !isset($_SESSION['student']))
{
    header('Location: list.php');  
} 
else{
    // echo $_SESSION['id'].' and '.$_SESSION['user'].' and '.$_POST['message'];
    $con8 = new mysqli("localhost","kali","kali","class");
    if ($con8->connect_error) {
        die("Connection failed: " . $con8->connect_error);
    }
    $con9 = new mysqli("localhost","kali","kali","message");
    if ($con9->connect_error) {
        die("Connection failed: " . $con9->connect_error);
    }
    $id = $_SESSION['id'];
    $x = 0;
    $arr = array();
    $stmt = $con8->prepare("SELECT * FROM student WHERE id=?");
    $stmt->bind_param("s", $id);
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
    $sender = base64_decode($_COOKIE['login']);
    $content = $_POST['message'];
    // echo $sender." and ".$content." to ".$arr[1];
  
    $sql = "INSERT INTO ".$arr[1]." (sender,content) VALUES ('".$sender."','".$content."')";
    echo $sql;
    if($con9->query($sql)){
        header('Location: sendmess.php?status=success');
    } else{
        header('Location: sendmess.php?status=failed');
    }
}
?>
