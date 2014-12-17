<html>
<body>
<head>
<title>Scheduling</title>
<link href="mine.css" rel="stylesheet" type="text/css" media="all" />

<style>

.box{
	border: 3px solid #979A97;
    	padding: 5px 5px;
    	text-align: center;
    	border-radius: 50px; /* adding rounded corners*/
    	margin: auto;
    	float: none;
    	width: 300px;
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

</style>
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{



     if(isset($_POST["myusername"]))
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



    if(isset($_POST["mypassword"]))
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

    if(isset($_POST["email"]))
    {
     $email = $_POST["email"];
     if (!preg_match("/^[^0-9][_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $email))
       {
       $emailErr = "enter a correct email ";
       $emailStar = "*"; $flag=1;
       }
     }
     else
     {
     	$emailErr = "email is required";
      	$emailStar = "*"; $flag=1;
     }




function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}


$host="localhost"; // Host name 
$username="fayza_mona"; // Mysql username 
$password="fayza_mona"; // Mysql password 
$db_name="fayza_user"; // Database name 
$tbl_name="users"; // Table name 
 if ($flag != 1){
        $f=0;
		$query = "SELECT * FROM $tbl_name WHERE Email='$email'";
	    $q = "SELECT * FROM $tbl_name WHERE username='$name'";
		$result = mysql_query($query);
		$r = mysql_query($query);
		$count = mysql_num_rows($result);
		$c = mysql_num_rows($r);
   if(count == 1){
   $emailErr = "";
   $emailStar = "*"; $f=1;
  }
  if (c==1)
  {
    $nameErr = "username is already exists ";
    $nameStar = "*"; $f=1;
   }
   
   if (f==0){
    $newPass = md5($pass)
   	$query = "INSERT INTO $tbl_name VALUES ('$name', '$newPass', '$email')";
    header('Location:main.php');
    exit;   
   }
}
?>

<div id="header" class="container">
	<div id="logo">
		<h1><a>schedul<span>ing</span></a></h1>
	</div>
</div>

<div id="wrapper">
	<div id="wrapper-bgbtm">
		<div class="box"> 
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<p class="para">Registration Form </p>
				<b>
				<span class="error"><?php echo $nameErr;?></span><br>
   				username:<input name="myusername" type="text"  align="middle">
   				<span class="error"><?php echo $nameStar;?></span>
   				<br><br>
   				<span class="error"><?php echo $passErr;?></span><br>
   				password:<input name="mypassword" type="password"  align="middle">
   				<span class="error"><?php echo $passStar;?></span>
   				<br><br>
   				<span class="error"><?php echo $emailErr;?></span><br>
                Email: <input name="email" type="email" id="mypassword" class="auto-style1" style="width: 140px; height: 23px;" align="middle">
                <span class="error"><?php echo $emailstar;?></span><br><br>
				<center>
					<input type="submit" value="log in">
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