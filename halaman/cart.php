<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<?php

session_start();

require_once('../algoritma/Config.php');


$auth = $_SESSION['auth'];

if (isset($_POST['submit'])) {
  $statement = $db->prepare("INSERT INTO carts(`user_id`, `product_id`, `qty`) VALUES (:user_id, :product_id, :qty)");
  $statement->bindParam(':product_id', $_POST['product_id']);
  $statement->bindParam(':user_id', $auth);
  $statement->bindParam(':qty', $_POST['qty']);
  $statement->execute();
  header("Location: ./cart.php");
}

$statement = $db->prepare("SELECT `name`, `price`, `src` FROM `products` INNER JOIN `carts` ON `products`.`id` = `carts`.`product_id` WHERE `carts`.`user_id` = $auth");
$statement->execute();

$carts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
  <form action='../algoritma/Checkout.php' method='POST'>
    <ul class="flex flex-col gap-6">
      <?php foreach ($carts as $cart) : ?>
        <li class="w-full flex gap-6">
          <!-- <?php if ($cart->status == 'pending') : ?>
            <span class="text-red-600 bg-red-300 border-red-600 rounded-md">
              Pesanan akan datang ke tujuan
            </span>
          <?php else : ?>
            <span class="text-green-600 bg-green-300 border-green-600 rounded-md">
              Pesanan Anda sudah sampai tujuan
            </span>
          <?php endif ?> -->
          <img src="./gambar/<?= $cart['src'] ?>" class="w-[100px] h-[100px]">
          <div class="flex flex-col gap-4">
            <h1 class="text-black text-lg font-serif"><?= $cart['name'] ?></h1>
            <h1 class="text-gray-800 text-md">Rp. <?= number_format($cart['price'], 0, ".", ".") ?></h1>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <button name='submit'>Buy</button>
  </form>
</body>

</html>