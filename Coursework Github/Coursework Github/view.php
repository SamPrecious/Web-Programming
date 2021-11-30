<!DOCTYPE html>
<html>
<head>
<style>
body{
  background-color: #999999;}
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
		$(document).ready(function(){
		
		$("#Submit").click(function(){
		
		var firstISOVal = $("#ISO1").val();
		var secondISOVal = $("#ISO2").val();
		var criterionVal = $("#rankingCrit").val();
		var insertedHTML = "<table border=1>";

		$.get("processrequest.php", {firstISO: firstISOVal,secondISO: secondISOVal,criterion: criterionVal},function(responseData){ //Get request to retrieve all data
			
			
			insertedHTML += "<tr>" +	
						"<td>" + responseData[0].country + "</td>"+
						"<td>" + responseData[0].criteria + "</td>"+
						"<td>" + responseData[1].country + "</td>"+
						"<td>" + responseData[1].criteria + "</td>"+
						"</tr>";		
			
			insertedHTML += "</table>";
			$("#serverResponse").html(insertedHTML);


		},"json");

		 
		 
		 });
		 
		 
		$("#Print").click(function(){
		
		var firstISOVal = $("#ISO1").val();
		var secondISOVal = $("#ISO2").val();

		$.get("processrequest.php", {firstISO: firstISOVal,secondISO: secondISOVal,criterion: criterionVal},function(responseData){ //Get request to retrieve all data
			
			
			insertedHTML += "<tr>" +	
						"<td>" + responseData[0].country + "</td>"+
						"<td>" + responseData[0].criteria + "</td>"+
						"<td>" + responseData[1].country + "</td>"+
						"<td>" + responseData[1].criteria + "</td>"+
						"</tr>";		
			
			insertedHTML += "</table>";
			$("#serverResponse").html(insertedHTML);


		},"json");

		 
		 
		 });
		 
		
		 
		 
		});		
			      
</script>

<title>View PHP</title>
</head>

<body>
<?php


?>

<h2>Athlete Selection Programme </h1>
<p>Ajax .get() function call status: <span id="stub1"></span> 	
<p>Venue names and their capacities of venues with capacity equal or more than:</p>
<label for="ISO1">First Country ISO:</label><br>
<input type="text" id="ISO1" name="ISO1"><br>
<label for="ISO2">Second Country ISO:</label><br>
<input type="text" id="ISO2" name="ISO1"><br>	 
<label for="rankingCrit">Ranking Criterion:</label><br>
<select id="rankingCrit">
    <option value="totalMedals">Total Medals</option>
    <option value="gold">Gold Medals</option>
    <option value="noCyclists">Number Of Cyclists</option>
	<option value="avgAge">Average Age</option>
</select><br>	
<button id="Submit">Submit</button>
<button id="Print">Print CycList</button>

<div id = "serverResponse"></div>

<p id="stub2"></p> 
  
</body>
</html>
