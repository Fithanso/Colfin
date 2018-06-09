<?php
require "libs/rb-mysql.php";
R::setup('mysql:host=localhost;dbname=General_project','root', '' );

//setcookie('user_id', 1);

//$_SESSION['user_id'] = 1;

$db = new PDO('mysql:dbname=General_project;host=localhost', 'root','');

/*if (!isset($_COOKIE['user_id'])) {
    die("You are not signed in.");
}*/