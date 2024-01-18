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

$statement = $db->prepare("SELECT `id`, `name`, `price`, `src`, `carts`.`qty` FROM `products` 
                          INNER JOIN `carts` ON `products`.`id` = `carts`.`product_id` 
                          WHERE `carts`.`user_id` = $auth");
$statement->execute();

$carts = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<body>
  <form action='../algoritma/Checkout.php' method='POST'>
    <ul class="flex flex-col gap-6">
      <?php foreach ($carts as $cart) : ?>
        <li class="w-full flex gap-6">
          <img src="./gambar/<?= $cart['src'] ?>" class="w-[100px] h-[100px]">
          <div class="flex flex-col gap-4">
            <h1 class="text-black text-lg font-serif"><?= $cart['name'] ?></h1>
            <input type='hidden' name='product_id' value='<?= $cart['id'] ?>' />
            Rp. <input type="text" class="text-gray-800 text-md" name="price" value="<?= number_format($cart['price'], 0, ".", ".") ?>" disabled> X
            <input type="text" class="text-gray-800 text-md" name="qty" value="<?= $cart['qty'] ?>" disabled>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    <button name='submit'>Buy</button>
  </form>
</body>

</html>