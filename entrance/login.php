<?php define("check_method", "login")?>
<!DOCTYPE html>
<html>
<head>
    <title>Colfin</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#sbm_log").bind("click", function () {
                $.ajax ({
                    url: "check.php",
                    type: "POST",
                    data: ({login_log: $("#login").val(), password_log: $("#password").val(), as: "<?php echo check_method?>"}),
                    dataType: "text",
                    success: function(data) {
                        if(data == "inv_p")
                            $("#errors").text("Invalid password");
                        else if(data == "inv_l")
                            $("#errors").text("Invalid login");
                        else if(data == "ok_log")
                            document.location.href = "../main/index.php";
                    }

                });

            });
        });
    </script>
</head>
<body>
<div id="wrapper">
    <a href="index.php" class="back_button">
        <div>
            <p>Back</p>
        </div>
    </a>
  <div id="login_div" class="proto">
    <h2>Welcome back!</h2>
    <div class="forms">
        <form action="" method="POST">
            <p>
            <input type="text" name="login" id="login" value="<?php echo
            @$data['login'];?>">
            </p>

            <p>
            <input type="password" name="password" id="password" value="<?php echo
            @$data['password'];?>">
            </p>

            <p>
                <input type="button" name="do_login" id="sbm_log" class="buttons" value="Log in">
            </p>
        </form>
        <div id="errors"></div>
    </div>

  </div>
</div>
</body>
</html>

