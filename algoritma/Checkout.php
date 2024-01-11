<?php

require_once('./Config.php');

if (isset($_POST['submit'])) {
  $total = $db->prepare("SELECT `products`.`price` * qty FROM `carts`")->execute();

  $carts = $db->prepare("SELECT * FROM `carts`")->fetchAll(PDO::FETCH_ASSOC);

  $statement = $db->prepare("INSERT INTO orders(`product_id`, `user_id`, `qty`, `total`) VALUES (`:product_id`, `:user_id`, `:qty`, `:total`)");
  $statement->bindParam(":product_id", $carts['product_id']);
  $statement->bindParam(":user_id", $carts['user_id']);
  $statement->bindParam(":qty", $carts['qty']);
  $statement->bindParam(":total", $total);

  if ($statement->execute()) {
    header("Location: ../halaman/cart.php");
  } else {
    echo "Gagal";
  }
}
