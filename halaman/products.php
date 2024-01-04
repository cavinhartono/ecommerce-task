<?php
require_once("../algoritma/Config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
</head>

<body>
  <?php

  $products = mysqli_query(mysqli_connect("localhost", "root", "", "clothingshop"), "SELECT `name`, `src`, `price`, `stock`, `desc` FROM products;");
  while ($product = mysqli_fetch_array($products)) {
    echo "
      <h1>$product[name]</h1>
      <p>$product[price], $product[stock]</p>
      <img src='./gambar/$product[src]' />
      $product[desc]
    ";
  }
  ?>
</body>

</html>