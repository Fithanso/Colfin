<?php
require "../../db.php";

if (isset($_GET['item'])) {

    $item = $_GET['item'];


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

}

header('Location: ../index.php');