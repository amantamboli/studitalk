<?php
  $hostname = "localhost";
  $username = "root";
  $password = "komal7781";
  $dbname = "temp";

  $conn = mysqli_connect($hostname, $username, $password, $dbname);
  if(!$conn){
    echo "Database connection error".mysqli_connect_error();
  }
?>
