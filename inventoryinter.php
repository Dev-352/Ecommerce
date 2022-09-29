<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
</html>
<?php

	if(isset($_POST["quantity"])){

		include('Login.php');

		$idsn = "mysql:host=courses;dbname=z1912837";
                $ipdo = new PDO($idsn, $username, $password);
//		echo "UPDATE Inventory SET Quantity = Quantity + ". $_POST["quantity"]. " WHERE InventoryID = ". $_POST["number"]. ";";
                $updatesql = "UPDATE Inventory SET Quantity = Quantity + ". $_POST["quantity"]. " WHERE InventoryID = ". $_POST["number"]. ";";
                $count= $ipdo->exec($updatesql);
		echo "<h2>". $_POST["quantity"]. " added to ". $_POST["description"]. "</h2>";
//		unset($_POST);
	}

	$dsn = "mysql:host=blitz.cs.niu.edu;port=3306;dbname=csci467";
        $pdo = new PDO($dsn, "student", "student");

        $rs = $pdo->query("SELECT number,description,price,weight,pictureURL FROM parts");
        if($rs){
                $x = $rs->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
                echo "Database failure!";
        }

	foreach($x as $x){
		echo "  <form method=\"post\" action=\"inventoryinter.php\"";
                echo  $x["number"];
                echo "\">";

                echo "<div class=\"products\">";

                echo "<img src=\"". $x["pictureURL"]. "\"". " class=\"img-responsive\" />";
                echo "<p>". $x["description"]. "</p><p>$". $x["price"]. "</p><p>". "</p>";

                echo "<input type=\"text\" name=\"quantity\" class=\"form-control\" value=\"1\">";
                echo "<input type=\"hidden\" name=\"number\" value=\"". $x["number"]. "\" />" ;
                echo "<input type=\"hidden\" name=\"description\" value=\"". $x["description"]. "\" />" ;
                echo "<input type=\"submit\" name=\"add_to_inventroy\" style=\"margin-left:5px\" class=\"btn-info\" value=\"Add to Inventory\">";
                echo "  </div></div>"; //products
                echo " </form>";
	}

    
?>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
