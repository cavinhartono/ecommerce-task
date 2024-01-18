<!DOCTYPE html>
<html lang="en">

<?php include_once("../algoritma/Config.php") ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tranaksi</title>
</head>

<body>
  <?php

  $products = "Tidak ada";

  if (!empty($_POST['submit'])) {
    $carts = $db->prepare("SELECT `carts`.`product_id`, `price`, `carts`.`qty` FROM `products`
                          INNER JOIN `products`.`id` = `carts`.`product_id`
                          WHERE `user_id` = {$_SESSION['auth']}");
    $carts->execute();

    $carts->fetchAll(PDO::FETCH_ASSOC);

    foreach ($carts as $cart) {
      $order = $db->prepare("INSERT INTO orders(`total`, `product_id`, `user_id`) VALUES ()");
      $order->bindParam(":total", ($cart['qty'] * $cart['price']));
      $order->bindParam(":qty", $cart['qty']);
      $order->bindParam(":product_id", $cart['product_id']);
      $order->bindParam(":user_id", $_SESSION['auth']);
      $order->bindParam(":date", date('d:m:Y', strtotime('+2 Days')));

      $order->execute();
    }
  }

  ?>
</body>

<!-- <?php if ($cart->status == 'pending') : ?>
  <span class="text-red-600 bg-red-300 border-red-600 rounded-md">
    Pesanan akan datang ke tujuan
  </span>
<?php else : ?>
  <span class="text-green-600 bg-green-300 border-green-600 rounded-md">
    Pesanan Anda sudah sampai tujuan
  </span>
<?php endif ?> -->

</html>