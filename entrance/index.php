<?php
require_once "check_log.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ajax</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script>

        $(document).ready(function () {

            $("#sbm_reg").bind("click", function () {
                $.ajax ({
                    url: "check_reg.php",
                    type: "POST",
                    data: ({name:$("#name").val(),login_reg:$("#login_reg").val(),password_reg:$("#password_reg").val(),password_reg_2:$("#password_reg_2").val()}),
                    dataType: "html",
                    success: function (data) {
                            $("#under_2").html(data);
                    }
                });
            });

             $("#sbm_log").bind("click", function () {

                 $.ajax ({
                     url: "check_log.php",
                     type: "POST",
                     data: ({login_log:$("#login_log").val(),password_log:$("#password_log").val()}),
                     dataType: "html",
                     success: function (data) {
                         if(data == '<p id="errors" style="color: red">Invalid login</p>' || data == '<p id="errors" style="color: red">Invalid password</p>' || data == '<p id="errors" style="color: red">Check your password</p>' || data == '<p id="errors" style="color: red">Check your login</p>')
                             $("#under").html(data);
                         else
                             document.location.href = 'http://trainer/index.php';
                     }
                 });
             });
           });
    </script>
</head>
<body>

<div id="login" class="proto">
    <h2>Welcome back!</h2>
    <div class="forms" id="first">
        <form action="" method="POST">
            <input type="text" name="login_log" id="login_log" placeholder=" Login" autocomplete="none">
            <input type="password" name="password_log" id="password_log" placeholder=" Password">
            <input type="button" name="sbm_log" id="sbm_log" class="buttons" value="Log in">
        </form>
        <div id="under"></div>
    </div>
</div>

<div id="register" class="proto">
    <h2>Registration</h2>
    <div class="forms" id="second">
        <form action="" method="POST">
            <input type="text" name='name' id="name" placeholder=" Name">
            <input type="text" name='login_reg' id="login_reg" placeholder=" Login">
            <input type="password" name="password_reg" id="password_reg" placeholder=" Password">
            <input type="password" name="password_reg_2" id="password_reg_2" placeholder=" Password verify">
            <input type="button" name="sbm_reg" id="sbm_reg" class="buttons" value="Register">
        </form>
        <div id="under_2"></div>
    </div>
</div>
</body>
</html>

