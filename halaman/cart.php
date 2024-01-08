<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<?php

require_once('../algoritma/Config.php');
require('../algoritma/auth/Login.php');

session_start();

if (isset($_POST['submit'])) {
  $statement = $db->prepare("INSERT INTO (`user_id`, `product_id`, `out`) FROM `transactions` VALUES (:user_id, :product_id, :out)");
  $statement->bindParam(':product_id', $_POST['product_id']);
  $statement->bindParam(':user_id', $_SESSION['auth']);
  $statement->execute();
}

?>

<body>
  <form action='./payment.php' method='POST'>
    <!-- <button value='$product[id]' name='product_id' class=''>Buy</button> -->
  </form>
</body>

</html>