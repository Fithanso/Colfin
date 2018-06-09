<?php
//session_start();
require "db.php";
$data = $_POST;
$errors = [];
    if (trim($data["login_log"]) == "") {

        $errors[] = 'Check your login';

    } else if (trim($data['password_log']) == "") {

        $errors[] = 'Check your password';

    } else {

        $user = R::findOne('users', 'login=?', array($data['login_log']));
        if ($user) {
            if (password_verify($data['password_log'], $user->password)) {
                //всё хорошо, логиним пользователя
                $name_define = $data['login_log'];
                echo 'login';
                /*$info_id = $mysqli->query("SELECT `id` FROM `users` WHERE `name` = $info_id");
                $_SESSION['user_id'] = $info_id;
                exit();*/
            } else {
                $errors[] = 'Invalid password';
            }
        } else {
            $errors[] = 'Invalid login';
        }
        if (!empty($errors)) {
            $errors_no_empty = '<p id="errors" style="color: red">'.//сделать-если длина массива 2-invalid login и пароль
                array_shift($errors).'</p>';
            echo $errors_no_empty;
        }
    }
