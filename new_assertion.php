<?php
	session_start(); 
	header("Content-Type: text/html; charset=ISO-8859-1"); //insure symbols in text are recognized.
	print_r($_SESSION);
    $_SESSION['assertion'] = $_POST['assertion'];
    include('connect.php');
  	$sql = "SELECT DISTINCT phrasing FROM PHRASING WHERE phrasing NOT IN
		(SELECT Ph.phrasing
	      FROM ENDORSEMENT E, PHRASING Ph
	        WHERE Ph.argumentID = E.supportingArgID 
	      AND E.targArgID = $currentArgID
	      AND E.endorseType = '$endorseType'
          GROUP BY E.supportingArgID)";
	$result = mysqli_query($conn, $sql);
  	if (mysqli_num_rows($result) > 0) {
	    echo "<table border = '0'>\n";
	    // output data of each row
	    echo "<tr>\n";
  		while($row = mysqli_fetch_row($result)) {
		    echo "<tr>\n";  
		    echo "<td>" . $row[0] . "</td>\n";
		        echo "<td>
		        	<form action='functions.php' method="POST">
		              <button type="submit" class="button reAvail" name="original" value=". $row[0] .">Use</button> 
		            </form>
		        </td>"; 
		    echo "</tr>\n";
		}
    echo "</table>\n";
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
    
?>