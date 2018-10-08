<?php
  $selectSQL = 1;
  include('SQLqueries.php');
  if (mysqli_num_rows($result) > 0) {
    echo ".weighBtns {
      float: left;
      margin: 0;
      color: var(--cddbWhite);
      font-weight: bold;
      text-align: center;
      border-width: 0;
      border-style: solid;
      border-radius: 50%;
      }\n";
    echo ".displayBtns {
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
      echo "\n#weighBtn" . $row[1] . $row[2] . " {
        background-color: var(--cddbGrey);
        border-color: var(--cddbGrey); 
        font-size: 1rem;
        width: 1rem;
        height: 1rem;           
        }";
      $diameter = number_format(.7+(($row[3]/100)*5),2); /*This could use more explanation and less hard coding*/
      if ($row[1] == "Because") {
        echo "\n#displayBtn" . $row[1] . $row[2] . " {
          background-color: var(--cddbBlue);
          border-color: var(--cddbBlue); 
          font-size: 1rem;
          width: $diameter rem;
          height: $diameter rem;          
          }";
        }
      else if ($row[1] == "Rebuttal") {
        echo "\n#displayBtn" . $row[1] . $row[2] . " {
          background-color: var(--cddbRed);
          border-color: var(--cddbRed); 
          font-size: 1rem;
          width: $diameter rem;
          height: $diameter rem;           
          }";
        }
      else if ($row[1] == "Therefore") {
        echo "\n#displayBtn" . $row[1] . $row[2] . " {
          background-color: var(--cddbGreen);
          border-color: var(--cddbGreen); 
          font-size: 1rem;
          width: $diameter rem;
          height: $diameter rem;          
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