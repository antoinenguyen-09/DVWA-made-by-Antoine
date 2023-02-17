<?php
session_start();
if(!isset($_SESSION['student']) || !$_SESSION['student'] || !isset($_SESSION['user'])){
  header('Location: login.php');
} else{
  if(empty($_SESSION['key'])){
        $_SESSION['key'] = bin2hex(random_bytes(32));
  }
  $csrf = hash_hmac('sha256',$_SESSION['user'],$_SESSION['key']);
  $_SESSION['csrf'] = $csrf;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assests/css/style.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
   <div class="signup-form">
    <form action="st_update_a.php" method="post">
		<h2>Update your profile</h2>	
      <input type="hidden" name="csrf" value="<?php echo $csrf;?>">
      <div class="form-group">
        	<input type="email" class="form-control" name="email" placeholder="Email" required="required">
      </div>
        <p style="color: red"><?php if(isset($_GET['email']) && $_GET['email']=="error") echo "Wrong email format!";?></p> 
      <div class="form-group">
         <input type="text" class="form-control" name="phonenum" placeholder="Phone Number" required="required">
		</div>
        <p style="color: red"><?php if(isset($_GET['phone']) && $_GET['phone']=="error") echo "Wrong phone number format (exactly 10 numbers)!";?></p> 
		<div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
        <p style="color: red"><?php if(isset($_GET['password']) && $_GET['password']=="error") echo "Password must have characters (a-z) or numbers (0-9) or underscores(_), length under 30!";?></p> 
		<div class="form-group">
            <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" required="required">
        </div>
        <p style="color: red"><?php if(isset($_GET['confirm']) && $_GET['confirm']=="error") echo "Wrong confirmed password";?></p>       
		<div class="form-group">
            <button type="submit" name="submit" class="btn btn-success btn-lg btn-block">Update now</button>
        </div>
    </form>
	 <p style="color: green"><?php if(isset($_GET['status']) && $_GET['status']=="success") { $comeback='<a href="index.php"><button type="button" class="btn btn-secondary">Come back to home page</button></a>'; echo "Adding successfully!"; } ?></p>
    <?php echo $comeback; ?>
</div>
</body>
</html>
