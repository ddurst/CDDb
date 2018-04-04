<?php
	session_start(); 
	
	if(isset($_POST["buttonClicked"])) {
		switch ($_POST["buttonClicked"]) {
	        case "accept":
	            $_SESSION['opinion']=1;
	            include('connect.php');
	            $param1 = $_SESSION['opinion'];
	            $param2 = $_SESSION['returnToArg'];
	            $param3 = $_SESSION['profile'];
				$sql = "CALL assertOpinion($param1,$param2,$param3)";
				mysqli_query($conn, $sql);
				mysqli_close($conn);	            
	            header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
	            break;
	        case "reject":
	            $_SESSION['opinion']=-1;
	            include('connect.php');
	            $param1 = $_SESSION['opinion'];
	            $param2 = $_SESSION['returnToArg'];
	            $param3 = $_SESSION['profile'];
				$sql = "CALL assertOpinion($param1,$param2,$param3)";
				mysqli_query($conn, $sql);
				mysqli_close($conn);
	            header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
	            break;
	        case "weighBecause":
	        	$_SESSION['expand']="because";
	        	header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
	            break;
	        case "weighSo":
	        	$_SESSION['expand']="so";
	        	header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
	            break;
	        case "weighRebuttal":
	        	$_SESSION['expand']="refute";
	        	header("location: CDDb_working.php?arg=1"); //TODO Session currentArg
	            break;		}

	}
	else
		echo "ERROR<br>";
 ?>