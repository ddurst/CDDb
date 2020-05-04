<?php
function db_connect() {

        // Define connection as a static variable, to avoid connecting more than once 
    static $connection;

        // Try and connect to the database, if a connection has not been established yet
    if(!isset($connection)) {
             // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file('../private/config.ini'); 
        $connection = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
    }

        // If connection was not successful, handle the error
    if($connection === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
        return mysqli_connect_error(); 
    }
    return $connection;
}

// Connect to the database
$connection = db_connect();

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>

<?php
  //Original method - probably came from my first database class
/*
  if (!$conn) {
    $servername = "35.236.54.55";
    $username = "craigdanz";
    $pass = "#4#Hi1bmfsad#4#Hi1bmfsad";
    $dbname = "vestigette";
    // Create connection
    $conn = mysqli_connect($servername,$username,$pass,$dbname);
    // Check connection
    if (!$conn) {
      die("Connection Failed: " . mysqli_connect_error($conn));
    }
  }
*/
//Suggested method by prepared statement tutorial: https://websitebeaver.com/prepared-statements-in-php-mysqli-to-prevent-sql-injection
  

  //config details kept in private folder separate from root directory
  $config = parse_ini_file('../private/config.ini'); 
  $mysqli = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    if($mysqli->connect_error) {
      exit('Error connecting to database'); //Should be a message a typical user could understand in production
    }
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli->set_charset("utf8mb4");


?>


