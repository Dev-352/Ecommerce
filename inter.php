<html><head>

<link rel="stylesheet" type="text/css" href="homepage.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<title>Interfacetwo</title></head>
	<body>
<!--		<div style="position: fixed; top: 0px; width:100%; height: 100px;">	-->
			<form action="http://students.cs.niu.edu/~z1839148/interdone.php">
				<input type="submit" value="Filled Orders" />
			</form>
<!--		</div>		-->



<?php
	include('Login.php');
	$dsn = "mysql:host=courses;dbname=z1912837";
	$pdo = new PDO($dsn, $username, $password);

	$rs = $pdo->query("SELECT id, name, email, address, filled FROM orders");
	if($rs){
                $x = $rs->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
                echo "Database failure!";
        }

	foreach($x as $x)
	{
		if(isset($_POST["filled_id"])){
			if($x["id"] == $_POST["filled_id"]){
				$idsn = "mysql:host=courses;dbname=z1839148";
			        $ipdo = new PDO($dsn, $username, $password);

				$updatesql = "UPDATE orders SET filled = 1 WHERE id =". $_POST["filled_id"];
				$count= $ipdo->exec($updatesql);
//				if ($conn->connect_error) {
 //					die("Connection failed: " . $conn->connect_error);
//				}
//				try{
//					$conn->prepare("UPDATE Orders SET filled = 1 WHERE id =". $_POST["filled_id"]);
//				}
			}
		}

		?>

<?php
        if(!($x["filled"]))
        {
?>

<!-- Script to print the content of a div -->
    <script>
      function printDiv<?php echo $x["id"];?>() {
            var divContents = document.getElementById(<?php echo "\"GFG". $x["id"]. "\"";?>).innerHTML;
            var a = window.open('', '', 'height=auto, width=auto');
            a.document.write('<html>');
            a.document.write('<body > <h1>packinglist<br>');
            a.document.write(divContents);
            a.document.write('</body></html>');
            a.document.close();
            a.print();
        }
    </script>
		<?php
		$hold_total = 0;
//		if(!($x["filled"]))
//		{
			echo "<div id=\"GFG". $x["id"]. "\">";
			echo "<div>";
			echo "<h1>". $x["name"]. "</h1>";
			echo "<h2>". $x["email"]. "</h2>";
			echo "<h2>". $x["address"]. "</h2>";
			echo  "</div>";

			$hold = "SELECT item_id, quantity FROM Item WHERE order_id =". $x["id"];

			$spdo = new PDO($dsn, $username, $password);
			$srs = $spdo->query($hold);
			if($srs){
				$j = $srs->fetchAll(PDO::FETCH_ASSOC);
			}
			else{
				echo "Database failure!";
			}
			echo "<table>";
			echo "<tr>";
			echo "<th width=\"50%\">Description</th>";
			echo "<th width=\"25%\">Quantity</th>";
			echo "<th width=\"25%\">Price</th>";
			echo "</tr>";

			foreach($j as $j)
			{
				$ndsn = "mysql:host=blitz.cs.niu.edu;port=3306;dbname=csci467";
			        $npdo = new PDO($ndsn, "student", "student");

		        	$nrs = $npdo->query("SELECT description, price FROM parts WHERE number =". $j["item_id"]);
			        if($nrs){
	        		        $z = $nrs->fetchAll(PDO::FETCH_ASSOC);
        			}
	        		else{
        			        echo "Database failure!";
			        }
				foreach($z as $z){
					echo "<tr>";
					$items_total = $z["price"] * $j["quantity"];
					echo "<td>". $z["description"]. "</td><td>". $j["quantity"]. "</td><td>$". $items_total.  "</td>";
					echo "</tr>";
					$hold_total += $items_total;
				}
			}
			echo "</table>";
			echo "<h5>". "TOTAL:	". $hold_total. "</h5>"; 


			echo "</div>";

			echo "<input type=\"button\" value=\"Print Packing list\" onclick=". "\"printDiv". $x["id"]. "()\">";

			echo "<form method=\"post\"  action=\"http://localhost/EcomApp/email.php\">";
			echo "<input type=\"hidden\" name=\"email\" value=\"". $x["email"]. "\">";
			echo "<input type=\"submit\" value=\"Ship and Email\">";
			echo "</form>";

			echo "<form method=\"post\" action=\"inter.php\">";
			echo "<input type=\"hidden\" name=\"filled_id\" value=\"". $x["id"]. "\">";
			echo "<input type=\"submit\" value=\"file\">";
			echo "</form>";
//			echo "<input type=\"button\" value=\"blank\" onclick=". "\""
//			echo "<form method=\"post\" action=\"http://localhost/EcomApp/email.php\">";
//			echo "<input type=\"hidden\" name=\"send_email\" value=\"". $x["id"]. "\" />";
//			echo "<input type=\"submit\" value=\"Ship and Email\" />";
//			echo "</form>";
		}
	}
?>
	</body>
</html>
