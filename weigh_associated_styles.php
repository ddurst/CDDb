<?php
  session_start();
  header("Content-Type: text/html; charset=ISO-8859-1");//insure symbols in text are recognized.
 //Pruning --  $tooSmall = 20; //The numbers get too small to read at somepoint. What is that point?
  //Pruning --  $startingDiameter = 1; 
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
    GROUP BY E.supportingArgID
    ORDER BY aggWeight DESC";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
  		    echo ".overlayButtons {
		      float: left;
		      margin: 0;
		      color: var(--cddbWhite);
		      font-weight: bold;
		      text-align: center;
		      border-width: 0;
		      border-style: solid;
		      border-radius: 50%;
		    }\n";
	  while($row = mysqli_fetch_row($result)) {
	  	    echo "\n#button" . $row[3] . $row[1] . " {
		      background-color: var(--cddbGrey);
		      border-color: var(--cddbGrey); 
		      font-size: 1rem;
		      width: 1rem;
		      height: 1rem;           
		    }";
	  }
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
?>