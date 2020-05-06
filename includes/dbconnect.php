<?php
  $config = parse_ini_file('../private/config.ini'); 
  $mysqli = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if($mysqli->connect_error) {
      exit('Error connecting to database'); //Should be a message a typical user could understand in production
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8mb4");
?>
