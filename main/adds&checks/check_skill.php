<?php
require "db.php";
sleep(1);
if(R::count('skills', 'name = ?', array ($_POST['name'])) > 0) {
    echo 'You already know it';

}else if($_POST['name'] == '') {
        echo 'Are you kidding?';
}else{
    $addedQuery = $db -> prepare("INSERT INTO skills(user, name, created)
    VALUES(:user, :name, NOW())");
    $addedQuery->execute([
        'user' => 1,
        'name' => $_POST['name']
    ]);
    /*$skill = R::dispense('skills');
    $skill->name = $_POST["name"];
    R::store($skill);*/
    $fp = fopen("../files/".$_POST['name'].".php", "w" );
    $logo = strtoupper($_POST["name"]);//тут надо динамически определять имя заголовка
    fwrite($fp, "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <link rel=\"stylesheet\" href=\"../styles/skill_page.css\">
</head>
<body>
<div class=\"text_logo\">
    <p><?php echo $logo ?></p>
</div>
</body>
</html>
");
    fclose($fp);
    echo 'Attaboy! New skill added';
}

