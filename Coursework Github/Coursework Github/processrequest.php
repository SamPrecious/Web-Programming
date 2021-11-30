<?php
$servername='localhost';
$username = 'coa123cycle';
$password = 'bgt87awx';
$dbname='coa123cdb';


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$firstISOVal = $_REQUEST["firstISO"];
$secondISOVal = $_REQUEST["secondISO"];
$criterionVal = $_REQUEST["criterion"];

//The following IF statements execute different SQL commands depending on the criteria picked by the user

if($criterionVal == "gold"){
	$sql = "SELECT country_name AS country, $criterionVal AS criteria FROM Country 
	WHERE ISO_id = '$firstISOVal' OR ISO_id = '$secondISOVal' ORDER BY $criterionVal DESC";	
}
else if($criterionVal == "totalMedals"){
	$sql = "SELECT country_name AS country, (gold + silver + bronze) AS criteria FROM Country
	WHERE ISO_id = '$firstISOVal' OR ISO_id = '$secondISOVal' ORDER BY (gold + silver + bronze) DESC";
}
else if($criterionVal == "noCyclists"){
	$sql = "SELECT Country.country_name AS country, COUNT(Cyclist.name) AS criteria FROM Country INNER JOIN Cyclist
	 WHERE Country.ISO_id = '$firstISOVal' AND Cyclist.ISO_id = '$firstISOVal' OR Country.ISO_id = '$secondISOVal' AND Cyclist.ISO_id = '$secondISOVal'
	 GROUP BY Country.ISO_id
	 ORDER BY COUNT(Cyclist.name) DESC";
}
else if($criterionVal == "avgAge"){
	$sql = "SELECT Country.country_name AS country, ROUND(AVG(DATEDIFF(NOW(), Cyclist.dob))/365.25, 3) AS criteria 
	FROM Country INNER JOIN Cyclist
	WHERE Country.ISO_id = '$firstISOVal' AND Cyclist.ISO_id = '$firstISOVal' OR Country.ISO_id = '$secondISOVal' AND Cyclist.ISO_id = '$secondISOVal'
	GROUP BY Country.ISO_id
	ORDER BY COUNT(Cyclist.name) DESC";
	 
	
	 /*
	 SELECT AVG(DATEDIFF(NOW(), dob)) FROM Cyclist
	 DATEDIFF() gives us the days inbetween 2 dates
	 NOW() gives us the current date
	 AVG() returns us an average value of all variables
	 We divide by 365.25 to get the age in years (easier to read)
	 ROUND() with 3 gives us the value in years to 3 decimal places (for accuracy & readability)
	 */
	 
	 //SELECT AVG(DATEDIFF(TO_DAYS(NOW()), TO_DAYS(DOB))) as `Average` FROM Contacts;
}



 
$result = mysqli_query($conn, $sql);
$allDataArray = array();
if (mysqli_num_rows($result) > 0){
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$allDataArray[] = $row;
	}
}
$value = json_encode($allDataArray);



echo $value;

mysqli_close($conn);

?>
