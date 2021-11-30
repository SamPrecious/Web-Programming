<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Details PHP</title>
<style>
body{ /*Sets the background color to a light grey (easy on the eyes)*/
  background-color: #696969;}
	
h1.fontClass{ /* A set of design rules for the font to follow*/ 
	font-size:2.1em;
	font-family: sans-serif;
	text-align:center;
	margin-left:auto;
	margin-right:auto;;}
.wrong {
	font-size:1.3em;
	font-family: sans-serif;
	
    margin-top: 5px;
    padding: 5px;
    border: 2px solid #666;
    width: auto;
    color: #000000;
}
</style>
</head>
<body>
<div> 
  <h1 class = 'fontClass'>Candidate Details (In JSON Form)</h1>
  <hr>
</div>
	

<?php
function dateConvert($tempDate)
{	
	$date1temp = str_replace("/", "-", $tempDate);
	$convertedDate = date_format(date_create($date1temp),"Y-m-d");
	return($convertedDate);
} 
$date1 = dateConvert($_REQUEST['date_1']);
$date2 = dateConvert($_REQUEST['date_2']);
$servername='localhost';
$username = 'coa123cycle';
$password = 'bgt87awx';
$dbname='coa123cdb';



$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT Cyclist.name, Country.country_name, Country.gdp, Country.population FROM Country INNER JOIN 
Cyclist WHERE Country.ISO_id = Cyclist.ISO_id AND Cyclist.dob between '$date1' and '$date2'";


$result = mysqli_query($conn, $sql);


$allDataArray = array();
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
$allDataArray[] = $row;
}
echo '<div class="wrong">'.json_encode($allDataArray).'</div>'; 

echo json_encode($allDataArray);


?>
</body>
</html>