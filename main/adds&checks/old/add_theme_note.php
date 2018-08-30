<?php
require_once "../../db.php";

if(isset($_POST['theme'], $_POST['skill'], $_POST['name'])) {
    $name = trim($_POST['name']);
    $theme = trim($_POST['theme']);
    $skill = trim($_POST['skill']);

    if(!empty($name)) {
        $noteAddQuery = $db->prepare("
        INSERT INTO theme_notes (user, name, theme, language) VALUES (:user, :name, :theme, :language)
        ");

        $noteAddQuery->execute([
            'user' => $u_id,
            'name' => $name,
            'theme' => $theme,
            'language' => $skill
        ]);
    }
}