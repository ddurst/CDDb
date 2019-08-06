<?php 
	session_start(); 
    //print_r($_SESSION); //Testing
?>

<!DOCTYPE html>
<html>
<head>
	<title>Collective Dialectic Database User Login</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	 
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<link rel="stylesheet" type="test/css" href="styles.css">

</head>
<body>
	<div class="container">
		<?php if(isset($smsg)) { ?><div class="alert alert-success" role="alert"><?php echo $smsg; ?> <a href=<?php echo $logoutURL ?>>Log Out</a></div>
        <?php }?>
        <?php if(isset($fmsg)) {     ?><div class="alert alert-danger" role="alert"><?php echo $fmsg; ?> </div>
        <?php }?>
		<form class="form-signin" method="POST">
	    	<h2 class="form-signin-heading">Please Login</h2>
	    	<div class="input-group">
				<label for="inputEmail" class="sr-only">Email</label>
				<input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
			    <label for="inputPassword" class="sr-only">Password</label>
			    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
			    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
			    <a class="btn btn-lg btn-primary btn-block" href="Register.php">Request Access</a>
			</div>
	    </form>
	</div>
<!-- TODO Create a request form -->
</body>
</html>
