<?php
echo "<html><head><title>ECommerceUserInterface</title></head><body>";
?>



<?php
echo "<!DOCTYPE html>";
echo "<html>";
echo "<title>W3.CSS Template</title>";
echo "<meta charset=\"UTF-8\">";
echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">";
echo "<link rel=\"stylesheet\" href=\"https://www.w3schools.com/w3css/4/w3.css\">";
echo "<link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Roboto\">";
echo "<link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Montserrat\">";
echo "<link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css\">";
echo "<style>";
echo ".w3-sidebar a {font-family: \"Roboto\", sans-serif}";
echo "body,h1,h2,h3,h4,h5,h6,.w3-wide {font-family: \"Montserrat\", sans-serif;}";
echo "</style>";
echo "<body class=\"w3-content\" style=\"max-width:1200px\">";

?>

<?php

echo "<header class=\"w3-container w3-xlarge\">";
echo "<p class=\"w3-left\">Parts</p>";
echo "<p class=\"w3-right\">";
echo "<i class=\"fa fa-shopping-cart w3-margin-right\"></i>";
echo "<i class=\"fa fa-search\"></i>";
echo "</p></header>";


echo "  <div class=\"w3-display-container w3-container\">";
//echo "    <img src=\"https://images.fatherly.com/wp-content/uploads/2020/10/lightning-mcqueen-car.jpg?q=65&enable=upscale&w=600\" alt=\"Parts\" style=\"width:100%\">";
echo "    <img src=\"https://images.pexels.com/photos/70912/pexels-photo-70912.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500\" alt=\"Parts\" style=\"width:100%\">";
echo "    <div class=\"w3-display-topleft w3-text-white\" style=\"padding:24px 48px\">";
//echo "      <h1 class=\"w3-jumbo w3-hide-small\">New arrivals</h1>";
//echo "      <h1 class=\"w3-hide-large \">PARTS! PARTS! PARTS!</h1>";
//echo "      <h1 class=\"w3-hide-small\">COLLECTION 2016</h1>";
echo "      <p><a href=\"#Parts\" class=\"w3-button w3-black w3-padding-large w3-large\">SHOP NOW</a></p></div></div>";?>

<?php
	session_start();
	$product_ids = array();
//	session_destroy();
	//check if add to cart has been sbmitted
	if(filter_input(INPUT_POST, "add_to_cart")){
		if(isset($_SESSION['shopping_cart'])){
			$count = count($_SESSION['shopping_cart']);
		
			//	
			$product_ids = array_column($_SESSION['shopping_cart'], 'id');
		
			if(!in_array(filter_input(INPUT_GET, 'id'), $product_ids)){
				$_SESSION['shopping_cart'][$count] = array
                                (
                                        'id' => filter_input(INPUT_GET, 'id'),
                                        'description' => filter_input(INPUT_POST, 'description'),
                                        'price' => filter_input(INPUT_POST, 'price'),
                                        'quantity' => filter_input(INPUT_POST, 'quantity'),
					'weight' => filter_input(INPUT_POST, 'weight')
                                );
			}
			else{
				for($i = 0; $i < count($product_ids); $i++){
					if($product_ids[$i] == filter_input(INPUT_GET, 'id')){
						//add item quantity to existing product
						$_SESSION['shopping_cart'][$i]['quantity'] += filter_input(INPUT_POST, 'quantity');
					}
				}
			}
		}
		else{ //if shopping cart doesn't exist create first product key 0
			$_SESSION['shopping_cart'][0] = array
				(
					'id' => filter_input(INPUT_GET, 'id'),
					'description' => filter_input(INPUT_POST, 'description'),
					'price' => filter_input(INPUT_POST, 'price'),
					'quantity' => filter_input(INPUT_POST, 'quantity'),
					'weight' => filter_input(INPUT_POST, 'weight')
				);
		}
		//echo "<h>yah boi</h>";
	}

if(filter_input(INPUT_GET, 'action') == 'delete')
{
	foreach($_SESSION['shopping_cart'] as $key => $product){

		if($product['id'] == filter_input(INPUT_GET, 'id')){
			unset($_SESSION['shopping_cart'][$key]);
		}
	}

	$_SESSION['shopping_cart'] = array_values($_SESSION['shopping_cart']);
}

//pre_r($_SESSION);

function pre_r($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>EcommerceUserInterface</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<ling rel="stylesheet" href="Ecommerce.css"/>
	</head>
	<body>

		<div class="container">
<?php
try {
/*
        echo "<style>";
        echo "table { font-family: arial, sans-serif; $order-collapse: collapse; width: 100%;}"; #table styling           
	echo "td, th { border: 1px solid #dddddd; text$align: left; padding: 10px;}";         #table data and hea$        
	echo "tr:nth-child(even) { background-color: #$ddddd;}";
	echo "</style>";
*/
 //       include('secrets.php');
        $dsn = "mysql:host=blitz.cs.niu.edu;port=3306;dbname=csci467";
        $pdo = new PDO($dsn, "student", "student");

        $rs = $pdo->query("SELECT number,description,price,weight,pictureURL FROM parts");
	if($rs){
		$x = $rs->fetchAll(PDO::FETCH_ASSOC);
	}
	else{
		echo "Database failure!";
	}
//	echo "<h1>Free Queue</h1>";
//        echo "<table border=1 cellspacing=2>";
//        echo "<tr><td>FreeID</td><td>Title</td><td>ArtistName</td><td>Version</td>/</tr>";
//	echo \"";



//	echo "<div class=". "\"w3-row w3-grayscale\"". ">";
//	echo "<div class=". "\"w3-col l3 s6\">";
	$a = 2;
	$counterForRow = 1;
	echo "<table>";
////////////////////////////////////////////////////////////
	foreach($x as $x){
		
		echo "<div class=\"col-sm-4 col-md-3\">";

		echo "	<form method=\"post\" action=\"commerce.php?action=add&id=";
		echo  $x["number"];
		echo "\">";

		echo "<div class=\"products\">";

		echo "<img src=\"". $x["pictureURL"]. "\"". " class=\"img-responsive\" />";
		echo "<p>". $x["description"]. "</p><p>$". $x["price"]. "</p><p>". "</p>";

		echo "<input type=\"text\" name=\"quantity\" class=\"form-control\" value=\"1\"";
		echo "<input type=\"hidden\" name=\"description\" value=\"". $x["description"]. "\" />" ;
		echo "<input type=\"hidden\" name=\"price\" value=\"". $x["price"]. "\" />" ;
		echo "<input type=\"hidden\" name=\"weight\" value=\"". $x["weight"]. "\" />" ;
		echo "<input type=\"submit\" name=\"add_to_cart\" style=\"margin-left:5px\" class=\"btn-info\" value=\"Add to Cart\" />";

		echo "	</div></div>"; //products
		echo " </form>";
		echo "</div>"; //col-sm-4 col-md-3
	
        }
//	echo "</table";
	echo "</div>";
}
catch(PDOexception $e) {
        echo "Connection to database failed: ". $e->getMessage();
}
?>

<?php
	echo "<div style=\"clear:both\"></div>";
	echo "<br />";
	echo "<div class=\"table\">";
	echo "<tr><th colspan=\"5\"><h3>CART</h3></th></tr>";
	echo "<tr>";

	echo "<th width=\"40%\">Description</th>";
	echo "<th width=\"10%\">Quantity</th>";
	echo "<th width=\"20%\">Price</th>";
	echo "<th width=\"15%\">Total</th>";
	echo "<th width=\"5%\">Action</th>";
	echo "</tr>";

	if(!empty($_SESSION['shopping_cart'])){

		$total = 0;
		$total_weight = 0;
	}
	//try{
		foreach($_SESSION['shopping_cart'] as $product){
			echo "<tr>";
			echo "<td>". $product["description"]. "</td>";
			echo "<td>". $product["quantity"]. "</td>";
			echo "<td>". $product["price"]. "</td>";

			echo "<td>";
			echo "$". number_format($product['quantity'] * $product['price'], 2);
			echo "</td>";

			echo "<td>";
			echo "<a href=\"commerce.php?action=delete&id=". $product['id']. "\">";
			echo "<div class=\"btn-danger\">Remove</div>";
			echo "</a>";
			echo "</td>";
			echo "</tr>";

			$total_weight += ($product['quantity'] * $product['weight']);
			$total += ($product['quantity'] * $product['price']);
		}

	$total += ($total_weight * 1);
//	echo "<h1>". $total_weight. "</h1>";
	echo "<tr>";
	echo "<td colspan=\"3\" align=\"rigth\">Total</td>";
	echo "<td align=\"right\">";
	echo number_format($total, 2);
	echo "</td>";
	echo "<td></td>";
	echo "</tr>";
	//}
	//catch ($_SESSION['shopping_cart']) {
	//	echo "<h1>Nothing In cart, Start Shopping Now!!";
	//}
	
if($total > 0){


echo "<form action=\"creditcard/index.php\" method=\"post\">";
$var =  array();
$ed = array();
//array_push($var, "");

foreach($_SESSION['shopping_cart'] as $product){
	//echo "<intput type=\"hidden\" name=\"item". $product["id"]. "\" value=\"". $product["id"]. "\"/>";
	//echo "<intput type=\"hidden\" name=\"quan". $product["id"]. "\" value=\"". $product["quantity"]. "\"/>";
	array_push($var, $product["id"]);
	array_push($ed, $product["quantity"]);
	//echo "<input type=\"hidden\" name=\"id" value="serialize($var)"/>;
	//echo "Forename: <input type=\"hidden\" name="$var[]">"; 
	//echo "Surname: <input type=\"hidden\" name="$ed[]">";
	$_SESSION["var"] = $var;
	$_SESSION["ed"] = $ed;

	
}
echo "<intput type=\"hidden\" name=\"total\" value=\"". $total. "\"/>";
echo "<input type=\"submit\" name=Checkout value=\"Checkout\"/>";
echo "</form>";
}
echo "</div>";
echo "</body></html>";
?>
