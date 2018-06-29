<?php
require "db.php";
sleep(1);
$lang = $_POST['language'];
$name = trim($_POST['name']);
$prepare = $db ->prepare("SELECT * FROM themes WHERE language = :language AND name = :name");
$prepare->execute([
    'language' => $lang,///////////////////////////////как отслеживать всё????????
    'name' => $name
]);
$count = $prepare->rowCount();//тут проверка на дубликат

if ($count >= 1) {
    echo 'already';
} else if ($name == ''){
    echo 'missing';
} else {
    $addQuery = $db -> prepare("INSERT INTO themes(user, name, created, language)
    VALUES(:user, :name, NOW(), :language)");
    $addQuery -> execute([
        'user' => 1,
        'name' => $name,
        'language' => $lang
    ]);

    echo 'added';
}



