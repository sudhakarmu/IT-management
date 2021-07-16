<?php

session_start();
include('database/dbconfig.php');

if($dbconfig)
{
    // echo "Database Connected";
}
else
{
    header('location:database/dbconfig.php');
}

  if(!$_SESSION['username'])
  {
      header('location:login.php');
 }

?>