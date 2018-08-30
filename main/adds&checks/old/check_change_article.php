<?php
require "../../db.php";
$theme = $_POST['theme'];
$skill = $_POST['skill'];
$article = $_POST['article'];

$doneQuery = $db -> prepare("UPDATE themes SET article = :article WHERE name = :name AND language = :language");

$doneQuery->execute([
    'article' => $article,
    'name' => $theme,
    'language' => $skill
]);

header('Location: ../index.php');

