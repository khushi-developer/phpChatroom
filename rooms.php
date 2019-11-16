<?php

//get roomname from link of claim.php window.location
$roomname =$_GET['roomname'];

//connecting to database
include 'db_connect.php';

//Execute sql to check whether room is exists
$sql = "SELECT * FROM `rooms` WHERE roomname='$roomname'";
$result = mysqli_query($conn, $sql);
if($result) // if query is run return true
{
    //check if room is exist or not
    if(mysqli_num_rows($result)==0)
    {
        $message="this room does not exist.try another one";
        echo '<script language="javascript">';
        echo 'alert ("'.$message.'");';
        echo 'window.location="http://localhost/chatroom";';
        echo '</script>';

    }
}
else
{
    echo "Error".mysqli_error($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<!-- Custom styles for this template -->
<link href="css/product.css" rel="stylesheet">

<style>
body {
  margin: 0 auto;
  max-width: 800px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}

.darker {
  border-color: #ccc;
  background-color: #ddd;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.container img {
  float: left;
  max-width: 60px;
  width: 100%;
  margin-right: 20px;
  border-radius: 50%;
}

.container img.right {
  float: right;
  margin-left: 20px;
  margin-right:0;
}

.time-right {
  float: right;
  color: #aaa;
}

.time-left {
  float: left;
  color: #999;
}

.anyClass {
  height: 350px;
  overflow-y: scroll;
}
</style>

</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
  <h5 class="my-0 mr-md-auto font-weight-normal">MyAnonymousChat</h5>
  <nav class="my-2 my-md-0 mr-md-3">
    <a class="p-2 text-dark" href="#">Home</a>
    <a class="p-2 text-dark" href="#">About</a>
    <a class="p-2 text-dark" href="#">contact</a>
  </nav>
</div>

<h2>Chat Messages <?php echo "-". $roomname; ?> </h2>

<div class="container">
<div class="anyClass">
  <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span>
</div>
</div>


<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add message"><br>
<Button class="btn btn-default" name="submitmsg" id="submitmsg">send</Button>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"crossorigin="anonymous"></script>
<script src="http://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>

<script type="text/javascript">
   //if user submits the form
    
    $("#submitmsg").click(function(){
      var clientmsg = $("#usermsg").val();
    $.post("postmsg.php",{text:clientmsg,room:'<?php echo $roomname ?>',ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
    function(data,status){
      document.getElementsByClassName('anyClass')[0].innerHTML = data;});
    return false;
    });

</script>
</body>
</html>
