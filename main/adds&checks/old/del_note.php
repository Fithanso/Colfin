<?php
require "../../db.php";

if(isset($_GET['note'])) {

    $note = $_GET['note'];

            $doneQuery = $db->prepare("DELETE FROM theme_notes WHERE id = :note");

            $doneQuery -> execute([
                'note' => $note
            ]);

}

header('Location: ../index.php');