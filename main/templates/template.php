<?php
require_once "../functions/functions.php";
require_once "../../db.php";
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
    <title>Colfin,<?php echo strtoupper($skill_name)?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skill_page.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700&amp;subset=cyrillic-ext" rel="stylesheet">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <?php
    $skill = getSkill($skill_name);
    $themes = getThemes($skill_name);
    $logo = strtoupper($_GET['skill']);
    $get_skill = $_GET['skill'];
    ;?>

</head>
<body>
<div id="wrapper">
    <div class="header">
        <div class="text_logo head">
            <p id="logo_text"><?php echo $logo ?></p>
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
            <a href="../adds&checks/ultimate.php?as=del_skill&skill=<?php echo $get_skill?>"><div class="del_theme"><p>Delete skill</p></div></a>
        </div>


    </div>

<div id="skill_body">
    <div id="aside">

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
        <h3>Themes<br> you know:<br><?php echo $count?></h3>
        <!--<h5>Check your themes on <p class="link">php.su</p> </h5>-->
        <a href="../adds&checks/template.php?as=n_th&skill=<?php echo $get_skill?>"><h3>New theme</h3> </a>
    </div>
    <div id="skill_themes">
        <?php for ($i=0; $i < count($themes); $i++) {
            $theme_name = $themes[$i]['name'];
            echo '<div class="skill"><a href="theme_template.php?theme='.$theme_name.'&skill='.$get_skill.'"><p>' . $theme_name . '</p></a></div>';
        }
        //вывести сообщение- еси нет тем
        ?>
    </div>
</div>
</div>
</body>
</html>

