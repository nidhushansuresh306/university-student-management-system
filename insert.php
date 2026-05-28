<?php
$server = "Localhost";
$username = "root";
$password ="";
$dbname = "database";

$conn = mysqli_connect($server,$username,$password,$dbname);

$name = "ram";
$email = "ram@gmail.com";
$phone = "9876543210";
$dpet = "CS";

$insert = mysqli_query($conn,"Insert into student (name,email,phone,dpet)values('$name','$email','$phone','$dpet')");

if($insert)
{
    echo("value inserted");
}
else
{
    echo("value havent inserted yet");
}
?>