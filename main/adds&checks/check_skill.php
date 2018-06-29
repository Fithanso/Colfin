<?php
require "db.php";
sleep(1);
/*if(R::count('skills', 'name = ?', array ($_POST['name'])) > 0) {//array-потому что тип данных post-это массив
    echo 'You already know it';*/

$name = trim($_POST['name']);
$prepare = $db ->prepare("SELECT * FROM skills WHERE name = :name");
$prepare->execute([
    ///////////////////////////////как отслеживать всё????????
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
        'user' => 1,
        'name' => $_POST['name']
    ]);

    $fp = fopen("../files/".$_POST['name'].".php", "w" );
    $logo = strtoupper($_POST["name"]);
    fwrite($fp, "hello");
    fclose($fp);
    echo 'added';
}


