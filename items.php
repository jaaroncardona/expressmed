<html>

<head>
	<?php include('style.php'); 
	include('function.php'); 
	$row = retreive_item(); ?>
</head>

<body>
	<table style="border:solid 2px;">
<?php
	
	foreach($row as $r){
			
			echo '<tr style="border:solid 2px;">';
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['itemname']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['generics']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['brand']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['price']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['measurement']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['dosage']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['qty']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['picture']);
				echo '<td style="border:solid 2px;">';
				echo htmlentities($r['itemcategory']);
				echo '<td style="border:solid 2px;">';]
				echo htmlentities($r['itemsubcategory']);
				echo '</td>';
			echo '</tr>';
	}
	'</table>';
?>

</body>

</html>