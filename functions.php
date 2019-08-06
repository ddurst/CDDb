<?php
	session_start(); 
	header("Content-Type: text/html; charset=ISO-8859-1"); //insure symbols in text are recognized.
	if(isset($_POST["buttonClicked"])) {
		switch ($_POST["buttonClicked"]) {
	        case "accept":
	            $_SESSION['opinion']=1;
	            include('connect-local-google.php');
	            $param1 = $_SESSION['opinion'];
	            $param2 = $_SESSION['currentArg'];
	            $param3 = $_SESSION['profile'];
				$sql = "CALL assertOpinion($param1,$param2,$param3)";
				mysqli_query($conn, $sql);
				mysqli_close($conn);	
	            header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
	            break;
	        case "reject":
	            $_SESSION['opinion']=-1;
	            include('connect-local-google.php');
	            $param1 = $_SESSION['opinion'];
	            $param2 = $_SESSION['currentArg'];
	            $param3 = $_SESSION['profile'];
				$sql = "CALL assertOpinion($param1,$param2,$param3)";
				mysqli_query($conn, $sql);
				mysqli_close($conn);
	            header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
	            break;
	        case "weighBecause":
	        	$arrayOfWeighIns = explode(",",$_POST["becauseWeighInWith"]);
	            include('connect-local-google.php');
	            $type = "Because";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL prepareForNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";

				for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
					$supportArgVal = intval($arrayOfWeighIns[$i]);
					$weightVal = floatval($arrayOfWeighIns[$i+1]);

					$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
				}
				$query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				/*Testing so commenting out. Gonna print to screen for a bit.
				if(mysqli_multi_query($conn, $query)){
					mysqli_close($conn);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
				*/
	            break;
	        case "weighTherefore":
	        	$arrayOfWeighIns = explode(",",$_POST["weighInWith"]);
	            include('connect-local-google.php');
	            $type = "Therefore";
	            $argAtHand = intval($_SESSION['currentArg']);
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
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
	            
	            break;
	        case "weighRebuttal":
	        	$arrayOfWeighIns = explode(",",$_POST["weighInWith"]);
	            include('connect-local-google.php');
	            $type = "Rebuttal";
	            $argAtHand = intval($_SESSION['currentArg']);
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
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
	            
	            break;
	        case "becauseAddAssertion":
	        	$assertion = $_POST["becauseAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Because";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL foldInAssertion(\"".$assertion."\",\"".$type."\",".$argAtHand.",".$profileID.");";

				/*Execute queries */
				if(mysqli_query($conn, $query)){
					mysqli_close($conn);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
	            
	            break;
	        case "thereforeAddAssertion":
	        	$assertion = $_POST["becauseAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Therefore";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL foldInAssertion(\"".$assertion."\",\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				if(mysqli_query($conn, $query)){
					mysqli_close($conn);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($conn);
	            
	            break;
	        case "rebuttalAddAssertion":
	        	$assertion = $_POST["becauseAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Rebuttal";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL foldInAssertion(\"".$assertion."\",\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				if(mysqli_query($conn, $query)){
					mysqli_close($conn);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
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
