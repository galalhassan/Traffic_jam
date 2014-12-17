<html>
<head>
<title>Register</title>
<link href="mine.css" rel="stylesheet" type="text/css" media="all">

<style type="text/css">

.box{
    border: 2px solid #979A97;
    padding: 5px 5px;
    text-align: center;
    border-radius: 5px; /* adding rounded corners*/
    margin-left: 200px;
    margin: auto;
    float: none;
    width: 300px;
    color: white;
}

.para{
  text-transform: uppercase;
  font-weight: 400;
  font-size: 15px;
  color: #FEC709;
  font-style: bold;
  }

.auto-style1 {
	margin-left: 0px;
}

.error{
color:red;
font-size:12px;
}

</style>
</head>

<?php
$host="localhost"; // Host name 
$username="root"; // Mysql username */
$password=""; // Mysql password 
$db_name="fayza_proj"; // Database name 
$tbl_name="users"; // Table name 
mysql_connect("localhost", "$username", "$password") or die(mysql_error());
mysql_select_db("$db_name")or die("cannot select DB");


  $name="";
  $pass="";
  $email="";
  $nameErr="";
  $nameStar="";
  $passStar="";
  $passErr="";
  $flag=0;
  $emailErr ="";
  $emailStar="";
 

function test_input($data)
{    
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    

     if(!empty($_POST["myusername"]))
     {
       $name = test_input($_POST["myusername"]);  
      if (!preg_match("/^[A-Za-z ]{3,30}$/",$name))
       	 {
       		$nameErr = "Only letters and white space allowed";
       		$nameStar = "*"; $flag=1;
       	 }
     }
     else 
     { 
     	$nameErr = "Username is required";
      	$nameStar = "*"; $flag=1;
     }



    if(!empty($_POST["mypassword"]))
    {
     $pass = $_POST["mypassword"];
     if (!preg_match("/^[a-z0-9_-]{6,40}$/i", $pass))
       {
       $passErr = "Password should contain at least 6 characters";
       $passStar = "*"; $flag=1;
       }
     }
     else
     {
     	$passErr = "Password is required";
      	$passStar = "*"; $flag=1;
     }

    if(!empty($_POST["email"]))
    {
     $email = $_POST["email"];
     if (!preg_match("/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
       {
       $emailErr = "Invalid email address";
       $emailStar = "*"; $flag=1;
       }
     }
     else
     {
     	$emailErr = "Email is required";
      	$emailStar = "*"; $flag=1;
     }




 if ($flag != 1){
        $c=0;
        $count=0;
        $f=0;
		$query = "SELECT * FROM $tbl_name WHERE Email='$email'";
	    $q = "SELECT  * FROM $tbl_name WHERE username='$name'";
		$result = mysql_query($query);
		$r = mysql_query($q);
		$count = mysql_num_rows($result);
		$c = mysql_num_rows($r);
   if($count >0){
   //$emailErr = "";
   $emailStar = "*"; $f=1;
   $emailErr = "email is already exists ";
  }
  if ($c>0)
  {
    $nameErr = "username is already exists ";
    $nameStar = "*"; $f=1;
   }
   
   if ($f==0){
     
    $newPass =$_POST['mypassword'];
    $sql = "INSERT INTO $tbl_name (username, Email, password) VALUES ('$name', '$email', '$newPass')";
    if (mysql_query($sql) === TRUE) {
      header('Location:login2.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
    exit;   
   }

}
}
?>
<body>
<div id="header" class="container">
	<div id="logo">
		<h1><a href="index.php">SHARE<span> A </span>RIDE</a></h1>
	</div>
</div>

<div id="wrapper">
	<div id="wrapper-bgbtm">
		<div class="box"> 
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<p class="para">Registration Form </p>
				<b>
				<span class="error"><?php echo $nameErr;?></span><br>
   			Username: <input name="myusername" type="text"  align="middle">
   			<span class="error"><?php echo $nameStar;?></span>
   			<br><br>
   			<span class="error"><?php echo $passErr;?></span><br>
   			Password: <input name="mypassword" type="password"  align="middle">
   			<span class="error"><?php echo $passStar;?></span>
   			<br><br>
   			<span class="error"><?php echo $emailErr;?></span><br>
        Email: <input name="email" type="email" id="mypassword" class="auto-style1" style="width: 140px; height: 23px;" align="middle">
        <span class="error"><?php echo $emailStar;?></span><br><br>
				<center>
					<input type="submit" value="Register">
					<input name="reset" type="reset" value="Reset"><br>
				</center>
				</b>
		  </form>
		</div>

	</div>
</div>

<div id="endDiv"><p>Copyright<span> &copy; </span>Fayza - Mona | 2014</P></div>

</body>
</html>