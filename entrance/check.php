<?php
require_once "../db.php";

$data = $_POST;

if($data['as'] == "login") {
    $errors_log = array();
    $user = R::findOne('users', 'login=?', array($data['login_log']));
    if ($user) {
        if (password_verify($data['password_log'], $user->password)) {
            //всё хорошо, логиним пользователя
            $_SESSION['logged_user'] = $user;
            echo "ok_log";
        } else {
            $errors_log[] = 'inv_p';
        }

    } else {
        $errors_log[] = 'inv_l';
    }

    if (!empty($errors_log)) {
        echo array_shift($errors_log);
    }
} else if($data['as'] == "reg") {/*скрипт регистрирует, но не выводит ошибки*/
    $errors_reg = array();

    if(trim($data['name_reg']) == '') {
        $errors_reg[] = 'no_name';
    }
    if(trim($data['login_reg']) == '') {
        $errors_reg[] = 'no_l';
    }
    if(trim($data['email']) == '') {
        $errors_reg[] = 'no_em';
    }
    if($data['password_reg'] == '') {
        $errors_reg[] = 'no_pa';
    }
    if($data['password_reg'] != $data['password_reg_2']) {
        $errors_reg[] = 'err_2_pa';
    }
    if(R::count('users', 'login = ?', array($data['login_reg'])) > 0) {
        $errors_reg[] = 'inv_l';
    }
    if(R::count('users', 'email = ?', array($data['email'])) > 0) {
        $errors_reg[] = 'inv_em';
    }

    if(empty($errors_reg)) {
        $user = R::dispense('users');
        $user->name = $data['name_reg'];
        $user->email = $data['email'];
        $user->login = $data['login_reg'];
        $user->password = password_hash($data['password_reg'], PASSWORD_DEFAULT);
        R::store($user);
        echo 'ok_reg';
    }else{
        echo array_shift($errors_reg);
    }
}
