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
$result = ""; $sche = ""; $contDays2 = 0;

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
$tbl_name="passengers"; // Table name 

// Connect to server and select database.
mysql_connect("localhost", "$username", "$password") or die(mysql_error());
mysql_select_db("fayza_proj")or die("cannot select DB");

if ($flag == 0)//no errors in the form
{
	if($num != 0 && $time != 0 && $days != 0)
	{
		$query = "INSERT INTO $tbl_name VALUES ('$name','$num','$sou','$des','$time', '$days')";
		mysql_query($query);

		$query = "SELECT * FROM $tbl_name";//select all records to print them in the table
		$result = mysql_query($query);
	}
}

/*if ($flag != 1)
{//means no error in the form
	$query = "SELECT * FROM $tbl_name";
	$result = mysql_query($query);
	$count = mysql_num_rows($result);
	if($count==0)
	{/******** if it's the first record then no need to check the conflict, so insert directly *********
		$query = "INSERT INTO $tbl_name VALUES ('$name','$num','$days','$startTime','$endTime','$days2','$startlTime','$endlTime','$quan')";
		mysql_query($query);//insert the data into the table
	}
	else
	{/******* check that lecture time input does not conflict with other lectures time *******
		$query = "SELECT * FROM $tbl_name WHERE lecturesDays = '$days'";
		$result = mysql_query($query);
		$conf1 = 0;
		while($row = mysql_fetch_array($result))
		{
			if($days == $row["lecturesDays"])//other lectures have the exact lecturesDays as input days !
			{
				if(checkConflict($startTime, $endTime, $row["lecturesStarts"], $row["lecturesEnds"]) != 0)//check time conflict with other lectures time at the same days !
				{ //there is a time conflict with other lectures time
					$conf1 = 1;
					$confErr = "Time Conflict with < " . $row["courseName"] . " > !";
				}
			}
			else //no lectures have the exact lecturesDays, need to check days seperately !
			{
				$first = str_split('$days');
				$second = str_split('$row["lecturesDays"]');
				$count1 = count($first);
				$count2 = count($second);
				for($i=0;$i<$count1;$i++)
				{
					for($j=0;$j<$count2;$j++)
					{
						if($first[$i] == $second[$j])
						{
							if(checkConflict($startTime, $endTime, $row["lecturesStarts"], $row["lecturesEnds"]) != 0)
							{ //there is a time conflict with other lectures time
								$conf1 = 1;
								$confErr = "Time Conflict with < " . $row["courseName"] . " > !";
							}
						}
					}
				}
			}
		}
	}
}*/

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
				<li class="active"><a href="searchOffer.php"><b>Look for ride offers</b></a></li>
		</ul>
	</div>
</div>

<div id="wrapper">
	<div id="wrapper-bgbtm">
		<div id="forma" class="bordring" style="text-align:left;">
		        <b> 
				<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<br><br>
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
						<option value="khaldiya">Khaldiya</option>
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

   				Time: <input type="time" name="time" value="<?php echo $time;?>"  placeholder="7am - 1:30pm" size="19"><br>

				<span class="error"><?php echo $daysErr;?></span><br>
				Days:<span class="error"><?php echo $daysStar;?></span>
				<ul>
					<input type="checkbox" name="sun2" value="sun">Sunday<br>
					<input type="checkbox" name="mon2" value="mon">Monday<br>
					<input type="checkbox" name="tues2" value="tues">Tuesday<br>
					<input type="checkbox" name="wed2" value="wed">Wednesday<br>
					<input type="checkbox" name="thur2" value="thur">Thursday
				</ul>
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
			<span><big> POST A RIDE REQUEST </big></span><br><br>
			 <table id="table1">
			 	<tr>
			 		<th>name</th>
			 		<th>number</th>
			 		<th>source</th>
			 		<th>destination</th>
			 		<th>time</th>
			 		<th>days</th>
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