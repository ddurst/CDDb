<?php
  session_start();
  header("Content-Type: text/html; charset=ISO-8859-1");
  include('connect.php');
  $sql = "SELECT COUNT(profileID) AS phraseVote, phrasing, 
    (SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $currentArgID AND acceptance = TRUE) as accept,
    (SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $currentArgID) as assert, 
    ((SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $currentArgID AND acceptance = TRUE) /
      (SELECT COUNT(acceptance) FROM OPINION WHERE argumentID = $currentArgID)) AS percentAccept
    FROM PHRASING
    WHERE argumentID = $currentArgID AND active = TRUE
    GROUP BY phrasing
    ORDER BY phraseVote DESC
    LIMIT 1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_row($result);
    $rate = number_format($row[4]*100,1);
    $phrasing = $row[1];
    $assertions = $row[3];
    }
  else {
    $rate = 'N/A.N/A';
    $phrasing = 'Invalid Argument Identifier';
    $assertions = 0;
  }
  mysqli_free_result($result);
  $sql = "SELECT COUNT(profileID) AS explicationVote,
    hyperlink, publisher, authorFName, authorLName, title, metaPub, metaName, metaWildcard 
    FROM EXPLICATION
    WHERE argumentID = $currentArgID AND active = TRUE
    GROUP BY hyperlink
    ORDER BY COUNT(profileID) DESC
    LIMIT 1";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_row($result);
    $link = $row[1];
    $pub = $row[2];
    $aFirst = $row[3];
    $aLast = $row[4];
    $title = $row[5];
    }
  else {
    $link = NULL;
    $pub = NULL;
    $aFirst = NULL;
    $aLast = NULL;
    $title = NULL;
  }
  mysqli_free_result($result);
  if (isset($_SESSION['profile'])) { //Get the user's opinion if there is one.
    $profileID = $_SESSION['profile'];
    $sql = "SELECT acceptance 
        FROM OPINION
        WHERE argumentID = $currentArgID
        AND profileID = $profileID";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_row($result);
      if($row[0])
        $_SESSION['opinion']=1;
      else
        $_SESSION['opinion']=-1;
    }
  }
  mysqli_free_result($result);
  mysqli_close($conn);
?>