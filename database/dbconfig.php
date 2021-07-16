<?php
$servername = "localhost";

$db_username = "root";

$db_password = "";

$db_name = "project";

$con = mysqli_connect($servername, $db_username, $db_password);

$dbconfig = mysqli_select_db($con,$db_name);

$db = new mysqli($servername,$db_username,$db_password,$db_password);

if($dbconfig)
{
  //  echo "Database Connected";
}
else
{
    echo "Database Connection Failed";
}
?>