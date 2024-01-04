<?php

require_once("../Config.php");

if (isset($_POST['submit'])) {
  $statement = $db->prepare("INSERT INTO users(name, email, address, password) VALUES (:name, :email, :address, :password)");

  $parameter = array(
    ":name" => filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING),
    ":email" => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
    ":password" => password_hash($_POST['password'], PASSWORD_DEFAULT),
    ":address" => filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING),
  );

  $saved = $statement->execute($parameter);

  if ($saved) header("Location: ../../halaman/home.php");
}
