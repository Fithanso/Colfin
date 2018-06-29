<!DOCTYPE html>
<html>
<head>
    <title>IVY</title>
    <link rel="stylesheet" href="../styles/skills.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:700i|Song+Myung" rel="stylesheet">
    <?php
    require "db.php";
    $logo = $_GET['skill'];
    ?>
    <script>

        $(document).ready(function () {
            $('#back').hide();

            $(".add_btn").bind("click", function () {
                $("#information").css("opacity", "100");
                /*var info = $(".hidden").html();
                alert(info);*/

                $.ajax ({//val - возвращает значение html-атрибута value
                    url: "check_theme.php",
                    type: "POST",//тип передачи
                    data: ({name: $(".add_input").eq(0).val(), language: "<?php echo $logo?>"}),// называется вхождение
                    dataType: "html",//также можно "text":тип данных, которые пришлёт сервер в ответ на запрос
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
    <a id="back" href="http://trainer/main/templates/template.php?skill=php">Go back</a><!--как сделать просто на уровень вверх-->
    <a id="poop" href="http://trainer/main/templates/template.php?skill=php">Cancel</a>
    <p class="hidden"><?php echo $logo?></p>
</div>

</body>
</html>