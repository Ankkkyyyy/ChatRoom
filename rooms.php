<?php

$roomname = $_GET['roomname'];

// connecting it to database

include 'db_connect.php';

//  executing sql to check whether room exist

$sql = "SELECT * FROM `rooms` WHERE roomname ='$roomname' ";
$result = mysqli_query($conn,$sql);
if($result)
{
    //checking if room exist ?
    if(mysqli_num_rows($result)==0)
    {
        $message = "This roomt does not exist. try creating new room";
        echo '<script language="javascript">';
        echo 'alert("'.$message.'");';
        echo 'window.location="http://localhost:7882/chatroom";';
        echo '</script>';
    }
    

}
else{
    echo "Error : ".mysqli_error($conn);
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

.anyClass{
    height:350px;
    overflow-y:scroll;
}

</style>
</head>
<body>
<div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <header class="mb-auto">
          <div>
            <h3 class="float-md-start mb-0">StrangerChatRoom </h3>
            <nav class="nav nav-masthead justify-content-center float-md-end">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
              <a class="nav-link" href="#">Features</a>
              <a class="nav-link" href="#">Contact</a>
            </nav>
          </div>
        </header>
    </div
<h2>Chat Messages -<?php echo $roomname; ?> </h2>

<div class="container">
    <div class="anyClass">
  
  </div>
</div>



<input type="text" class="form-control" name="usermsg" id="usermsg" placeholder="Add Message">
<br>
<button class="btn btn-dark" name="submitmsg" id="submitmsg">Send</button>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" 
integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
 crossorigin="anonymous"></script>

 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

 <script>

// In Every 1 second it is fetching data from htcont.php & putting on the page.
setInterval(runFunction,1000);  
function runFunction(){
 $.post("htcont.php",{room:'<?php echo $roomname ?>'},
        function(data,status)
        {
           document.getElementsByClassName('anyClass')[0].innerHTML = data;
        })   
};

 </script>

<script type="text/javascript">

var input = document.getElementById("usermsg");

input.addEventListener("keyup", function(event) {

  event.preventDefault();
  if (event.keyCode === 13) {
    document.getElementById("submitmsg").click();
  }
});



    // if user submits the form
   
    $("#submitmsg").click(function(){
        var clientmsg = $('#usermsg').val();
  $.post("postmsg.php",{text:clientmsg, room:'<?php echo $roomname?>',ip:'<?php echo $_SERVER['REMOTE_ADDR'] ?>'},
  function(data,status){
      document.getElementsByClassName('anyClass')[0].innerHTML = data;});
  $("#usermsg").val("");
  return false;
  
});


</script>

</body>
</html>