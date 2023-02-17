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
    <form action="signup_a.php" method="post" enctype="multipart/form-data">
		<h2>Sign up as a teacher, create your class!</h2>
      <div class="form-group">
         <input type="text" class="form-control" name="username" placeholder="Username" required="required">
		</div>  
        <p style="color: red"><?php if(isset($_GET['username']) && $_GET['username']=="error") echo "Username must have lowercase characters (a-z) or numbers (0-9) or underscores(_), no special characters and length from 5 to 30!";?></p>  
        <p style="color: red"><?php if(isset($_GET['status']) && $_GET['status']=="failed") echo "This username has already been existed!";?></p> 
		<div class="form-group">
            <input type="password" class="form-control" name="pass" placeholder="Password" required="required">
        </div>
        <p style="color: red"><?php if(isset($_GET['password']) && $_GET['password']=="error") echo "Password must have characters (a-z) or numbers (0-9) or underscores(_), length under 30!";?></p> 
		<div class="form-group">
            <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" required="required">
        </div>
        <p style="color: red"><?php if(isset($_GET['confirm']) && $_GET['confirm']=="error") echo "Wrong confirmed password";?></p>       
		<div class="form-group">
            <button type="submit" name="save" class="btn btn-info btn-lg btn-block">Add now</button>
        </div>
    </form>
	 <p style="color: green"><?php if(isset($_GET['status']) && $_GET['status']=="success") { $comeback='<a href="login.php"><button type="button" class="btn btn-secondary">Come back to login page</button></a>'; echo "Adding successfully!"; } ?></p>
    <?php echo $comeback; ?>
</div>
</body>
</html>