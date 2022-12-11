<?php
  $SERVER = 'localhost';
  $USERNAME = 'root';
  $PASSWORD = '';
  $DB = 'pharmacy';

$con = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB);

if(!$con){
    echo "Connection failed";
}

?>