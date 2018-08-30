<?php
require_once "../../db.php";

if(isset($_POST['name'])) {
  $name = trim($_POST['name']);

  if (!empty($name)) {
      $addedQuery = $db->prepare("
      INSERT INTO goals (name, user, done, created)
      VALUES(:name, :user, 0, NOW())
      ");

      $addedQuery->execute([
          'name' => $_POST['name'],
          'user' => $_SESSION['logged_user']->id
      ]);
  }

}

header("Location: ../index.php");