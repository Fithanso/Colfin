<?php
require "db.php";
$data = $_POST;
sleep(1);
if(trim($data['name']) == "")
    echo '<p style="color:red">Enter your name</p>';
else if(trim($data['login_reg']) == "")
    echo '<p style="color:red">Enter your login</p>';
else if($data['password_reg'] == "")
    echo '<p style="color:red">Enter your password</p>';
else if($data['password_reg_2'] == "")//////////////ПРОБЕЛЫ В ПАРОЛЯХ РАЗРЕШЕНЫ
    echo '<p style="color:red">Password twice</p>';
else if($data['password_reg'] != $_POST['password_reg_2'])
    echo '<p style="color:red">Check your password</p>';
else {
    $user = R::dispense('users');
    $user->name = $data['name'];
    $user->login = $data['login_reg'];
    $user->password = password_hash($data['password_reg'], PASSWORD_DEFAULT);
    R::store($user);
    echo '<p style="color:green">Registrated successfully</p>';
}


