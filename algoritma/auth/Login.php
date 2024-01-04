<?php

require_once("../Config.php");

if (isset($_POST['submit'])) {
  $statement = $db->prepare("SELECT * FROM users WHERE email=:email");

  $parameter = array(
    ":email" => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
  );

  $statement->execute($parameter);

  $user = $statement->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    if (password_verify(filter_input(INPUT_POST, $_POST['password'], FILTER_SANITIZE_STRING), $user['password'])) {
      session_start();
      $_SESSION["user"] = $user;
      echo "Sukses";
    } else {
      echo "Gagal";
    }
  }
}
