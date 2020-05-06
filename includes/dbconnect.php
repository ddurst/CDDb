<?php
  $config = parse_ini_file('../private/config.ini'); 
  $key = "../client-key.pem";
  $cert = "../client-cert.pem";
  $ca = "../ca-cert.pem";

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  try {
      $mysqli = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);
  } catch (mysqli_sql_exception $ex) {
      throw new Exception("Can't connect to the database! \n" . $ex);
  }

  mysqli_ssl_set($mysqli, $key, $cert, $ca, NULL, NULL);
  mysqli_set_charset($mysqli, "utf8mb4");
?>

