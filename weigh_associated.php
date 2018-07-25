<?php
  session_start();
  header("Content-Type: text/html; charset=ISO-8859-1");//insure symbols in text are recognized.
  $tooSmall = 20; //The numbers get too small to read at somepoint. What is that point?
  $startingDiameter = 1; 
  include('connect.php');
  $sql = "SELECT SUM(E.weight) / 
    ( SELECT COUNT(DISTINCT profileID) 
      FROM ENDORSEMENT 
      WHERE targArgID = $currentArgID
        AND endorseType = '$endorseType') AS aggWeight, 
    E.supportingArgID, Ph.phrasing, E.endorseType
      FROM ENDORSEMENT E, PHRASING Ph
        WHERE Ph.argumentID = E.supportingArgID 
      AND E.targArgID = $currentArgID
      AND E.endorseType = '$endorseType'
    GROUP BY E.supportingArgID
    ORDER BY aggWeight DESC";
  $result = mysqli_query($conn, $sql);
  $lowCaseEndorseType = strtolower($endorseType);
  if (mysqli_num_rows($result) > 0) {
  		$styleColor = 'neutralCircle';
	    echo "<table border = '0'>\n";
	    // output data of each row
	    echo "<tr>\n";
	  while($row = mysqli_fetch_row($result)) {
	    //Calculate circle diameter based on percent of weight
	  	$diameter = $startingDiameter;
	  	$rateAsString = "";

	    if ($row[0]< 10) $leftOfDec = substr($rateAsString,0,1);
	    else if($row[0] < 100) $leftOfDec = substr($rateAsString,0,2);
	    else $leftOfDec = substr($rateAsString,0,3);

	    echo "<tr>\n";  
	    echo "<td><div style=\"height: 100%; width: 100%; display:flex; justify-content:center; 
	    	align-items: center;\"><button class=\"overlayButtons\" id=\"button" . $row[3] . $row[1] . 
	    	"\" onclick=\"".$lowCaseEndorseType."ClickTheButton(" . $row[1] . ")\"></button></div></td>"; 
	    echo "<td>" . "<a href=" . $baseURL . "?arg=" . $row[1] . ">$row[2]</a>" . "</td>\n";
	    echo "</tr>\n";
	  }
	    echo "</table>\n";
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
?>
