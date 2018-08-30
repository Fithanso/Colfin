<?php
require "../../db.php";

if(isset($_GET['item'])) {
    $item = $_GET['item'];

    switch ($as) {
        case "delete":

            $doneQuery = $db->prepare ("DELETE FROM goals WHERE id = :item");

            $doneQuery->execute([
                'item' => $item
            ]);
            break;

    }

}

header('Location: ../index.php');