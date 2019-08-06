<?php
  /* Displays the appropriately associated arguments for each of the 3 types. Shows their current weight and accepts the new weights. */
  switch ($endorseType) {
    case 'Because':

      //$tooSmall = 20; **Depricated** The numbers get too small to read at somepoint. What is that point?
      //$result is what $Because is now
      $startingDiameter = 1; 
      $lowCaseEndorseType = strtolower($endorseType);
      $styleColor = 'neutralCircle';
      if (sizeof($because) > 0) {
        foreach ($because as $line) {
          $diameter = $startingDiameter;
          $rateAsString = strval(number_format($line[1],1));
          if ($line[1]< 10) {
            $leftOfDec = substr($rateAsString,0,1);
            $decOnRight = substr($rateAsString,1,2);
          }
          else if($line[1] < 100) {
            $leftOfDec = substr($rateAsString,0,2);
            $decOnRight = substr($rateAsString,2,2);
          }
          else {
            $leftOfDec = substr($rateAsString,0,3);
            $decOnRight = substr($rateAsString,3,2);
          }
          //$line[0] //this is the arg id
          echo "<div class='lineItem'>
            <div id='btnContainer" . $endorseType . $line[0] . "'>";
          //We only want these buttons to do anything if the user has the right to make them work - thus if/then on opinion
          if($_SESSION['opinion'] > 0)
            echo "<button id='displayBtn" . $endorseType . $line[0] . "' onclick='firstClickBecause(" . $line[0] . ")'>".$leftOfDec."<span style=\"font-size:.6em;\">".$decOnRight."%</span></button>";
          else
            echo "<button id='displayBtn" . $endorseType . $line[0] . "' onclick=''>".$leftOfDec."<span style=\"font-size:.6em;\">".$decOnRight."%</span></button>";
          echo "</div>\n
            <div class='assocArgContainer'>
              <div class='assertLink'><a href=" . $baseURL . "?arg=" . $line[0] . ">" . $line[2] . "</a></div>\n
              </div>
          </div>\n";    
        }
      }
      else {
        echo "0 results";
      }
    break;  
    case 'Therefore':
      echo "Therefore Poop";
    break;  
    case 'Rebuttal':
      echo "Rebuttal Poop";
    break;  
  } 

  /* This is what was hard coded onto the mainpage temporarily
    <?php
            foreach ($because as $line) {
              //$line[0] //this is the arg id
              echo "<div class='lineItem'>
                  <div class='acceptRate'>".$line[1]."</div>\n
                  <div class='assertLink'><a href=" . $baseURL . "?arg=" . $line[0] . ">" . $line[2] . "</a></div>\n
                  <div class='bumpButton'><button class='bump' onclick='becauseBump(" . $line[0] . ")'>Bump</button></div>\n
                  <div class='pendingWeight'><div id='calcBecause" . $line[0] . "'>0</div></div>\n
                </div>\n";    
            }
          ?>
  */




  /*How I used to do this on the first rev with overlays - mainly here as a revference and to steal snippets
  session_start();
  header("Content-Type: text/html; charset=ISO-8859-1");//insure symbols in text are recognized.
  print_r($_SESSION);
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
      echo "<td><div style='height: 100%; width: 100%; display:flex; justify-content:center; 
        align-items: center;'><button class='overlayButtons' id='button" . $row[3] . $row[1] . 
        "' onclick='" . $lowCaseEndorseType . "ClickTheButton(" . $row[1] . ")'></button></div></td>"; 
      echo "<td><a href=\"" . $baseURL . "?arg=" . $row[1] . "\">" . $row[2] . "</a></td>\n";
      echo "</tr>\n";
    }
      echo "</table>\n";
  } else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);

*/




/* OG content of this file - this is what was in a file that already existed when I wanted to use this name. Keeping because I'm a hoarder. 

  $selectSQL = 1;
  include('SQLqueries.php');
  if (mysqli_num_rows($result) > 0) {
    $iterator = 0;
    $because = array();
    $therefore = array();
    $rebuttal = array();
    $foobar = array();
    while($row = mysqli_fetch_row($result)) {
      $foobar[$iterator] = array();
      $foobar[$iterator][0] = $row[0];
      $foobar[$iterator][1] = $row[1];
      $foobar[$iterator][2] = $row[2];
      $iterator++;
    }
  }
  else {
    $foobar = array();
    $foobar[0] = array();
    $foobar[0][0] = NULL;
    $foobar[0][1] = NULL; 
    $foobar[0][2] = NULL;

  }
  mysqli_free_result($result);
  mysqli_close($conn);
  */
?>