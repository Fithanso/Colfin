<?php
include_once "../../db.php";

if($_GET['as'] == "n_sk") :
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Colfin</title>
        <link rel="stylesheet" href="../styles/skills.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:700i|Song+Myung" rel="stylesheet">

        <script>

            $(document).ready(function () {
                $('#back').hide();

                $(".add_btn").bind("click", function () {

                    $("#information").css("opacity", "100");

                    $.ajax ({
                        url: "ultimate.php",
                        type: "POST",//тип передачи
                        data: ({name: $(".add_input").val(), as: "new_skill"}),
                        dataType: "html",
                        beforeSend: function () {
                            $("#information").text("Wait a second...");
                        },
                        success: function(data) {
                            if(data == "already") {
                                $("#information").text("You already know it");
                            } else if(data == "missing") {
                                $("#information").text("Enter skill");
                            } else if(data == "added") {
                                $("#information").text("Attaboy! New skill added");
                                $('#back').show(200);
                                $('#poop').hide();
                            }
                        }
                    });
                });
            });
        </script>



    </head>
    <body>

    <div id="wrapper_new">
        <div id="the_great_attractor">
            <form method="post" name="skill_form">
                <input type="text" class="add_input new_skl_elem" name="skill_name" placeholder=" New skill?"><br>
                <div id="information" class="new_skl_elem"></div>
                <input type="button" class="add_btn new_skl_elem" name="add_skill_btn" value="ADD SKILL"><!--ВАЖНО!!! с тегом button весь функционал не будет работать-->
            </form>
        </div>
        <a id="back" href="../index.php">Go back</a><!--/нужен для пути наверх-->
        <a id="poop" href="../index.php">Unskilled?</a>
    </div>

    </body>
    </html>
<?php elseif($_GET['as'] == "n_th"): ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Colfin</title>
        <link rel="stylesheet" href="../styles/skills.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:700i|Song+Myung" rel="stylesheet">
        <?php
        $logo = $_GET['skill'];
        ?>
        <script>

            $(document).ready(function () {
                $('#back').hide();

                $(".add_btn").bind("click", function () {
                    $("#information").css("opacity", "100");

                    $.ajax ({
                        url: "ultimate.php",
                        type: "POST",//тип передачи
                        data: ({name: $(".add_input").eq(0).val(), language: "<?php echo $logo?>", as: "new_th_check"}),// называется вхождение
                        dataType: "html",
                        beforeSend: function () {
                            $("#information").text("Wait a second...");
                        },
                        success: function(data) {
                            switch (data) {
                                case "already":
                                    $("#information").text("You already know it");
                                    break;
                                case "missing":
                                    $("#information").text("Enter theme");
                                    break;
                                case "added":
                                    $("#information").text("New theme added!");
                                    $('#back').show(200);
                                    $('#poop').hide();
                                    break;
                            }

                        }
                    });
                });
            });
        </script>

    </head>
    <body>
    <div id="aside">
    </div>

    <div id="wrapper_new">
        <div id="the_great_attractor">
            <form method="post" name="skill_form">
                <input type="text" class="add_input new_skl_elem" name="skill_name" placeholder=" Learned smth new?"><br>
                <div id="information" class="new_skl_elem"></div>
                <input type="button" class="add_btn add_theme_btn new_skl_elem" name="add_skill_btn" value="ADD THEME"><!--ВАЖНО!!! с тегом button весь функционал не будет работать-->
            </form>
        </div>
        <a id="back" href="../templates/template.php?skill=<?php echo $logo?>">Go back</a>
        <a id="poop" href="../templates/template.php?skill=<?php echo $logo?>">Cancel</a>
        <p class="hidden"><?php echo $logo?></p>
    </div>

    </body>
    </html>
<?php elseif($_GET['as'] == "ch_art"): ?>
    <?php
    require_once "../functions/functions.php";
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>SERENitY</title>
        <link rel="stylesheet" href="../styles/change_additional.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato:700i|Song+Myung" rel="stylesheet">
        <?php

        $theme = $_GET['theme'];
        $skill = $_GET['skill'];

        $theme_info = getOneTheme($theme, $skill);
        ?>
        <script>

            $(document).ready(function () {

                $(".add_btn").bind("click", function () {

                    $.ajax ({
                        url: "ultimate.php",
                        type: "POST",
                        data: ({article: $(".add_input").val(), theme: '<?php echo $theme?>', skill: '<?php echo $skill?>', as: "ch_art"}),
                        dataType: "html",
                        success: function(data) {

                        }
                    });
                });
            });
        </script>

    </head>
    <body>

    <a id="back" href="../templates/theme_template.php?theme=<?php echo $theme?>&skill=<?php echo $skill?>">Go back</a>
    <div id="the_great_attractor">

        <form method="post" name="skill_form">
            <textarea class="add_input new_skl_elem" name="theme_text" placeholder="Just describe something">TEST<?php echo $theme_info[0]['article']?></textarea><br>
            <input type="button" class="add_btn new_skl_elem" name="add_text_btn" value="CHANGE">
        </form>

    </div>


    </body>
    </html>

<?php endif; ?>
