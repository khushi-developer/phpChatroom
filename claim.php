<?php
//getting value from post 
$room = $_POST['room'];


//check size of room string
if(strlen($room)>20 or strlen($room)<2)
{
    $message="plase use room name between 2 to 20 characters";
    echo '<script language="javascript">';
    echo 'alert ("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';
}

//check room name is alphanumeric
else if(!ctype_alnum($room))
{
    $message="plase choose alphanumeric room name";
    echo '<script language="javascript">';
    echo 'alert ("'.$message.'");';
    echo 'window.location="http://localhost/chatroom";';
    echo '</script>';

}

//connect to the database
else
{
    //connect to the database
    include 'db_connect.php';
}

//check room is already exist
$sql = "SELECT * FROM `rooms` WHERE roomname='$room'";
$result = mysqli_query($conn,$sql);
if($result)
{
    if (mysqli_num_rows($result) > 0) 
    {
        $message="plase choose different room name. this room is already claimed";
        echo '<script language="javascript">';
        echo 'alert ("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';
    }
    else {
        $sql= "INSERT INTO `rooms` (`roomname`, `stime`) VALUES ('$room', current_timestamp());";
        if(mysqli_query($conn,$sql))
        {
            $message="your room is ready. you can chat now";
            echo '<script language="javascript">';
            echo 'alert ("'.$message.'");';
            echo 'window.location="http://localhost/chatroom/rooms.php?roomname='. $room .'";';
            echo '</script>';
        }
    }
}
else
{
echo "Error".mysqli_error($conn);
}

?>