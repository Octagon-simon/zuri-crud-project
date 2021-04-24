<?php
// MYSQL CONNECTION

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "ivg_crud";

$link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if (!$link){
   echo "Database Connection Failed" ;
   die (mysqli_connect_error());
}
