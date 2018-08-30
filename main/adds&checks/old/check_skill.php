<?php
include_once "../../db.php";
sleep(1);

$name = trim($_POST['name']);
$prepare = $db ->prepare("SELECT * FROM skills WHERE name = :name");
$prepare->execute([

    'name' => $name
]);
$count = $prepare->rowCount();//тут проверка на дубликат

if ($count >= 1) {
    echo 'already';

}else if($_POST['name'] == '') {
        echo 'missing';
}else{
    $addedQuery = $db -> prepare("INSERT INTO skills(user, name, created)
    VALUES(:user, :name, NOW())");
    $addedQuery->execute([
        'user' => $u_id,
        'name' => $_POST['name']
    ]);

    echo 'added';
}


