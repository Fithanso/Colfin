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