<?php 
	if(session_status()!=PHP_SESSION_ACTIVE) session_start();
    //print_r($_SESSION); //Testing
	require_once('connect-local-google.php');
	if(isset($_POST) && !empty($_POST)){
		$email = mysqli_real_escape_string($mysqli, $_POST['email']);
		$_SESSION['email']=$email;
		$password = hash('sha256',$_POST['password'],false);

		$stmt = $mysqli->prepare("SELECT profileID FROM USER_PROFILE WHERE email = ? AND securityCode = ? ");	
   		$stmt->bind_param("ss", $email, $password);
		$stmt->execute();
		$result = $stmt->get_result()->fetch_all(MYSQLI_NUM);

		if ($result[1][0] == NULL) {
			$_SESSION['profile'] = $result[0][0];
			$currentArgID = intval($_GET["arg"]); 
			header('location: CDDb_main.php?arg='.$currentArgID);
		}
		else {
			$fmsg = "Invalid Email/Password";
		}
		if(isset($_SESSION['profile'])){
			$smsg = "User already logged in. ";
			$currentArgID = $_GET["arg"]; 
			$logoutURL = "logout.php?arg=".$currentArgID; 

		}	
			$stmt->close();
	}

		/* Original method used to check login creds.

		$sql = "SELECT * FROM USER_PROFILE WHERE email ='$email' AND securityCode ='$password'";
		$result = mysqli_query($mysqli, $sql);
		$row = mysqli_fetch_row($result);
		if (mysqli_num_rows($result) == 1) {
			$_SESSION['profile'] = $row[0];
			$currentArgID = intval($_GET["arg"]); 
			header('location: CDDb_main.php?arg='.$currentArgID);
		}
		else {
			$fmsg = "Invalide Email/Password";
		}
	}
	if(isset($_SESSION['profile'])){
		$smsg = "User already logged in. ";
		$currentArgID = $_GET["arg"]; 
		$logoutURL = "logout.php?arg=".$currentArgID; 

	}
	mysqli_free_result($result);
  	mysqli_close($mysqli);
  	*/
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
