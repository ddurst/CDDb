<?php
  $baseURL = 'http://localhost/CDDb_main.php';
    /*Associated arguments*/
  $selectSQL = 1;
  include('SQLqueries.php');
  if (mysqli_num_rows($result) > 0) {
    $because = array();
    $therefore = array();
    $rebuttal = array();
    $bIterator = 0;
    $tIterator = 0;
    $rIterator = 0;
    while($row = mysqli_fetch_row($result)) {
      switch ($row[1]) {
          case 'Because':
            $because[$bIterator] = array();
            $because[$bIterator][0] = $row[2];
            $because[$bIterator][1] = $row[3];
            $because[$bIterator][2] = $row[4];
            $bIterator++;
            break;
          case 'Therefore':
            $therefore[$tIterator] = array();
            $therefore[$tIterator][0] = $row[2];
            $therefore[$tIterator][1] = $row[3];
            $therefore[$tIterator][2] = $row[4];
            $tIterator++;
            break;
          case 'Rebuttal':
            $rebuttal[$rIterator] = array();
            $rebuttal[$rIterator][0] = $row[2];
            $rebuttal[$rIterator][1] = $row[3];
            $rebuttal[$rIterator][2] = $row[4];
            $rIterator++;
            break;
      }
    }
  }
  mysqli_free_result($result);
  /*Queries the basic info about argument at hand*/
  $selectSQL = 2;
  include('SQLqueries.php');
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
  /*Creates an array of links to the explications*/
  $selectSQL = 3;
  include('SQLqueries.php');
  //$result = mysqli_query($mysqli, $sql); This got added even though it duplicates a query done on SQL because something wasn't working. Works fine without now but leaving as artifcat in case something kooky arises once again. 
  if (mysqli_num_rows($result) > 0) {
    $iterator = 0;
    $links = array();
    while($row = mysqli_fetch_row($result)) {
      $links[$iterator] = array();
      $links[$iterator][0] = $row[0];
      $links[$iterator][1] = $row[1];
      $links[$iterator][2] = $row[2];
      $links[$iterator][3] = $row[3];
      $links[$iterator][4] = $row[4]; 
      $links[$iterator][5] = $row[5]; 
      $iterator++;
    }
  }
  else {
    $links = array();
    $links[0] = array();
    $links[0][0] = NULL;
    $links[0][1] = NULL;
    $links[0][2] = NULL;
    $links[0][3] = NULL;
    $links[0][4] = NULL;
    $links[0][5] = NULL;
  }
  mysqli_free_result($result);
  /*Users opinion if it exists*/
  if (isset($_SESSION['profile'])) { 
    $selectSQL = 4;
    include('SQLqueries.php');
    //$result = mysqli_query($mysqli, $sql);
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_row($result);
      if($row[0])
        $_SESSION['opinion']=1;
      else
        $_SESSION['opinion']=-1;
    }
  }
  mysqli_free_result($result);
  /*Alternative phrasings*/
  $selectSQL = 5;
  include('SQLqueries.php');
  $result = mysqli_query($mysqli, $sql);
  if (mysqli_num_rows($result) > 0) {
    $iterator = 0;
    $altPhrasings = array();
    while($row = mysqli_fetch_row($result)) {
      $altPhrasings[$iterator] = array();
      $altPhrasings[$iterator][0] = $row[0];
      $altPhrasings[$iterator][1] = $row[1];
      $iterator++;
    }
  }
  mysqli_free_result($result);
  //mysqli_close($mysqli);  //TODO This got removed because it loses the connection for dynamic styling's queury but not sure //why
?>