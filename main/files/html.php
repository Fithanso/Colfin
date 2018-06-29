<?php
require_once "../functions/functions.php";
require_once "../adds&checks/db.php";
$skill_name = $_GET['skill'];
$prepare_skill = $db->prepare("
SELECT * FROM themes
WHERE language = :skill_name
");

$prepare_skill->execute([
    'skill_name' => $skill_name
]);

$count = $prepare_skill->rowCount();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/skill_page.css">
    <?php
    $skill = getSkill($skill_name);
    $themes = getTheme($skill_name);
    $logo = strtoupper($_GET['skill']);
    ;?>
</head>
<body>
<div id="wrapper">
    <div class="header">
        <div class="text_logo head">
            <p><?php echo $logo ?></p
        </div>
        <div class="creation_date head">
            <?php
            for($i = 0; $i < count($skill); $i++) {
                $date = $skill[$i]['created'];
                echo '<p>Created: '.$date.'</p>';
            }
            ?>
        </div>
        <div class="delete_skill head">
            <div id="rotate_1"></div>
            <div id="rotate_2"></div>
        </div>
    </div>

    <div id="skill_body">

        <div id="aide">
            <h2>Rank:<br><?php
                if ($count <= 4)
                    echo 'novice';
                else if ($count >4 && $count <= 7)
                    echo 'warrior';
                else if ($count >7 && $count <= 11)
                    echo 'boyscout';
                else if ($count >11 && $count <= 14)
                    echo 'wizard';
                else if ($count >17 && $count <= 20)
                    echo 'Dragonborn';
                else if ($count > 20)
                    echo 'God';
                ?></h2>
            <h3>Themes you know:<br><?php echo $count?></h3>
        </div>

        <div id="skill_themes">
            <?php for ($i=0; $i < count($themes); $i++)
                $theme_name = $themes[$i]['name'];
            echo '<div class="skill"><p>'.$theme_name.'</p></div>';
            ?>

        </div>

    </div>
</div>
</body>
</html>