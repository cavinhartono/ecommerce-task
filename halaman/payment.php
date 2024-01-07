<!DOCTYPE html>
<html lang="en">

<?php

$id = $_POST['product_id'];

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/output.css">
  <title>Payment</title>
</head>

<body>
  <main class="container">
    <header class="fixed top-0 left-0 w-full px-24 py-6 flex flex-col gap-4 shadow-none transition-all -translate-y-0 z-10">
      <h1 class="font-serif text-black text-2xl">Payment</h1>
      <a href="./product.php?id=<?= $id; ?>" class="font-medium text-2xl text-black">Back to Product</a>
    </header>
  </main>
</body>

</html>