<?php session_start();
	header("Content-Type: text/html; charset=ISO-8859-1"); //insure symbols in text are recognized.
	$because = $_SESSION['currentBecause'];
	$therefore = $_SESSION['currentTherefore'];
	?>
	<head>
	<link rel="stylesheet" href="CDDb_styles.css">
	</head>
	<?php
	if(isset($_POST["buttonClicked"])) {
		switch ($_POST["buttonClicked"]) {
	        case "becauseAddAssertion":
	        	$assertion = $_POST["becauseAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Because";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $sql = "SELECT argumentID, phrasing 
					FROM PHRASING
			    	WHERE active = TRUE AND argumentID != $argAtHand";
				$result = mysqli_query($mysqli, $sql);
				?>
				<div class="argument_cell">
      				<div class="box_header primaryColor">
      			    	<div>
		          			<?php echo "Your unique assertion: \"" . $assertion ."\""; ?></div><div>

		          	<?php

		          	echo "

					<form action=\"functions.php\" method=\"POST\">
              			<button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"becauseAddAssertion\">STICK WITH THIS</button>
              			<input type=\"hidden\" name=\"becauseAddAssertion\" id=\"becauseAddAssertion\" value=\"" . $assertion . "\" /> 
            		</form>

            		"
            			?>
		          			</div></div>
		          			<div class="box_content primaryInvert">


		          	<?php 
		          	//TODO Consider adding the argAtHand's Therefores to follow back as well - may prove relavent and we are guessin here anyway. 
					$argOfMoment = $argAtHand;
					$dragMulitplier = 1;
					$dragBigList = array();
					$resultIt = 0;
					$listIt = -1;
					$listMaxSize = 200;

					echo "The name of the game is convergence.</br></br>If this new assertion is fundemtally different from those available, great, please add it. If your assertion can serve as an improvement upon an existing than please use instead. </br></br>";
					


					//Start by getting all the arguments that may trail with drag calculated not completely sorted and allowing dupes

					while($listIt != count($dragBigList) AND count($dragBigList) < $listMaxSize) { 
						$sql = "SELECT E1.supportingArgID, (SUM(E1.weight)/TotalUsers) * $dragMulitplier AS Drag, P1.currentPhrasing, SUM(E1.weight)/TotalUsers AS AggWeight, E1.targArgID, E1.endorseType
								FROM ENDORSEMENT E1
									JOIN (SELECT targArgID, endorseType, COUNT(DISTINCT profileID) AS TotalUsers
										FROM ENDORSEMENT
										WHERE targArgID = $argOfMoment AND endorseType = '$type'
										GROUP BY endorseType) E2 
									ON E1.endorseType = E2.endorseType
										JOIN (SELECT argumentID, currentPhrasing
											FROM PHRASING) P1
										ON E1.supportingArgID = P1.argumentID
								WHERE E1.targArgID = $argOfMoment
								GROUP BY E1.endorseType, E1.supportingArgID, P1.currentPhrasing
									ORDER BY AggWeight DESC";
						$result = mysqli_query($mysqli, $sql); 
						while($row = mysqli_fetch_row($result)) {
							$dragBigList[$resultIt] = array();
							$dragBigList[$resultIt][0] = $row[0];
							$dragBigList[$resultIt][1] = $row[1];
							$dragBigList[$resultIt][2] = $row[2];
							$resultIt++;
						}
						$listIt++;
						$argOfMoment = $dragBigList[$listIt][0];
						$dragMulitplier = $dragBigList[$listIt][1]/100;
					}

					//I just want to populate this as much as possible so for the remainder of the space I will fill it with any and all arguments that remain.

				$sql = "SELECT * FROM PHRASING";
					$result = mysqli_query($mysqli, $sql); 
					while($row = mysqli_fetch_row($result) AND count($dragBigList) < $listMaxSize) {
						$dragBigList[$resultIt] = array();
						$dragBigList[$resultIt][0] = $row[0];
						$dragBigList[$resultIt][1] = 0;
						$dragBigList[$resultIt][2] = $row[1];
						$resultIt++;
					}
					

					//Now we need a sorted list that is deduped. 
					$bigListLength = count($dragBigList);
					$dragFinalList = array();
					$finalIt = 0;
					//Stolen from stackoverflow, how to sort an array of arrays https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
					$drag = array_column($dragBigList, 1);
					array_multisort($drag, SORT_DESC, $dragBigList);
					//transfer to final list if they meet conditions
					//Apears we have isolated what is broken..
					while($finalIt < $bigListLength){
						$good = TRUE;
						foreach ($because as $item) {
							if ($item[0] == $dragBigList[$finalIt][0]){
								$good = FALSE;
							}
						}
						foreach ($dragFinalList as $item) {
							if ($item[0] == $dragBigList[$finalIt][0]){
								$good = FALSE;
							}
						}
						if ($good == TRUE){
							array_push($dragFinalList, $dragBigList[$finalIt]);
						}
						$finalIt++;
					} 


					if (count($dragFinalList) > 0) { 
			          $lineColorIterator = 0;
			          foreach($dragFinalList as $row) {
			            if ($lineColorIterator % 2  == 0) { 
			              echo "<div class='lineItem'>";
			            }
			            else{
			              echo "<div class='lineItem2'>";
			            }
			            $lineColorIterator++;

			            echo "<div>" . $row[2] . "</div>\n";
			            
			            

			              echo "<div class=\"choiceHold\"><div class=\"choice\"><div>
			                
			                <form action=\"functions.php\" method=\"POST\">
	              			<button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"becauseUseInstead\">USE INSTEAD</button>
	              			<input type=\"hidden\" name=\"becauseUseInstead\" id=\"becauseUseInstead\" value=\"" . $row[0] . "\" /> 
	            		</form>


			              </div></div></div></div>";

			        }

				}

				else {
				echo "0 results";
				}

				echo "</div></div>";
	            break;
	        case "thereforeAddAssertion":
	        	$assertion = $_POST["thereforeAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Therefore";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $sql = "SELECT argumentID, phrasing 
					FROM PHRASING
			    	WHERE active = TRUE AND argumentID != $argAtHand";
				$result = mysqli_query($mysqli, $sql);
				?>
				<div class="argument_cell">
      				<div class="box_header primaryColor">
      			    	<div>
		          			<?php echo "Your unique assertion: \"" . $assertion ."\""; ?></div><div>

		          	<?php

		          	echo "

					<form action=\"functions.php\" method=\"POST\">
              			<button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"thereforeAddAssertion\">STICK WITH THIS</button>
              			<input type=\"hidden\" name=\"thereforeAddAssertion\" id=\"thereforeAddAssertion\" value=\"" . $assertion . "\" /> 
            		</form>

            		"
            			?>
		          			</div></div>
		          			<div class="box_content primaryInvert">


		          	<?php 
		          	//TODO Consider adding the argAtHand's Therefores to follow back as well - may prove relavent and we are guessin here anyway. 
					$argOfMoment = $argAtHand;
					$dragMulitplier = 1;
					$dragBigList = array();
					$resultIt = 0;
					$listIt = -1;
					$listMaxSize = 200;

					echo "The name of the game is convergence.</br></br>If this new assertion is fundemtally differnt from those available, great, please add it. If your assertion can serve as an improvement upon an existing than please use instead. </br></br>";
					//Start by getting all the arguments that may trail with drag calculated not completely sorted and allowing dupes
					while($listIt != count($dragBigList) AND count($dragBigList) < $listMaxSize) { 
						$sql = "SELECT E1.supportingArgID, (SUM(E1.weight)/TotalUsers) * $dragMulitplier AS Drag, P1.currentPhrasing, SUM(E1.weight)/TotalUsers AS AggWeight, E1.targArgID, E1.endorseType
								FROM ENDORSEMENT E1
									JOIN (SELECT targArgID, endorseType, COUNT(DISTINCT profileID) AS TotalUsers
										FROM ENDORSEMENT
										WHERE targArgID = $argOfMoment AND endorseType = '$type'
										GROUP BY endorseType) E2 
									ON E1.endorseType = E2.endorseType
										JOIN (SELECT argumentID, currentPhrasing
											FROM PHRASING) P1
										ON E1.supportingArgID = P1.argumentID
								WHERE E1.targArgID = $argOfMoment
								GROUP BY E1.endorseType, E1.supportingArgID, P1.currentPhrasing
									ORDER BY AggWeight DESC";
						$result = mysqli_query($mysqli, $sql); 
						while($row = mysqli_fetch_row($result)) {
							$dragBigList[$resultIt] = array();
							$dragBigList[$resultIt][0] = $row[0];
							$dragBigList[$resultIt][1] = $row[1];
							$dragBigList[$resultIt][2] = $row[2];
							$resultIt++;
						}
						$listIt++;
						$argOfMoment = $dragBigList[$listIt][0];
						$dragMulitplier = $dragBigList[$listIt][1]/100;
					}


					//I just want to populate this as much as possible so for the remainder of the space I will fill it with any and all arguments that remain.
                $sql = "SELECT * FROM PHRASING";
                    $result = mysqli_query($mysqli, $sql); 
                    while($row = mysqli_fetch_row($result) AND count($dragBigList) < $listMaxSize) {
                        $dragBigList[$resultIt] = array();
                        $dragBigList[$resultIt][0] = $row[0];
                        $dragBigList[$resultIt][1] = 0;
                        $dragBigList[$resultIt][2] = $row[1];
                        $resultIt++;
                    }


					//Now we need a sorted list that is deduped. 
					$bigListLength = count($dragBigList);
					$dragFinalList = array();
					$finalIt = 0;
					//Stolen from stackoverflow, how to sort an array of arrays https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
					$drag = array_column($dragBigList, 1);
					array_multisort($drag, SORT_DESC, $dragBigList);
					//transfer to final list if they meet conditions
					//Apears we have isolated what is broken..
					while($finalIt < $bigListLength){
						$good = TRUE;
						foreach ($therefore as $item) {
							if ($item[0] == $dragBigList[$finalIt][0]){
								$good = FALSE;
							}
						}
						foreach ($dragFinalList as $item) {
							if ($item[0] == $dragBigList[$finalIt][0]){
								$good = FALSE;
							}
						}
						if ($good == TRUE){
							array_push($dragFinalList, $dragBigList[$finalIt]);
						}
						$finalIt++;
					} 
				//Got the array you want now spit it out. 
				if (count($dragFinalList) > 0) { 
                      $lineColorIterator = 0;
                      foreach($dragFinalList as $row) {
                        if ($lineColorIterator % 2  == 0) { 
                          echo "<div class='lineItem'>";
                        }
                        else{
                          echo "<div class='lineItem2'>";
                        }
                        $lineColorIterator++;
                        echo "<div>" . $row[2] . "</div>\n";
                        
                        
                          echo "<div class=\"choiceHold\"><div class=\"choice\"><div>
                            
                            <form action=\"functions.php\" method=\"POST\">
                            <button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"thereforeUseInstead\">USE INSTEAD</button>
                            <input type=\"hidden\" name=\"thereforeUseInstead\" id=\"thereforeUseInstead\" value=\"" . $row[0] . "\" /> 
                        </form>
                          </div></div></div></div>";
                    }
                }
				else {
				echo "0 results";
				}

				echo "</div></div>";
	            break;
	        case "rebuttalAddAssertion":
	        	$assertion = $_POST["rebuttalAddAssertion"];
	            include('connect-local-google.php');
	            $type = "Rebuttal";
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $sql = "SELECT argumentID, phrasing 
					FROM PHRASING
			    	WHERE active = TRUE AND argumentID != $argAtHand";
				$result = mysqli_query($mysqli, $sql);
				?>
				<div class="argument_cell">
      				<div class="box_header primaryColor">
      			    	<div>
		          			<?php echo $assertion; ?></div><div>

		          	<?php

		          	echo "

					<form action=\"functions.php\" method=\"POST\">
              			<button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"rebuttalAddAssertion\">STICK WITH THIS</button>
              			<input type=\"hidden\" name=\"rebuttalAddAssertion\" id=\"rebuttalAddAssertion\" value=\"" . $assertion . "\" /> 
            		</form>

            		"
            			?>
		          			</div></div>
		          			<div class="box_content primaryInvert">


		          	<?php 
		          	//TODO Consider the implications of always pulling a rebuttals rebuttal. This isn't the same as drag. The rebuttal to a rebuttal is likely a different view altogether
					$argOfMoment = $argAtHand;
					$dragMulitplier = 1;
					$dragBigList = array();
					$resultIt = 0;
					$listIt = -1;
					$listMaxSize = 20;

					echo "Favoring convergence over minor variations of thought is critical at this level.</br></br>Review other arguments indirectly associated to ensure you are only adding what is truly unique. </br></br>Select an existing assertion if appropriate - if the phrasing is imprecise you can promote superior wording on its page.</br></br>";
					//Start by getting all the arguments that may trail with drag calculated not completely sorted and allowing dupes
					while($listIt != count($dragBigList) AND count($dragBigList) < $listMaxSize) { 
						$sql = "SELECT E1.supportingArgID, (SUM(E1.weight)/TotalUsers) * $dragMulitplier AS Drag, P1.phrasing, SUM(E1.weight)/TotalUsers AS AggWeight, E1.targArgID, E1.endorseType
								FROM ENDORSEMENT E1
									JOIN (SELECT targArgID, endorseType, COUNT(DISTINCT profileID) AS TotalUsers
										FROM ENDORSEMENT
										WHERE targArgID = $argOfMoment AND endorseType = '$type'
										GROUP BY endorseType) E2 
									ON E1.endorseType = E2.endorseType
										JOIN (SELECT argumentID, phrasing
											FROM PHRASING) P1
										ON E1.supportingArgID = P1.argumentID
								WHERE E1.targArgID = $argOfMoment
								GROUP BY E1.endorseType, E1.supportingArgID, P1.phrasing
									ORDER BY AggWeight DESC";
						$result = mysqli_query($mysqli, $sql); 
						while($row = mysqli_fetch_row($result)) {
							$dragBigList[$resultIt] = array();
							$dragBigList[$resultIt][0] = $row[0];
							$dragBigList[$resultIt][1] = $row[1];
							$dragBigList[$resultIt][2] = $row[2];
							$resultIt++;
						}
						$listIt++;
						$argOfMoment = $dragBigList[$listIt][0];
						$dragMulitplier = $dragBigList[$listIt][1]/100;
					}
					//Now we need a sorted list that is deduped. 
					$bigListLength = count($dragBigList);
					$dragFinalList = array();
					$finalIt = 0;
					//Stolen from stackoverflow, how to sort an array of arrays https://stackoverflow.com/questions/1597736/how-to-sort-an-array-of-associative-arrays-by-value-of-a-given-key-in-php
					$drag = array_column($dragBigList, 1);
					array_multisort($drag, SORT_DESC, $dragBigList);
					//transfer to final list if they meet conditions
					//Apears we have isolated what is broken..
					while($finalIt < $bigListLength){
						$good = TRUE;
						foreach ($rebuttal as $item) {
							if ($item[0] == $dragBigList[$finalIt][0]){
								$good = FALSE;
							}
						}
						foreach ($dragFinalList as $item) {
							if ($item[0] == $dragBigList[$finalIt][0]){
								$good = FALSE;
							}
						}
						if ($good == TRUE){
							array_push($dragFinalList, $dragBigList[$finalIt]);
						}
						$finalIt++;
					} 
				//Got the array you want now spit it out. 
				if (count($dragFinalList) > 0) { 
					echo "<table border = '1'>\n";
				// output data of each row
					echo "<tr>\n";

					foreach($dragFinalList as $row) {
						echo "<tr>\n";
						echo "<td>" . $row[0] . "</td>\n";
						echo "<td>" . $row[1] . "</td>\n";
						echo "<td>" . $row[2] . "</td>\n";
						//Need to verify this button works
						echo "<td>
						<form action=\"functions.php\" method=\"POST\">
	              			<button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"rebuttalUseInstead\">USE INSTEAD</button>
	              			<input type=\"hidden\" name=\"rebuttalUseInstead\" id=\"rebuttalUseInstead\" value=\"" . $row[0] . "\" /> 
	            		</form>
						</td>\n";
						echo "</tr>\n";
					}
				echo "</table>\n";
				}
				else {
				echo "0 results";
				}
				echo "</div></div>";
	            break;
	    }
	}
	else
		echo "ERROR<br>";
 ?>
