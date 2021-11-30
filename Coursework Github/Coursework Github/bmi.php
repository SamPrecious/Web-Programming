<!DOCTYPE html>
<html>
<head>
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


<title>BMI PHP</title>
</head>

<body>
<?php
$minWeight = $_REQUEST['min_weight']; //These requests take all the inputs from bmi.html
$maxWeight = $_REQUEST['max_weight'];
$minHeight = $_REQUEST['min_height'];
$maxHeight = $_REQUEST['max_height'];
$weightDiff = $maxWeight - $minWeight;
$colAmount = ($weightDiff / 5) +1;
$heightDiff = $maxHeight - $minHeight;
$rowAmount = ($heightDiff / 5) +1;

echo "<table class='table'>"; //Defines a table under the class table (takes design from said class)
echo '<thead>';
echo '<tr>';
echo "<th class='thead'> Height &#8680 <BR> Weight &#8681 </th>";
for($i=$minHeight;$i<=$maxHeight;$i=$i+5){
	echo "<th class='thead'>".$i.'</th>';
}
echo '</tr>';
echo '</thead>';

echo '<tbody>';
for($i=$minWeight;$i<=$maxWeight;$i=$i+5){
	echo '<tr>';
	echo "<th class='thead'>".$i.'</th>';
	for($j=$minHeight;$j<=$maxHeight;$j=$j+5) {
		
		echo "<td class='cells'>".round($i/(($j/100)*($j/100)),3).'</td>';
		
	}
	echo '</tr>';
}
echo '</tbody>';
echo "</table>";


?>

</body>
</html>
