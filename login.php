<?php
session_start();

if(!isset($_SESSION['host']) && !isset($_SESSION['uname']) && !isset($_SESSION['psw']))
{
    ?>

<!DOCTYPE html>
<html>
<style>
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #23a9e1;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
.container1{
    margin: auto;
    margin-top: 10px;
    width: 40%;
    padding: 10px;

    
}
.logo {
  animation: bounceIn 0.6s;
  transform: rotate(0deg) scale(1) translateZ(0);
  transition: all 0.4s cubic-bezier(.8,1.8,.75,.75);
  cursor: pointer;
}

.logo:hover {
  transform: scale(1.1);
}

@keyframes bounceIn {
  0% {
    opacity: 1;
    transform: scale(.3);
  } 

  50% {
    opacity: 1;
    transform: scale(1.05);
  } 

  70% {
    opacity: 1;
    transform: scale(.9);
  }

  100% {
    opacity: 1;
    transform: scale(1);
  }
}
</style>
<body class="container1">

<center style="margin: 40px"><a href="index.php"><img class="logo" src="logo.png" style="width: 100%;margin: auto;"></a></center>



<form action="auth.php" method="POST">
  <div class="imgcontainer">
  </div>

  <div class="container">
    <label><b>HOST</b></label>
    <input type="text" placeholder="Enter HOST/IP ADDRESS" name="host" required>
     <label><b>USERNAME</b></label>
    <input type="text" placeholder="USERNAME" name="uname" required>

    <label><b>PASSWORD</b></label>
    <input type="password" placeholder="Enter Password" name="psw" >
        
    <button type="submit">Login</button>
  </div>

</form>

</body>
</html>

<?php
}
else
{

    header("Location: index.php");
}
?>
