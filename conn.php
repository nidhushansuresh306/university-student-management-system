<?php
$server = "Localhost";
$username = "root";
$password ="";
$dbname = "ssit";

$conn = mysqli_connect($server,$username,$password,$dbname);

if(!$conn)
{
    echo("not connected");
}

?>