<style>
table, th, td
{
  border: 2px solid magenta;
  border-collapse: collapse;
  padding: 5px;
  color: red;
  table-layout:fixed
}

.table
{
    table-layout:fixed;
    width = 100%;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title> Admin Screen </title>
</head>
<body>
    <h1> Welcome to the Administrative Interface! </h1>
    <br>
    <h2>Click the link below to see all orders.</h2>
    <br>
    <a class="btn btn-checkout" href="http://students.cs.niu.edu/~z1912837/inter.php" role="button" aria-pressed="true">View All Orders</a>
    <br>
    <table class="table table-striped">
  <thead>
      <br>
    <tr>
      <th scope="col">Lbs</th>
      <th scope="col">Price Bracket</th>
      
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1-10</th>
      <td>$1-$10 ($1 per Lb.) </td>
      
    </tr>
    <tr>
      <th scope="row">11-20</th>
      <td>$11-$20 ($1 per Lb.)</td>
      
    </tr>
    <tr>
      <th scope="row">21-30</th>
      <td>$21-$30 ($1 per Lb.)</td>
    </tr>
    <tr>
      <th scope="row">31-40</th>
      <td>$31-$40 ($1 per Lb.)</td>
    </tr>
    <tr>
      <th scope="row">41-50</th>
      <td>$41-$50 ($1 per Lb.)</td>
    </tr>
    <tr>
      <th scope="row">51-60</th>
      <td>$51-$60 ($1 per Lb.)</td>
    </tr>
    <tr>
      <th scope="row">61-70</th>
      <td>$61-$70 ($1 per Lb.)</td>
    </tr>
    <tr>
      <th scope="row">71-80</th>
      <td>$71-$80 ($1 per Lb.)</td>
    </tr>
    <tr>
      <th scope="row">81-90</th>
      <td>$81-$90 ($1 per Lb.)</td>
    </tr>
    <tr>
      <th scope="row">91-100</th>
      <td>$91-$100 ($1 per Lb.)</td>
    </tr>

  </tbody>
  <br>
</table>
<br>
<h3>In order to search through orders, click the link below.</h3>
  <a class="btn btn-checkout" href="http://students.cs.niu.edu/~z1912837/interdone.php" role="button" aria-pressed="true">Search Orders by Shipping Basis</a>
</body>
</html>
