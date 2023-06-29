<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'chatroom';

// Database connection down here...

$conn = mysqli_connect($servername,$username,$password,$database);
// $conn = mysqli_connect('localhost','root','','chatroom');

// checking connection

if(!$conn)
{
    die('failed to connect...'.mysqli_connect_error());
}

?>