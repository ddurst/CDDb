<?php
  $selectSQL = 1;
  include('SQLqueries.php');
  if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_row($result)) {
      echo "\n#calc" . $row[1] . $row[2] . " {
        background-color: var(--cddbGrey);
        border-color: var(--cddbGrey); 
        font-size: 1rem;
        width: 1rem;
        height: 1rem;            
        }
        \n#weighBtn" . $row[1] . $row[2] . " {
        background-color: var(--cddbGrey);
        border-color: var(--cddbGrey); 
        font-size: 1rem;
        width: 1rem;
        height: 1rem;
        }";
      $diameterShift = .4; //minimum size and amount added to all diamters
      $diameterFactor = 5; //diamter will be this many times bigger than a single rem.
      $diameterSigDigits = 2; //Significant digits. 
      $diameter = number_format($diameterShift+(($row[3]/100)*$diameterFactor),$diameterSigDigits); 
      if ($row[1] == "Because") {
        echo "\n#btnContainer" . $row[1] . $row[2] . " {
          height: $diameter"."rem;
          width: $diameter"."rem;
          border: 0;
          }
          \n#displayBtn" . $row[1] . $row[2] . " {
          display: table-cell;
          vertical-align: middle;
          background-color: var(--cddbBlue);
          color: var(--cddbBlue);
          font-size: $diameter"."rem;
          font-weight: bold;
          letter-spacing: -1px;
          color: transparent;
          border: 0;
          border-radius: 50%;
          height: 100%;
          width: 100%;
          }
          \n#displayBtn" . $row[1] . $row[2] . ":hover {
          background-color: var(--cddbWhite);
          color: var(--cddbBlue);
          }
          \n#displayBtn" . $row[1] . $row[2] . ".neutral {
          display: table-cell;
          vertical-align: middle;
          background-color: var(--cddbGrey);
          color: var(--cddbBlue);
          font-size: $diameter"."rem;
          font-weight: bold;
          letter-spacing: -1px;
          color: transparent;
          border: 0;
          border-radius: 50%;
          height: 100%;
          width: 100%;
          }
          \n#displayBtn" . $row[1] . $row[2] . ".neutral:hover {
          background-color: var(--cddbWhite);
          color: var(--cddbBlue);
          }";
        }
      else if ($row[1] == "Rebuttal") {
        echo "\n#displayBtn" . $row[1] . $row[2] . " {
          background-color: var(--cddbRed);
          border-color: var(--cddbRed); 
          font-size: 1rem;
          width: $diameter"."rem;
          height: $diameter"."rem;           
          }";
        }
      else if ($row[1] == "Therefore") {
        echo "\n#displayBtn" . $row[1] . $row[2] . " {
          background-color: var(--cddbGreen);
          border-color: var(--cddbGreen); 
          font-size: 1rem;
          width: $diameter"."rem;
          height: $diameter"."rem;          
          }";
        }
      else {
        echo "ERROR - Illegal endorsement type encountered in query";
        }
      }
    }
  else {
    echo "0 results";
  }
  mysqli_free_result($result);
  mysqli_close($conn);
?>