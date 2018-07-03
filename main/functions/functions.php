<?php
require_once "connect.php";

function getBlocks () {
    global $mysqli;
    connectDB();
    //if($id)//если существует id
        //$where = "WHERE `id` = ".$id;
    $result_s = $mysqli->query("SELECT * FROM `skills` ORDER BY `id` DESC"); //если нужен лимит - вставить LIMIT $limit после DESC
    closeDB();

    //if(!$id)//если не существует id
        return resultToArray($result_s);/*если непонятно зачем все проверки - это как сайт Дударя
    /*else
        return $result->fetch_assoc();*/

}

function resultToArray ($result) {
    $array = array();
    while (($row = $result->fetch_assoc()) != false)//? пока элементы таблицы не закончатся(true),когда заканчиваются, тогда false
        $array[] = $row;//что из себя представляет $row? массив ключ-значение? тогда $array-двумерный массив?
    return $array;// по сути из всего файла возвращается значение много значений array по очереди
}

function getSkill ($name) {
    global $mysqli;
    connectDB();
    $result_sk = $mysqli->query("SELECT * FROM skills WHERE name = '$name'");//надо обязательно ограничивать переменную кавычками!!!!!
    closeDB();

    return resultToArray($result_sk);
}

function getThemes ($lang) {
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM themes WHERE language = '$lang'");
    closeDB();
    return resultToArray($result);
}

function getOneTheme ($name, $language) {
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM themes WHERE name = '$name' AND language = '$language'");
    closeDB();
    return resultToArray($result);
}
