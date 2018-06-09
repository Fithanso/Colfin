<?php
require_once "db.php";

if(isset($_POST['name'])) {//Проверка, почти что не нужна
  $name = trim($_POST['name']);

  if (!empty($name)) {
      $addedQuery = $db->prepare("
      INSERT INTO goals (name, user, done, created)
      VALUES(:name, :user, 0, NOW())
      ");

      $addedQuery->execute([
          'name' => $_POST['name'],
          'user' => 1
      ]);
  }

}

header("Location: /index.php");