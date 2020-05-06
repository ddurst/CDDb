<?php
  /* Displays the appropriately associated arguments for each of the 3 types. Shows their current weight and accepts the new weights. */
  switch ($endorseType) {
    case 'Because':
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
            <div class='becauseArgContainer'>
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
      $startingDiameter = 1; 
      $lowCaseEndorseType = strtolower($endorseType);
      $styleColor = 'neutralCircle';
      if (sizeof($therefore) > 0) {
        foreach ($therefore as $line) {
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
            echo "<button id='displayBtn" . $endorseType . $line[0] . "' onclick='firstClickTherefore(" . $line[0] . ")'>".$leftOfDec."<span style=\"font-size:.6em;\">".$decOnRight."%</span></button>";
          else
            echo "<button id='displayBtn" . $endorseType . $line[0] . "' onclick=''>".$leftOfDec."<span style=\"font-size:.6em;\">".$decOnRight."%</span></button>";
          echo "</div>\n
            <div class='thereforeArgContainer'>
              <div class='assertLink'><a href=" . $baseURL . "?arg=" . $line[0] . ">" . $line[2] . "</a></div>\n
              </div>
          </div>\n";    
        }
      }
      else {
        echo "0 results";
      }
    break;  
    case 'Rebuttal':
      $startingDiameter = 1; 
      $lowCaseEndorseType = strtolower($endorseType);
      $styleColor = 'neutralCircle';
      if (sizeof($rebuttal) > 0) {
        foreach ($rebuttal as $line) {
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
          if($_SESSION['opinion'] < 0)
            echo "<button id='displayBtn" . $endorseType . $line[0] . "' onclick='firstClickRebuttal(" . $line[0] . ")'>".$leftOfDec."<span style=\"font-size:.6em;\">".$decOnRight."%</span></button>";
          else
            echo "<button id='displayBtn" . $endorseType . $line[0] . "' onclick=''>".$leftOfDec."<span style=\"font-size:.6em;\">".$decOnRight."%</span></button>";
          echo "</div>\n
            <div class='rebuttalArgContainer'>
              <div class='assertLink'><a href=" . $baseURL . "?arg=" . $line[0] . ">" . $line[2] . "</a></div>\n
              </div>
          </div>\n";    
        }
      }
      else {
        echo "0 results";
      }
    break;
    break;  
  } 
?>