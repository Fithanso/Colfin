<?php
require_once "../functions/functions.php";
require_once "../../db.php";
$u_id = $_SESSION['logged_user']->id;
?>
<!DOCTYPE html>
<html>
<head>
    <title>Colfin</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skill_page.css">
    <link rel="stylesheet" href="additional.css">
    <link rel="stylesheet" href="../styles/goals.css"><!--для элементов notes-->
    <link href="https://fonts.googleapis.com/css?family=Noto+Serif:400,700&amp;subset=cyrillic-ext" rel="stylesheet">


    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <?php
    $logo = strtoupper($_GET['theme']);
    $logo_s = $_GET['theme'];
    $get_skill = $_GET['skill'];
    $theme_info = getOneTheme($logo_s, $get_skill);
    $notesQuery = $db->prepare("
    SELECT id, name
    FROM theme_notes
    WHERE user = :user AND theme = :theme AND language = :language
    ORDER BY id DESC
    ");

    $notesQuery->execute([
        'user' => $u_id,
        'theme' => $logo_s,
        'language' => $get_skill

    ]);

    $notes = $notesQuery->rowCount() ? $notesQuery : [];
    ;?>
    <script>

        $(document).ready(function () {

            $("#note_submit").bind("click", function () {
                $.ajax ({
                    url: "../adds&checks/ultimate.php",
                    type: "POST",
                    data: ({theme: "<?php echo $logo_s?>", skill: "<?php echo $get_skill?>", name: $("#note_input").val(), as: "add_th_note"}),
                    dataType: "text",
                    success: function() {

                    }
                    /*можно написать ajax обработчик ошибок*/
                });
            });
        });

    </script>

</head>
<body>
<div id="wrapper">
    <div class="header">
        <div class="text_logo_theme head">
            <p id="logo_text_theme"><?php echo $theme_info[0]['name'] ?></p>
        </div>
        <div class="creation_date head">
            <?php

                $date = $theme_info[0]['created'];
                echo '<p>Created: '.$date.'</p>';

            ?>
        </div>

    </div>

    <div id="skill_body">
        <div id="aside">
            <div id="article">
                <div class="article_text">
                    <?php echo $theme_info[0]['article']?>
                </div>

                <div id="add-del">
                <a href="../adds&checks/template.php?as=ch_art&theme=<?php echo $logo_s?>&skill=<?php echo $get_skill?>"><div id="add_change_article"><p>Add or change article</p> <img src="../img/arrow-right.svg"></div></a>
                <a href="../adds&checks/ultimate.php?as=del_theme&theme=<?php echo $logo_s?>&skill=<?php echo $get_skill?>"><div class="del_theme"><p>Delete theme</p></div></a>
                </div>
            </div>

            <div id="notes">
                <p>Notes</p>
                <?php if(!empty($notes)):?>
                    <ul class="items">
                    <?php foreach ($notes as $note):?>
                        <li>
                            <div class="item"><?php echo $note['name']?></div>
                            <a href="../adds&checks/ultimate.php?as=del_th_note&note=<?php echo $note['id']?>" class="del_button">Delete</a>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <form class="note-add" method="post">
                    <input type="text" name="name" placeholder="Enter text" id="note_input" autocomplete="off" required>
                    <input type="button" value="Add" id="note_submit">
                </form>
            </div>
        </div>

    </div>
</div>
</body>
</html>
