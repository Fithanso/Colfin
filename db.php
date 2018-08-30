<?php
require "libs/rb-mysql.php";
R::setup('mysql:host=localhost;dbname=General_project','root', '' );

$db = new PDO('mysql:dbname=General_project;host=localhost', 'root','');

$mysqli = false;
function connectDB () {
    global $mysqli;
    $mysqli = new mysqli("localhost", "root",
        "", "General_project");
    $mysqli->query("SET NAMES 'UTF-8'");
}

function closeDB () {
    global $mysqli;
    $mysqli->close();

}

session_start();

