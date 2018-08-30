<?php
require_once "../../db.php";

if(isset($_GET['skill'])) {

    $skill = $_GET['skill'];

            $deleteQuery = $db->prepare("DELETE from skills WHERE name = :name");
            $deleteQuery->execute([
                'name' => $skill
            ]);

}

header('Location: ../index.php');