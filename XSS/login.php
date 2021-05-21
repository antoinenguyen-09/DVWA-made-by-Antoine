<?php
session_start();

require_once('permission.php');
if(isset($_POST["user"]) && isset($_POST["pass"])){
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$perm = new permission($user,$pass);
	$is_student = $perm->is_student();
	$is_teacher = $perm->is_teacher();    
	
	if($is_teacher || $is_student){
		$_SESSION['teacher'] = $is_teacher;
		$_SESSION['student'] = $is_student;
		$_SESSION['user'] = $user;
		header("Location: index.php");
		die();
//        $msg = '<h6 class="text-center" style="color:green">Valid Login.</h6>';
	}
	else{
		$msg = '<h6 class="text-center" style="color:red">Invalid Login.</h6>';
	}
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="style.css" rel="stylesheet">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
	<body>
	    <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">
                <a href="list.php">List of students</a> 
            </span>
        </nav>
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
					<div class="card card-signin my-5">
						<div class="card-body">
							<h5 class="card-title text-center">Sign In</h5>
							<?php if (isset($msg)) echo $msg; ?>
							<form class="form-signin" action="login.php" method="post">
								
								<div class="form-label-group">
									<input type="text" id="user" name="user" class="form-control" placeholder="Username" required autofocus>
									<label for="user">Username</label>
								</div>

								<div class="form-label-group">
									<input type="password" id="pass" name="pass" class="form-control" placeholder="Password" required>
									<label for="pass">Password</label>
								</div>

								<button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Sign in</button>
								<br/>
								<a href='signup.php'><button class="btn btn-lg btn-primary btn-block text-uppercase" type="button">Sign up as teacher</button></a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>