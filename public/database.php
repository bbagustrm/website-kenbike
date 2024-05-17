<?php 
session_start();

$hostname = "localhost";
$username = "root";
$password = "";
$database_name = "kenbike";


$con = mysqli_connect($hostname,$username,$password,$database_name);

if ($con -> connect_error) {
    echo "database ga konek";
}
