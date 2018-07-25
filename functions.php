<?php
	session_start(); 
	header("Content-Type: text/html; charset=ISO-8859-1"); //insure symbols in text are recognized.
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
	        	$arrayOfWeighIns = explode(",",$_POST["weighInWith"]);
	            include('connect.php');
	            $type = "Because";
	            $argAtHand = intval($_SESSION['returnToArg']);
	            $profileID = intval($_SESSION['profile']);


				for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
					$supportArgVal = intval($arrayOfWeighIns[$i]);
					$weightVal = floatval($arrayOfWeighIns[$i+1]);
					if($i == 0){
						$query = "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
					else {
						$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
				}
				$query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				if(mysqli_multi_query($conn, $query)){
					mysqli_close($conn);
					header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
	            
	            break;
	        case "weighTherefore":
	        		        	$arrayOfWeighIns = explode(",",$_POST["weighInWith"]);
	            include('connect.php');
	            $type = "Therefore";
	            $argAtHand = intval($_SESSION['returnToArg']);
	            $profileID = intval($_SESSION['profile']);


				for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
					$supportArgVal = intval($arrayOfWeighIns[$i]);
					$weightVal = floatval($arrayOfWeighIns[$i+1]);
					if($i == 0){
						$query = "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
					else {
						$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
				}
				$query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				if(mysqli_multi_query($conn, $query)){
					mysqli_close($conn);
					header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
	            
	            break;
	        case "weighRebuttal":
	        		        	$arrayOfWeighIns = explode(",",$_POST["weighInWith"]);
	            include('connect.php');
	            $type = "Rebuttal";
	            $argAtHand = intval($_SESSION['returnToArg']);
	            $profileID = intval($_SESSION['profile']);


				for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
					$supportArgVal = intval($arrayOfWeighIns[$i]);
					$weightVal = floatval($arrayOfWeighIns[$i+1]);
					if($i == 0){
						$query = "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
					else {
						$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
				}
				$query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				if(mysqli_multi_query($conn, $query)){
					mysqli_close($conn);
					header('location: CDDb_working.php?arg='.$_SESSION['returnToArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
	            
	            break;	
	    }
	}
	else
		echo "ERROR<br>";
 ?>
