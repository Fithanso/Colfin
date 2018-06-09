<?php
require "db.php";
sleep(1);
if(R::count('skills', 'name = ?', array ($_POST['name'])) > 0) {
    echo 'You already know it';

}else if($_POST['name'] == '') {
        echo 'Are you kidding?';
}else{
    $skill = R::dispense('skills');
    $skill->name = $_POST["name"];
    R::store($skill);
    $fp = fopen("../files/".$_POST['name'].".php", "w" );
    fwrite($fp,"hello");
    fclose($fp);
    echo 'Attaboy! New skill added';
}

