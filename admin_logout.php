<?php 
include ('components/connect.php');

session_start();
session_destroy();

header('location:../listings.php');

?>