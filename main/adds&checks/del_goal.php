<?php
require "db.php";

if(isset($_GET['as'], $_GET['item'])) {
    $as = $_GET['as'];
    $item = $_GET['item'];

    switch ($as) {
        case "delete":

            $doneQuery = $db->prepare ("DELETE FROM goals WHERE goals.name = :item");

            $doneQuery->execute([
                'item' => $item
            ]);
            break;

    }

}

header('Location: /index.php');