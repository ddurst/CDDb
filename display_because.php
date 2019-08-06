<?php
  $servername = "cddb.crxj3ral4zod.us-east-2.rds.amazonaws.com";
  $username = "craigdanz";
  $password = "#4#Hi1bmf";
  $dbname = "CDDb";
  // Create connection
  $conn = mysqli_connect($servername,
  $username, $password, $dbname);
  // Check connection
  if (!$conn) {
    die("Connection failed: " .
    mysqli_connect_error());
  }
  $sql = "SELECT SUM(E.weight) / 
    ( SELECT COUNT(DISTINCT profileID) 
      FROM ENDORSE 
      WHERE targArgID = $queryStringArgID
        AND endorseType = 'Because') AS aggWeight, 
    E.supportingArgID, Ph.phrasing
      FROM ENDORSE E, PHRASING Ph
        WHERE Ph.argumentID = E.supportingArgID 
      AND E.targArgID = $queryStringArgID
      AND E.endorseType = 'Because'
    GROUP BY E.supportingArgID
    ORDER BY aggWeight DESC";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo "<table border = '0'>\n";
    // output data of each row
    echo "<tr>\n";
  while($row = mysqli_fetch_row($result)) {
     echo "<tr>\n";  
      echo "<td align=right>" . number_format($row[0],2) . "%" . "</td>\n";
      echo "<td>" .    . "</td>\n";
    echo "</tr>\n";
  }

    echo "</table>\n";
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
?>