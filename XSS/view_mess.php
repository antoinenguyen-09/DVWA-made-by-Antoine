<?php
   session_start();
   if(!isset($_SESSION['user']) || !$_SESSION['student']){
       header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <style type="text/css">
        table {
            border-collapse: collapse;
            width: 100%;
            color: #00bd48;
            font-family: monospace;
            font-size: 25px;
            text-align:left; 
        }
        th {
            background-color: #00bd48;
            color: white; 
        }
        tr:nth-child(even) {background-color: #f2f2f2}
        hr {
            border: 10px solid green;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<h2>Message</h2>
</br>
<table>
    <tr>
        <th>ID</th>
        <th>Sender</th>
        <th>Content</th>
    </tr>
    <?php
       $con10 = new mysqli("localhost","kali","kali","message");
       if ($con10->connect_error) {
           die("Connection failed: " . $con10->connect_error);
       }
       $sql = "SELECT * FROM ".$_SESSION['user']."";
       $result = $con10->query($sql);
       if($result->num_rows > 0){
         while($rows = $result->fetch_assoc()){
           echo "<tr><td>".$rows["id"]."</td><td>".$rows["sender"]."</td><td>".$rows["content"]."</td></tr>";
           }
       } 
       else{
           $msg = "Your box chat empty now!";
       }
    ?>
</table>

