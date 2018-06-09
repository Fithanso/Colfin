<?php
require_once "connect.php";

function getBlocks ($limit, $id) {
    global $mysqli;
    connectDB();
    //if($id)//если существует id
        //$where = "WHERE `id` = ".$id;
    $result_s = $mysqli->query("SELECT * FROM `skills` ORDER BY `id` ASC"); //если нужен лимит - вставить LIMIT $limit после DESC
    closeDB();

    if(!$id)//если не существует id
        return resultToArray($result_s);
    /*else
        return $result->fetch_assoc();*/

}

function resultToArray ($result) {
    $array = array();
    while (($row = $result->fetch_assoc()) != false)//? пока элементы таблицы не закончатся(true),когда заканчиваются, тогда false
        $array[] = $row;
    return $array;// по сути из всего файла возвращается значение много значений array по очереди
}

function getGoals () {
    global $mysqli;
    connectDB();
    $result = $mysqli->query("SELECT * FROM `goals` ORDER BY `id` ASC");
    closeDB();

    if(!$id)
        return resultToArray($result);
}