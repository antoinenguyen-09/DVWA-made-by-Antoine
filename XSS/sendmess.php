<?php
   session_start();
   if (!isset($_SESSION['teacher']) || !isset($_SESSION['student']))
   {
      header('Location: list.php');  
   }
?>
<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
   <form action="mess_handle.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
         <label for="exampleFormControlTextarea1">Say something to him/her </label>
         <textarea class="form-control" name="message" rows="3"></textarea>
      </div>
      <div class="form-group">
         <button type="submit" name="send" class="btn btn-success btn-lg">Send</button>
      </div>
   </form>
   <p style="color: green"><?php if(isset($_GET['status']) && $_GET['status']=="success") echo "Sending successfully!";?>
   <p style="color: red"><?php if(isset($_GET['status']) && $_GET['status']=="failed") echo "There is an error while sending!";?>
</body>
</html>