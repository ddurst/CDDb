<?php
  session_start();
  header("Content-Type: text/html; charset=ISO-8859-1");//insure symbols in text are recognized.

  include('connect.php');
  $sql = "SELECT SUM(E.weight) / 
    ( SELECT COUNT(DISTINCT profileID) 
      FROM ENDORSEMENT 
      WHERE targArgID = $currentArgID
        AND endorseType = '$endorseType') AS aggWeight, 
    E.supportingArgID, Ph.phrasing
      FROM ENDORSEMENT E, PHRASING Ph
        WHERE Ph.argumentID = E.supportingArgID 
      AND E.targArgID = $currentArgID
      AND E.endorseType = '$endorseType'
    GROUP BY E.supportingArgID
    ORDER BY aggWeight DESC";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    if ($endorseType == 'Because')
      $styleColor = 'beCircle';
    else if ($endorseType == 'Rebuttal')
      $styleColor = 'reCircle';
    else 
      $styleColor = 'soCircle';
    echo "<table border = '0'>\n";
    // output data of each row
    echo "<tr>\n";
  while($row = mysqli_fetch_row($result)) {
            //Calculate circle diameter based on percent of weight
    $diameter = number_format(.7+(($row[0]/100)*5),2);
    //We like the numbers left of the decimal larger than the right so we turn them into two strings
    $leftSize = 2.5*($row[0]/100);
    $rightSize = 1*$row[0]/100;
    if($row[0]<20) $rateAsString = ""; //If the number is too small you can't read it.
    else $rateAsString = strval(number_format($row[0],1));
    if ($row[0]< 10) $leftOfDec = substr($rateAsString,0,1);
    else if($row[0] < 100) $leftOfDec = substr($rateAsString,0,2);
    else $leftOfDec = substr($rateAsString,0,3);
    //if ($row[0] < 10) $rightOfDec = substr($rateAsString,2,1); this is trying to cram too much in.
    //else if($row[0] < 100) $rightOfDec = substr($rateAsString,3,1);
    //else $rightOfDec = substr($rateAsString,4,1);
    echo "<tr>\n";  
      /*With echos, if you wish to use double quotes in HTML you must use single quote echos like so:
      echo '<input type="text">';
    Or you can escape them like so:
      echo "<input type=\"text\">";*/
    echo "<td><div style=\"height: 100%; width: 100%; display:flex; justify-content:center; align-items: center;\"><button type=\"submit\" class=\"circle ".$styleColor."\" name=\"buttonClicked\" value=\"".$styleColor."\" 
           style=\"width: ".$diameter."rem; height: ".$diameter."rem;\">
           <span style=\"font-size: ".$leftSize."rem; letter-spacing: 0px;\">$leftOfDec</span>";
    if($row[0]>=20) echo "<span style=\"font-size: ".$rightSize."rem; letter-spacing: 0px;\">%</span>"; //Only add the percent sign if there is a number before it. 
    echo "</button></div></td>"; 
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