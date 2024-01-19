<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php

  include_once("../algoritma/Config.php");

  $statement = $db->prepare("SELECT `name`, `email`, `address` FROM `users` WHERE `id` = {$_SESSION['auth']}");
  $statement->execute();

  $user = $statement->fetchAll(PDO::FETCH_ASSOC);

  ?>

  <div class="w-full">
    <?php foreach ($user as $u) : ?>
      <h1 class='text-lg text-black'><?= $u['name'] ?></h1>
      <span class="text-md text-gray-800"><?= $u['email'] ?></span>
    <?php endforeach; ?>
  </div>
</body>

</html>