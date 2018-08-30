<?php
include_once "D:/ospanel/domains/testing/db.php";

function getBlocks () {
    global $mysqli;
    connectDB();
    $user_id = $_SESSION['logged_user']->id;
    $result_s = $mysqli->query("SELECT * FROM `skills` WHERE user = '$user_id'  ORDER BY `id` DESC"); //если нужен лимит - вставить LIMIT $limit после DESC
    closeDB();

        return resultToArray($result_s);
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
