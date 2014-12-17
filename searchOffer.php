<html>
<body>
<head>
<title>SHARE A RIDE</title>
<link href="mine.css" rel="stylesheet" type="text/css" media="all" />

<style>.error{color:red;font-size:12px;}</style>
</head>

<?php
/******** check the validation of the form inputs of the course wanted to search *********/
$sou = ""; $souErr = ""; $souStar = ""; $des = ""; $desErr = ""; $desStar = ""; $result = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
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
}

function test_input($data) /**** function to store into php variable ****/
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

$query = "SELECT * FROM $tbl_name WHERE source='$sou' AND destination='$des' OR source='$sou' Or source='$des'";//search in the table for the entered course name and number
$result = mysql_query($query);
$count = mysql_num_rows($result);

?>

<div id="header" class="container">
	<div id="logo">
		<h1><a href="index.php">Share <span>A</span> Ride</span></a></h1>
	</div>
	<div id="menu">
		<ul>
			<li class="active"><a href="index.php">Homepage</a></li>
			<li class="active"><a href="login.php">Post a ride request</a></li>
			<li class="active"><a href="searchOffer.php">Look for a ride</a></li>
		</ul>
	</div>
</div>

<div id="wrapper">
	<div id="wrapper-bgbtm">
		<div class="bordring" style="text-align:left;"> 
		<?php
			if ((isset($_POST['submit'])) && (isset($_POST['sou'])) && (isset($_POST['des']))) { ?>
			<?php }
			else { ?>
			<form id="forma" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				<br><br>
   				<h3>Informations:</h3><br>
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
  
				<br>
				<center>
					<input type="submit" value="Search">
					<input name="reset" type="reset" value="Reset"><br>
				</center>
		      </form>
		      <?php } /*end of else*/ ?>
		</div>

		<br>
		<center>
      <span><big> SEARCH FOR RIDE OFFERS </big></span><br><br>
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
        $count=mysql_num_rows($result);//the number od rows of the result 
        if($count==0){echo"<tr><td colspan='8'> NO RESULTS ! </td></tr>";}//no results found in table
        else{//found and print  
          while($row = mysql_fetch_array($result)) {
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
          <?php } }?>
       </table>
		</center>
	</div>
</div>
<br><br><br>
<div id="endDiv"><p>Copyright<span> &copy; </span>Fayza - Mona | 2014</P></div>



</body>
</html>