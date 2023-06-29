<?php

// getting the value of post parameter

$room = $_POST['room'];

// checking  for string size
if(strlen($room)>20 or strlen($room<2))
{
    $message = "Please choose a room name between 2 to 20 characters.";
    echo '<script language="javascript">';
    echo 'alert("'.$message.'");';
    echo 'window.location="http://localhost:7882/chatroom";';
    echo '</script>';
}

// checking whether room name is alphanumeric or not..
// else if(!cytpe_alnum($room))
// {
//     $message = "Please choose an alphanumeric room name.";
//     echo '<script language="javascript">';
//     echo 'alert("'.$message.'");';
//     echo 'window.location="http://localhost/chatroom";';
//     echo '</script>';
// }
else{

    // Connect to the database..
    include 'db_connect.php';

}

// echo "let's have a talk";

//  check if room already exist 

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room' ";
$result = mysqli_query($conn,$sql);
if($result)
{
    if(mysqli_num_rows($result) > 0)
    {
        $message = "Please choose a different room name. this room is already claimed.";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost:7882/chatroom";';
        echo '</script>';
    }


else{

    $sql = "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp);";
    if(mysqli_query($conn,$sql))
    {
        $message = "Your Room is ready & you can chat now...";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost:7882/chatroom/rooms.php?roomname='  .$room. '";';
        echo '</script>';
    }
 }
}

else
{
    echo "Error : ".mysqli_error($conn);
}

?>