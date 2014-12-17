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

#lin a
{
  color: white;
}

</style>
</head>

<?php
 


  $name="";
  $pass="";
  $email="";
  $nameErr="";
  $nameStar="";
  $passStar="";
  $passErr="";
  $flag=0;
  

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    

     if(!empty($_POST["myusername"]))
     {
               
     }
     else 
     { 
      $nameErr = "Username is required";
        $nameStar = "*"; $flag=1;
     }



    if(!empty($_POST["mypassword"]))
    {
    

     }
     else
     {
      $passErr = "Password is required";
        $passStar = "*"; $flag=1;
     }

      $host="localhost"; // Host name 
      $username="root"; // Mysql username */
      $password=""; // Mysql password 
      $db_name="fayza_proj"; // Database name 
      $tbl_name="users"; // Table name 
      mysql_connect("localhost", "$username", "$password") or die(mysql_error());
      mysql_select_db("$db_name")or die("cannot select DB");


      $c=0;

      $user = $_POST['myusername'];
      $pass = $_POST['mypassword'];
      if($flag!=1){
      //$encryptpass=md5($pass);

      $newPass =$pass;
  
      session_start();

      $query = "SELECT * FROM $tbl_name where username = '$user' AND password = '$newPass'";
      $r = mysql_query($query);
      $c = mysql_num_rows($r);

      if($c>0)
      {
        $_SESSION['username'] = $row['password'];
          header('Location:addOffer.php');
      }
      else
      {
        $nameErr = "YOU ENTERD WRONG USERNAME AND PASSWORD";
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
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <div id="wrapper-bgbtm">
    <div class="box"> 
    
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
        <p class="para">Login Form </p>
        <b>
        <span class="error"><?php echo $nameErr;?></span><br>
          username: <input name="myusername" type="text"  align="middle">
          <span class="error"><?php echo $nameStar;?></span>
          <br><br>
          <span class="error"><?php echo $passErr;?></span><br>
          password: <input name="mypassword" type="password"  align="middle">
          <span class="error"><?php echo $passStar;?></span>
          <br><br>
             &nbsp;<input type="submit" value="log in ">&nbsp;&nbsp;&nbsp;
          <br><br>
          <div id="lin">
          <a href="register2.php">Register</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="forgetpassword.php">forget password?</a>
          </div>
          </b>
          </form>
    </div>

  </div>
</div>

<div id="endDiv"><p>Copyright<span> &copy; </span>Fayza - Mona | 2014</P></div>

</body>
</html>