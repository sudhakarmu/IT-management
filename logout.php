<?php
include('security.php');
require 'database/dbconfig.php';
session_start();
if(isset($_POST['logout_btn']))
{
    $user = $_SESSION['username'];
    session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['ROLE']);
    header('location:login.php');
}

?>