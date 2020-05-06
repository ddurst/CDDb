<?php
  $config = parse_ini_file('../private/config.ini'); 
  $key = "..ssl/keys/client-key.pem";
  $cert = "..ssl/certs/client-cert.pem";
  $ca = "..ssl/csrs/ca-cert.pem";

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
  try {
      $mysqli = mysqli_connect($config['servername'], $config['username'], $config['password'], $config['dbname']);
  } catch (mysqli_sql_exception $ex) {
      throw new Exception("Can't connect to the database! \n" . $ex);
  }

  mysqli_ssl_set($mysqli, $key, $cert, $ca, NULL, NULL);
  mysqli_set_charset($mysqli, "utf8mb4");
?>

