<?php
require "libs/rb-mysql.php";
R::setup('mysql:host=localhost;dbname=General_project','root', '' );

$db = new PDO('mysql:dbname=General_project;host=localhost', 'root','');

