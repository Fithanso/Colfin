<?php
require "db.php";

if(isset($_GET['as'], $_GET['skill'])) {
    $as = $_GET['as'];
    $skill = $_GET['skill'];

    switch ($as) {
        case "delete":
            $deleteQuery = $db->prepare("DELETE from skills WHERE name = :name");
            $deleteQuery->execute([
                'name' => $skill
            ]);
            break;
    }
}

header('Location: /index.php');