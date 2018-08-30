<?php require "../../db.php";

if(isset($_GET['as'], $_GET['theme'], $_GET['skill'])) {

    $skill = $_GET['skill'];
    $theme = $_GET['theme'];


            $delQuery = $db->prepare("DELETE FROM themes WHERE name = :name AND language = :language");

            $delQuery->execute([
                'name' => $theme,
                'language' => $skill
            ]);

}

header("Location: ../index.php");