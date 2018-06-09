<?php
require "db.php";

if (isset($_GET['as'], $_GET['item'])) {
    $as = $_GET['as'];
    $item = $_GET['item'];

    switch ($as) {
        case 'done':
            $doneQuery = $db->prepare("
            UPDATE goals
            SET done = 1
            WHERE id = :item
            AND user = :user
            ");

            $doneQuery->execute([
                'item' => $item,
                'user' => 1
            ]);
            break;
        case 'notdone':
            $doneQuery = $db->prepare ("
             UPDATE goals
             SET done = 0
             WHERE id = :item
             AND user = :user
             ");
            $doneQuery->execute([
                'item' => $item,
                'user' => 1
            ]);
            break;
    }
}

header('Location: /index.php');