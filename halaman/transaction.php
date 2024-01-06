<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tranaksi</title>
</head>

<body>
  <?php

  $id = empty($_POST['product_id']) ? null : $_POST['product_id'];
  $products = mysqli_query(mysqli_connect("localhost", "root", "", "clothingshop"), "SELECT * FROM products WHERE `id`=$id;");

  var_dump($id);
  ?>
</body>

</html>