<?php
session_start();

if( !isset( $_SESSION["loggedIn"] ) )
{
    header( "Location: login.php" );
}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Project Acid Rain</title>
	<meta name="description" content="Project Acid Rain">
	<meta name="author" content="Stephen Quenzer">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script>
	function printPage()
	{
		window.print();
	}
	</script>
	<link rel="stylesheet" href="css/print.css">
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<section id="main">
		<input type="button" value="Print" onclick="printPage()">
		<h2>Displaying 7 results for "Sodium Chloride":</h2>
		<table id="results_spreadsheet">
			<thead>
				<tr>
					<th scope="col">Room</th>
					<th scope="col">Location</th>
					<th scope="col">Quantity
					<th scope="col">Name</th>
					<th scope="col">Amount</th>
					<th scope="col">Manufacturer</th>
					<th scope="col">Date</th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td></th>
					<td></th>
					<td></th>
					<td></th>
					<td></th>
					<td></th>
					<td></th>
				</tr>
			</tfoot>
			<tbody id="results_spreadsheet_body">
				<tr class="odd">
					<td>N / A</td>
					<td>N / A</td>
					<td>N / A</td>
					<td>Sodium Chloride Rock Salt</td>
					<td>N / A</td>
					<td>N / A</td>
					<td>N / A</td>
				</tr>
				<tr>
					<td>36</td>
					<td>Shelf Beside Hood</td>
					<td>N / A</td>
					<td>Sodium Chloride</td>
					<td>250g</td>
					<td>Sigma</td>
					<td>N / A</td>
				</tr>
				<tr class="odd">
					<td>22</td>
					<td>Cabinet B</td>
					<td>N / A</td>
					<td>Sodium Chloride</td>
					<td>400g</td>
					<td>Fisher</td>
					<td>N / A</td>
				</tr>
				<tr>
					<td>22</td>
					<td>Cabinet B</td>
					<td>N / A</td>
					<td>Sodium Chloride</td>
					<td>50g</td>
					<td>Fisher</td>
					<td>N / A</td>
				</tr>
				<tr class="odd">
					<td>22</td>
					<td>Cabinet B</td>
					<td>N / A</td>
					<td>Sodium Chloride</td>
					<td>300g</td>
					<td>Fisher</td>
					<td>N / A</td>
				</tr>
				<tr>
					<td>35</td>
					<td>Storeroom Front Rm</td>
					<td>N / A</td>
					<td>Sodium Chloride 1M</td>
					<td>5ml</td>
					<td>N / A</td>
					<td>N / A</td>
				</tr>
				<tr class="odd">
					<td>35</td>
					<td>Storeroom Inorganic</td>
					<td>N / A</td>
					<td>Sodium Chloride, Rock Salt</td>
					<td>8lbs</td>
					<td>N / A</td>
					<td>N / A</td>
				</tr>
			</tbody>
		</table>
	</section>
</div><!--End Wrapper-->
</body>
</html>