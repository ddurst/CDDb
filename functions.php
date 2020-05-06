<?php session_start();
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
				mysqli_query($mysqli, $sql);
				mysqli_close($mysqli);	
	            header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
	            break;
	        case "reject":
	            $_SESSION['opinion']=-1;
	            include('connect-local-google.php');
	            $param1 = $_SESSION['opinion'];
	            $param2 = $_SESSION['currentArg'];
	            $param3 = $_SESSION['profile'];
				$sql = "CALL assertOpinion($param1,$param2,$param3)";
				mysqli_query($mysqli, $sql);
				mysqli_close($mysqli);
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
				if(mysqli_multi_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            break;
	        case "weighTherefore":
	        	$arrayOfWeighIns = explode(",",$_POST["thereforeWeighInWith"]);
	            include('connect-local-google.php');
	            $type = "Therefore";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL prepareForNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";

				for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
					$supportArgVal = intval($arrayOfWeighIns[$i]);
					$weightVal = floatval($arrayOfWeighIns[$i+1]);
					if($i == 0){
						$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
					else {
						$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
				}
				$query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
				
				echo $query;
				/*Execute queries */
				if(mysqli_multi_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	        case "weighRebuttal":
	        	$arrayOfWeighIns = explode(",",$_POST["rebuttalWeighInWith"]);
	            include('connect-local-google.php');
	            $type = "Rebuttal";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL prepareForNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";

				for ($i = 0; $i < (count($arrayOfWeighIns)-2); $i+=2) {
					$supportArgVal = intval($arrayOfWeighIns[$i]);
					$weightVal = floatval($arrayOfWeighIns[$i+1]);
					if($i == 0){
						$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
					else {
						$query .= "INSERT INTO ENDORSEMENT VALUES(".$argAtHand.",".$profileID.",\"".$type."\",".$supportArgVal.",".$weightVal.",CURRENT_TIMESTAMP,CURRENT_TIMESTAMP,TRUE);";
					}
				}
				$query .= "CALL resolveOldWithNewEndorse(\"".$type."\",".$argAtHand.",".$profileID.");";
				
				echo $query;
				/*Execute queries */
				if(mysqli_multi_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	        case "becauseAddAssertion":
	        /*TODO can't handle special characters. They fail and show up with blank phrasing.	
	        	MySQL recognizes the following escape sequences.
					\0     An ASCII NUL (0x00) character.
					\'     A single quote (“'”) character.
					\"     A double quote (“"”) character.
					\b     A backspace character.
					\n     A newline (linefeed) character.
					\r     A carriage return character.
					\t     A tab character.
					\Z     ASCII 26 (Control-Z). See note following the table.
					\\     A backslash (“\”) character.
					\%     A “%” character. See note following the table.
					\_     A “_” character. See note following the table.
			*/
	        	$assertion = $_POST["becauseAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Because";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL foldInAssertion(\"".$assertion."\",\"".$type."\",".$argAtHand.",".$profileID.");";

				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	            //TODO THIS IS NOT NEARLY DONE - YOU HAVE AN UNTESTED SQL STORED PROCEDURE
	            //Make the button pass the arg ID
	        case "becauseUseInstead": 
	        	$existing = $_POST["becauseUseInstead"]; 
	            include('connect-local-google.php');
	            $type = "Because";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL useInstead(\"".$type."\",".$argAtHand.",".$existing.",".$profileID.");";

				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	        case "thereforeAddAssertion":
	        	$assertion = $_POST["thereforeAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Therefore";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL foldInAssertion(\"".$assertion."\",\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	        	//TODO THIS IS NOT NEARLY DONE - YOU HAVE AN UNTESTED SQL STORED PROCEDURE
	            //Make the button pass the arg ID
	        case "thereforeUseInstead": 
	        	$existing = $_POST["thereforeUseInstead"]; 
	            include('connect-local-google.php');
	            $type = "Therefore";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL useInstead(\"".$type."\",".$argAtHand.",".$existing.",".$profileID.");";

				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	        case "rebuttalAddAssertion":
	        	$assertion = $_POST["rebuttalAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Rebuttal";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL foldInAssertion(\"".$assertion."\",\"".$type."\",".$argAtHand.",".$profileID.");";
				
				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	        	//TODO THIS IS NOT NEARLY DONE - YOU HAVE AN UNTESTED SQL STORED PROCEDURE
	            //Make the button pass the arg ID
	        case "rebuttalUseInstead": 
	        	$existing = $_POST["rebuttalUseInstead"]; 
	            include('connect-local-google.php');
	            $type = "Rebuttal";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL useInstead(\"".$type."\",".$argAtHand.",".$existing.",".$profileID.");";

				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	        	//Promote existing but not currently leading way of putting this forth.
            case "promotePutForth":
            	$preferredPutForth = $_POST["promotePutForth"]; 
	            include('connect-local-google.php');
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL cosignPutForth(".$argAtHand.",".$preferredPutForth.",".$profileID.");";

				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);

            	break;
	            //Submit a new way of putting forth
            case "newPutForth":
            	$phrased = $_POST["newPutForth"]; 
	            include('connect-local-google.php');
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL promotePutForth(".$argAtHand.",".$profileID.",\"".$phrased."\");";

				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);

            	break;

	        //Promote existing mot juste
	        case "promoteMotJuste": 
	        	$preferredPutForth = $_POST["phraseQuibble"];
	        	$preferredMotJuste = $_POST["promoteMotJuste"];

	            include('connect-local-google.php');
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);


	            $query = "CALL cosignMotJuste(".$argAtHand.",".$preferredPutForth.",".$preferredMotJuste.",".$profileID.");";

				//Execute queries
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            break;
	        //Submit new mot juste  
	        case "newMotJuste": 
	        	$preferredPutForth = $_POST["phraseQuibble"];
	        	$phrased = $_POST["newMotJuste"]; 
	            include('connect-local-google.php');
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);
	            
	            $query = "CALL promoteMotJuste(".$argAtHand.",".$preferredPutForth.",".$profileID.",\"".$phrased."\");";

				//Execute queries 
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				
				else 
					echo "Query Failed";
				mysqli_close($mysqli);

	            break;

	            //Promote explication TODO Sucks because just pushing the full link string when should have a int key
	        case "promoteExplication": 
	        	$explicationLink = $_POST["promoteExplication"]; 
	            include('connect-local-google.php');
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $query = "CALL promoteExplication(".$argAtHand.",".$profileID.",\"".$explicationLink."\");";

				/*Execute queries */
				if(mysqli_query($mysqli, $query)){
					mysqli_close($mysqli);
					header('location: CDDB_main.php?arg='.$_SESSION['currentArg']);
				}
				else 
					echo "Query Failed";
				mysqli_close($mysqli);
	            
	            break;
	    }
	}
	else
		echo "ERROR<br>";
 ?>