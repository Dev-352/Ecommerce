<?php
  session_start();
  $num_var = 0;
  $num_ed = 0;
  //print_r($_SESSION['var']);
  foreach ($_SESSION['var'] as $value) {
      $num_var= $value;
    //echo $num_var, "\n";
    }
   
    foreach ($_SESSION['ed'] as $value) {
         $num_ed= $value;
        //echo $num_ed, "\n";
    }
    include('Login.php');

    $zero = 0;
    $idsn="mysql:host=courses; dbname=$username";
    $ipdo=new PDO($idsn, $username, $password);
   
    //$quary = "SELECT LAST_INSERT_ID() FROM orders;";
   // $ids = $ipdo->exec($quary);
    //$ids +=2;
    
    //echo $ids;
    $prepared= "INSERT INTO orders (name, email, address, filled) VALUES ('" .$_POST['name']. "','". $_POST['email']. "','" .$_POST['mail']. "' , 0 );";
    $add = $ipdo->exec($prepared);

    $last_id = $ipdo->lastInsertId();
    $quary = "INSERT INTO Item (order_id, item_id,  quantity) VALUES (".$last_id.",".$num_var.", ".$num_ed.");";
    $add2 = $ipdo->exec($quary);

     $updatesql = "UPDATE Inventory SET Quantity = Quantity - ". $num_ed. " WHERE InventoryID = ". $num_var. ";";
                $count= $ipdo->exec($updatesql);


?>
<!DOCTYPE html>
<html>
<head>
    <title>FINAL PAGE</title>
    <h1>Thank you for buying!!!</h1>
    <p><b>Your order has been processed. An email has be sent to you.</b></P>
    <script>
        var seq = (Math.floor(Math.random() * 1000000000) + 1000000000).toString().substring(1);
        document.write("Authorization number: ", seq);
        
    </script>
   


</head>
</html>