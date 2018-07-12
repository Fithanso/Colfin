<?php
require_once "../functions/functions.php";
require_once "../adds&checks/db.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>IVY</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="skill_page.css">
    <link rel="stylesheet" href="additional.css">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <?php
    $logo = strtoupper($_GET['theme']);
    $logo_s = $_GET['theme'];
    $get_skill = $_GET['skill'];
    $theme_info = getOneTheme($logo_s, $get_skill);
    ;?>
    <script>

        $(document).ready(function () {

            $("#note_submit").bind("click", function () {
                $.ajax ({
                    url: "../adds&checks/themes/add_theme_note.php",
                    type: "POST",
                    data: ({theme: "<?php echo $logo_s?>", skill: "<?php echo $get_skill?>", name: $("#note_input").val()}),
                    dataType: "text",
                    success: function() {
                        alert("success");
                    },
                    error: function (e) {
                        debugger;/*простой дебаггер для остановки*/

                    }
                });
            });
        });

    </script>

</head>
<body>
<div id="wrapper">
    <div class="header">
        <div class="text_logo_theme head">
            <p id="logo_text_theme"><?php echo $logo ?></p>
        </div>
        <div class="creation_date head">
            <?php
            for($i = 0; $i < count($theme_info); $i++) {
                $date = $theme_info[$i]['created'];
                echo '<p>Created: '.$date.'</p>';//echo '<p>Created: '.$theme_date.'</p>';-при таком раскладе, выборке только created и без resulttoarray на странице всё пропадает почему?
            }
            ?>
        </div>

    </div>

    <div id="skill_body">
        <div id="aside">
            <div id="article">
                <p class="article_text">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque et malesuada magna, vel tristique massa. Maecenas bibendum in nulla quis dignissim. Proin posuere, nisl et pellentesque euismod, leo tellus congue nisl, vel porta nibh erat sed est. In at porttitor urna. Curabitur fringilla vulputate nunc, et lobortis erat efficitur a. Quisque condimentum eu diam at aliquet. Proin suscipit pulvinar hendrerit. Cras eu ante malesuada, convallis lacus vel, tempor leo. Etiam eu blandit purus. Morbi porttitor porta sagittis. Donec vel mi placerat, bibendum quam sed, maximus velit.<br>

                    Curabitur commodo tortor nisl, quis posuere ipsum convallis non. Nullam consectetur dolor vitae leo porttitor ultricies. Ut quis tincidunt lectus, in interdum tellus. Mauris vel commodo odio. Nam auctor tortor ac metus tincidunt, vitae vulputate nisl tempor. Donec est tellus, elementum viverra nisi vel, feugiat mattis ex. Suspendisse elementum dolor pulvinar augue consequat, vel euismod nisi dignissim. Curabitur nec ipsum arcu. Phasellus venenatis, orci et posuere rhoncus, justo sapien vehicula neque, sit amet laoreet tortor turpis vel dolor. Mauris quis vehicula ligula. Nullam scelerisque facilisis ex ac luctus. Fusce sapien eros, ultricies vitae auctor sed, aliquet vel quam.<br>

                    Nullam sit amet cursus felis, et bibendum urna. Curabitur interdum libero quis mi luctus, bibendum luctus odio ultrices. Fusce venenatis est ut elit posuere maximus. Duis aliquam porttitor placerat. Aliquam porta aliquet malesuada. Cras et risus at purus iaculis tincidunt id quis erat. Aenean ut nibh volutpat massa placerat fringilla quis sed quam. Duis nisl nunc, luctus quis iaculis eget, venenatis in turpis. Pellentesque vitae sapien nisl. Nullam ac lacus eget dui fermentum suscipit.<br>
                </p>

                <a href="../adds&checks/change_article.php?theme=<?php echo $logo_s?>&skill=<?php echo $get_skill?>"><div id="add_change_article"><p>Add or change article</p> <img src="../img/arrow-right.svg"></div></a>

            </div>

            <div id="notes">
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
