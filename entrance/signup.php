<!DOCTYPE html>
<html>
<head>
    <title>Colfin</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#sbm_reg").bind("click", function() {
                $.ajax ({
                    url: "check.php",
                    type: "POST",
                    data: ({name_reg: $("#name").val(), login_reg: $("#login_reg").val(), email: $("#email_reg").val(), password_reg: $("#password_reg").val(), password_reg_2: $("#password_reg_2").val(), as: "reg"}),
                    dataType: "text",
                    success: function(data) {
                        if(data == "no_name")
                            $("#errors").text("Enter your name");
                        else if(data == "no_l")
                            $("#errors").text("Enter login");
                        else if(data== "no_em")
                            $("#errors").text("Enter Email");
                        else if(data == "no_pa")
                            $("#errors").text("Enter password");
                        else if(data == "err_2_pa")
                            $("#errors").text("Verify your password");
                        else if(data == "inv_l")
                            $("#errors").text("Login already used");
                        else if(data == "inv_em")
                            $("#errors").text("Email already used");
                        else if(data == "ok_reg")
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
 <div id="register" class="proto">
    <h2>Registration</h2>
    <div class="forms">
        <form action="" method="POST">
            <input type="text" name='name' id="name" placeholder="Name">
            <input type="text" name='login_reg' id="login_reg" placeholder="Login">
            <input type="email" name="email_reg" id="email_reg" placeholder="Email">
            <input type="password" name="password_reg" id="password_reg" placeholder="Password">
            <input type="password" name="password_reg_2" id="password_reg_2" placeholder="Password verify"><br>
            <input type="button" name="sbm_reg" id="sbm_reg" class="buttons" value="Register">
        </form>
        <div id="errors"></div>
    </div>
 </div>
</div>

</body>
</html>