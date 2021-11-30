<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Athletes PHP</title>
<style>
body{ /*Sets the background color to a light grey (easy on the eyes)*/
  background-color: #696969;}
  
table.table{ /* Creates a table class in CSS so the table follows said design */ 
	border-collapse: collapse;
	font-size:1.1em;
	font-family: sans-serif;
	text-align:center;
	width:60%;
	margin: 25px 0;
	box-shadow: 0 0 40px rgba(0, 0, 0, 0.5);
	margin-left:auto;
	margin-right:auto;
	border-style:ridge;
	border-width:0.5em;
	border-color:#FF8C00;}

th.thead{ /* Sets design for the table head */
	border-style:outset;
	border-width:0.15em;
	border-color:#FF8C00;
	color: #ffffff;
	background-color:#009879;}

td.cells{ /* Sets design for the cells class */
	padding: 13px 16px;
	border-style:outset;
	border-width:0.15em;
	border-color:#FF8C00;
	background-color:#40E0D0;}

	

</style>
</head>
<body>
<div> 
  <h3>Cyclist Table</h3>
  <hr>
</div>
	

<?php

$countryId = $_REQUEST['country_id'];
$partName = $_REQUEST['part_name'];
$servername='localhost';
$username = 'coa123cycle';
$password = 'bgt87awx';
$dbname='coa123cdb';



$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT Cyclist.name, Cyclist.gender, Cyclist.height, Cyclist.weight FROM Country INNER JOIN Cyclist WHERE Cyclist.ISO_id = '$countryId' AND Country.ISO_id = '$countryId' AND Cyclist.name LIKE '%$partName%'";

//Cyclist.ISO_id = '$countryId'AND Country.ISO_id = '$countryId' AND Cyclist.name LIKE '%partName%'
$result = mysqli_query($conn, $sql);

echo "<table class = 'table'>"; 
echo '<thead>';
echo '<tr>';
echo "<th class='thead'> name </th>";
echo "<th class='thead'> gender </th>";
echo "<th class='thead'> bmi </th>";
echo '</tr>';
echo '</thead>';

for($i=0;$i<mysqli_num_rows($result);$i++){
	$row = mysqli_fetch_array($result);
	echo '<tr>';
	echo "<td class='cells'>".$row['name'].'</td>';
	echo "<td class='cells'>".$row['gender'].'</td>';
	$bmi = round($row['weight']/(($row['height']/100)*($row['height']/100)),3);
	echo "<td class='cells'>".$bmi.'</td>';	
	echo '</tr>';
}

echo '</tbody>';
echo "</table>";

?>
</body>
</html>