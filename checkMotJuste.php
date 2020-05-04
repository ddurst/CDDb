<!--
	**FILE DESCRIPTION**
    	html and php - Interstitial stand in for search functionality. Spits out a table of alternative arguments to use. We want to encourage users to pick existing arguments over creating their own. Having more potential options than those active is helpful - particularly early on before much surveying. 
	**NEEDS**
    	To be replaced by search functionality on the main page. Better methodology for finding indirectly related arguments and for setting priority.
	**WRITTEN BY**
    	Craig Danz - Seattle, WA - Copyright August 6, 2019
-->

	<?php

	//This exists because we don't have search. I wish I didn't need this but it helps with convergence until we have a better solution available
	if(session_status()!=PHP_SESSION_ACTIVE) session_start();
	header("Content-Type: text/html; charset=ISO-8859-1"); //insure symbols in text are recognized.
	$because = $_SESSION['currentBecause'];
	$therefore = $_SESSION['currentTherefore'];
	?>
	<head>
	<link rel="stylesheet" href="CDDb_styles.css">
	</head>

		<div class="argument_cell">
      				<div class="box_header primaryColor">
      			    	<div>
		          			The ideal phrasing for putting forth what this argument should is:
		          		</div>
		          	</div>
		<div class="box_content primaryInvert">

	<?php
		if(isset($_POST["buttonClicked"])) {
	
	        	$putForthID = $_POST["phraseQuibble"];
	            include('connect-local-google.php');
	            $argAtHand = intval($_SESSION['currentArg']);
	            $profileID = intval($_SESSION['profile']);

	            $sql = "SELECT quibbleID, motJuste 
					FROM MOT_JUSTE
			    	WHERE putForthID = $putForthID AND argumentID = $argAtHand";
				$result = mysqli_query($mysqli, $sql);
				$lineColorIterator = 0;


				while($row = mysqli_fetch_row($result)) {
		            if ($lineColorIterator % 2  == 0) { 
		              echo "<div class='lineItem'>";
		            }
		            else{
		              echo "<div class='lineItem2'>";
		            }
		            $lineColorIterator++;

		            echo "<div>" . $row[1] . "</div>\n";
		            
		            

		              echo "<div class=\"choiceHold\"><div class=\"choice\"><div>
		                
		                <form action=\"functions.php\" method=\"POST\">
              			<button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"promoteMotJuste\">Chef's Kiss</button>
              			<input type=\"hidden\" name=\"phraseQuibble\" id=\"phraseQuibble\" value=\"" . $putForthID . "\" /> 
              			<input type=\"hidden\" name=\"promoteMotJuste\" id=\"promoteMotJuste\" value=\"" . $row[0] . "\" /> 
            		</form>


		              </div></div></div></div>";

		             

			        }

			        //TODO FIND WAY TO ADD MotJustes from other put forths to be sure.

				}

		else {
			echo "Query Failed";
		}
		echo "<form action=\"functions.php\" method=\"POST\">
		              <button type=\"submit\" class=\"button shame\" name=\"buttonClicked\" value=\"newMotJuste\">Add</button>
		              <input type=\"text\" size=\"120\" name=\"newMotJuste\" id=\"newMotJuste\" value=\"\" style=\"display: block;\" />
		              <input type=\"hidden\" name=\"phraseQuibble\" id=\"phraseQuibble\" value=\"" . $putForthID . "\" /> 
		            </form>";
		

         

	?>
</div>