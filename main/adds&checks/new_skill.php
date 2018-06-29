<!DOCTYPE html>
<html>
<head>
    <title>SERENitY</title>
    <link rel="stylesheet" href="../styles/skills.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:700i|Song+Myung" rel="stylesheet">
    <?php
    require "db.php";
    ?>
    <script>

        $(document).ready(function () {
            $('#back').hide();

            $(".add_btn").bind("click", function () {

                $("#information").css("opacity", "100");

                $.ajax ({
                    url: "check_skill.php",
                    type: "POST",//тип передачи
                    data: ({name: $(".add_input").val()}),
                    dataType: "html",//также можно "text"-тип данных, которые пришлёт сервер в ответ на запрос
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
    <a id="back" href="/index.php">Go back</a><!--/нужен для пути наверх-->
    <a id="poop" href="/index.php">Unskilled?</a>
</div>

</body>
</html>