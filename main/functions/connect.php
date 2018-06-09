<?php
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
