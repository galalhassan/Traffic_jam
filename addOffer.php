<html>
<body>
<head>
<title>SHARE A RIDE</title>
	<link href="mine.css" rel="stylesheet" type="text/css" media="all" />

<style>
.error{
color:red;
font-size:12px;
}

.con{
font-size:17px;
text-decoration:underline;
color:red;
}
 </style>

</head>
<?php
$flag=0; //to check if there is an error in setting form inputs or not !
$name = ""; $nameErr = ""; $nameStar = ""; $num = ""; $numErr = ""; $numStar = "";
$sou = ""; $souErr = ""; $souStar = ""; $des = ""; $desErr = ""; $desStar = "";
$time = ""; $timeErr = ""; $timeStar = ""; $days = ""; $daysErr = ""; $daysStar = "";
$result = ""; $sche = ""; $contDays2 = 0; $pass = ""; $size = ""; $car = ""; $notes = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
     if(isset($_POST["name"]))
     {
    	 $name = test_input($_POST["name"]);
    	 if (!preg_match("/^[A-Za-z ]{3,30}$/",$name))//check if name only contains letters and whitespace
       	 {
       		$nameErr = $nameErr . "Only letters and white space allowed";
       		$nameStar = "*"; $flag=1;
       	 }
     }
     else
     {
     	$nameErr = "Name is required";
      	$nameStar = "*"; $flag=1;
     }
      
    if(isset($_POST["num"]))
    {
     $num = test_input($_POST["num"]);
     if (!preg_match("/(^[6|9|5][0-9]{7})$/",$num))//check if course number syntax is valid
       {
       $numErr = "Invalid phone number";
       $numStar = "*"; $flag=1;
       }
     }
     else
     {
     	$numErr = "Enter your phone number";
      	$numStar = "*"; $flag=1;
     }

     if(isset($_POST["sou"]))
     {
    	 $sou = test_input($_POST["sou"]);
    	 if ($sou == "")//check if name only contains letters and whitespace
       	 {
       		$souErr = $souErr . "Select your start point";
       		$souStar = "*"; $flag=1;
       	 }
     }

     if(isset($_POST["des"]))
     {
    	 $des = test_input($_POST["des"]);
    	 if ($des == "")//check if name only contains letters and whitespace
       	 {
       		$desErr = $desErr . "Select your end point";
       		$desStar = "*"; $flag=1;
       	 }
     }

    if(isset($_POST["sche"]))
    {
    	$sche = test_input($_POST["sche"]);
     	if($sche == "school")
    	{
    		$days = "12345";
    		$time = "7:00am - 1:30pm";
    	}
    	elseif($sche == "public")
    	{
    		$days = "12345";
    		$time = "7:00am - 1:30pm";
    	}
    	elseif($sche == "private")
    	{
    		$days = "12345";
    		$time = "7:00am - 3:30pm";
    	}
    	
    	if($sche == "")
    	{
    		if(!empty($_POST["time"]))
    		{
			$time = test_input($_POST["time"]);
     		/*$time1 = strtotime($startTime);
			$time2 = strtotime($endTime);
			$diff = ($time2 - $time1) / 60;
			if($diff < 50)
			{
			$confErr = "INVALID Lecture Time Duration = " . $diff . " < 50 mins !!";
			$flag=1;
			} 	*/

			$contDays2 = 0;

			if(isset($_POST["sun2"]))
			{
				$days = $days . "1";
				$contDays2++;
			}

			if(isset($_POST["mon2"]))
			{
				$days = $days . "2";
				$contDays2++;
			}
			if(isset($_POST["tues2"]))
			{
				$days = $days . "3";
				$contDays2++;
			}
			if(isset($_POST["wed2"]))
			{
				$days = $days . "4";
				$contDays2++;
			}
			if(isset($_POST["thur2"]))
			{
				$days = $days . "5";
				$contDays2++;
			}
			if($contDays2 == 0)
			{
				$daysErr = "Select days";
				$daysStar = "*";
			}
			}
		}
	}
	if(isset($_POST["sche"])&& $sche == "" && $contDays2 == 0 && empty($_POST["time"]))
    {
      	$timeStar = "*";
      	$timeErr = "Select fixed schedule or input time";
      	$flag=1;
    }

    if(isset($_POST["car"]))
    {
    	$car = test_input($_POST["car"]);
    	if ($car == "")//check if name only contains letters and whitespace
       	{
       		$car = "-";
      	}
    }
    if(isset($_POST["size"]))
    {
    	 $size = test_input($_POST["size"]);
    	 if ($size == "")//check if name only contains letters and whitespace
       	 {
       		$size = "-";
       	 }
    }
    if(isset($_POST["pass"]))
    {
    	 $pass = test_input($_POST["pass"]);
    	 if ($pass == "")//check if name only contains letters and whitespace
       	 {
       		$pass = "-";
       	 }
    }
	
}


function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password
$tbl_name="drivers"; // Table name 

// Connect to server and select database.
mysql_connect("localhost", "$username", "$password") or die(mysql_error());
mysql_select_db("fayza_proj")or die("cannot select DB");

if ($flag == 0)//no errors in the form
{
	if($num != 0 && $time != 0 && $days != 0)
	{
		$query = "INSERT INTO $tbl_name VALUES ('$name','$num','$sou','$des','$time', '$days', '$car', '$size', '$pass')";
		mysql_query($query);

		$query = "SELECT * FROM $tbl_name";//select all records to print them in the table
		$result = mysql_query($query);
	}
}

$query = "SELECT * FROM $tbl_name";//select all records to print them in the table
$result = mysql_query($query);

?>

<div id="header" class="container">
	<div id="logo">
		<h1><a href="index.php">Share <span>A</span> Ride</span></a></h1>
	</div>
	<div id="menu">
		<ul>
				<li class="active"><a href="index.php"><b>Homepage</b></a></li>
				<li class="active"><a href="logout.php"><b>Log out</a></li>
				<li class="active"><a href="searchRequest.php"><b>Look for ride requests</b></a></li>
		</ul>
	</div>
</div>

<div id="wrapper">
	<div id="wrapper-bgbtm">
		<div id="forma" class="bordring" style="text-align:left;">
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<br>
   				<h3>Offer Information :</h3><br>
   				<span class="error"><?php echo $nameErr;?></span><br>
  				Your Name: &nbsp;<input type="text" name="name" value="<?php echo $name;?>">
  				<span class="error"><?php echo $nameStar;?></span>
   				<br>

   				<span class="error"><?php echo $numErr;?></span><br>
   				Phone Number: <input type="text" name="num" value="<?php echo $num;?>">
   				<span class="error"><?php echo $numStar;?></span>
   				<br>

   				<span class="error"><?php echo $souErr;?></span><br>
  				Source:
  					<select name="sou">
  						<option value="">Select...</option>
						<option value="Khaldiya">Khaldiya</option>
						<option value="Shuwaikh">Shuwaikh</option>
						<option value="Kaifan">Kaifan</option>
						<option value="Mubark AlKabeer">Mubark AlKabeer</option>
						<option value="AlAhmadi">AlAhmadi</option>
						<option value="Salmiya">Salmiya</option>
						<option value="Hawalii">Hawalii</option>
					</select>
  				<span class="error"><?php echo $souStar;?></span>
   				<br>

   				<span class="error"><?php echo $desErr;?></span><br>
   				Destination:
  					<select name="des">
  						<option value="">Select...</option>
						<option value="khaldiya">Khaldiya</option>
						<option value="Shuwaikh">Shuwaikh</option>
						<option value="Kaifan">Kaifan</option>
						<option value="Mubark AlKabeer">Mubark AlKabeer</option>
						<option value="AlAhmadi">AlAhmadi</option>
						<option value="Salmiya">Salmiya</option>
						<option value="Hawalii">Hawalii</option>
					</select>
   				<span class="error"><?php echo $desStar;?></span>
   				<br>

   				<span class="error"><?php echo $timeErr;?></span><span class="error"><?php echo $timeStar;?></span><br>

   				Select fixed schedule:
   					<select name="sche">
  						<option value="">Select...</option>
						<option value="school">School</option>
						<option value="public">Public Sector</option>
						<option value="private">Private Sector</option>
					</select><br><br> "OR" custom your schedule...<br>

   				Time: <input type="time" name="time" value="<?php echo $time;?>"  placeholder="7am - 1:30pm" size="19">

				<span class="error"><?php echo $daysErr;?></span><br>
				Days:<span class="error"><?php echo $daysStar;?></span>
				<ul>
					<input type="checkbox" name="sun2" value="sun">Sunday<br>
					<input type="checkbox" name="mon2" value="mon">Monday<br>
					<input type="checkbox" name="tues2" value="tues">Tuesday<br>
					<input type="checkbox" name="wed2" value="wed">Wednesday<br>
					<input type="checkbox" name="thur2" value="thur">Thursday
				</ul>
				OPTIONAL - Car Information<br>
				<select name="car">
					<option value="">Type</option>
					<option value="volvo">Volvo</option>
					<option value="saab">Saab</option>
					<option value="fiat">Fiat</option>
					<option value="audi">Audi</option>
				</select>

				<select name="size">
					<option value="">Size</option>
					<option value="Big">Big</option>
					<option value="Small">Small</option>
					<option value="maduim">Meduim</option>
				</select>

				<select name="pass">
					<option value="">#Passengers</option>
					<option value="2">2</option>
					<option value="2-4">2-4</option>
					<option value="2-10">2-10</option>
					<option value="2-15">2-15</option>
				</select>
				<br>
				<center>
					<input type="submit" value="Submit">
					<input name="reset" type="reset" value="Reset"><br>
				</center>
		      </form>
		      </b>
		</div>
		     

		<br>
		<center>
			<span><big> POST A RIDE OFFER </big></span><br><br>
			 <table id="table1">
			 	<tr>
			 		<th>Name</th>
			 		<th>Number</th>
			 		<th>Source</th>
			 		<th>Destination</th>
			 		<th>Time</th>
			 		<th>Days</th>
			 		<th>Notes</th>
			 	</tr>	
			 	<?php
			 		if($result === FALSE) {
    					die(mysql_error()); // TODO: better error handling
					}
					while($row = mysql_fetch_array($result)) {//print all records in the table
				?>
  				<tr>
    					<td><?php echo $row["name"]; ?></td>
 						<td><?php echo $row["phone"]; ?></td>
    					<td><?php echo $row["source"]; ?></td>
    					<td><?php echo $row["destination"]; ?></td>
    					<td><?php echo $row["time"]; ?></td>
    					<td><?php echo $row["days"]; ?></td>
    					<td>
    						CarType: <?php echo $row["car"];?>
    						<br>Size: <?php echo $row["size"];?>
    						<br>Passengers: <?php echo $row["passengers"];?>
    					</td>
  				</tr>
  				<?php } ?>
			 </table>
			 <br><br><br>
		</center>
	</div>
</div>

<div id="endDiv"><p>Copyright <span>&copy;</span> Fayza - Mona | 2014</P></div>



</body>
</html>