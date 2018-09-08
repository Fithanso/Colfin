<?php
require_once "../../db.php";
$u_id = $_SESSION['logged_user']->id;
/*-------------ADD GOAL----------*/
if($_GET['as'] == "add_goal") {

    if(isset($_POST['name'])) {
        $name = trim($_POST['name']);

        if (!empty($name)) {
            $addedQuery = $db->prepare("
      INSERT INTO goals (name, user, done, created)
      VALUES(:name, :user, 0, NOW())
      ");

            $addedQuery->execute([
                'name' => $_POST['name'],
                'user' => $u_id
            ]);
        }

    }

    header("Location: ../index.php");
    /*-------------MARK AS DONE---------------*/
} else if($_GET['as'] == "mark_goal") {
    if (isset($_GET['item'])) {

        $item = $_GET['item'];

        $doneQuery = $db->prepare("
            UPDATE goals
            SET done = 1
            WHERE id = :item
            AND user = :user
            ");

        $doneQuery->execute([
            'item' => $item,
            'user' => $u_id
        ]);

    }
    header('Location: ../index.php');
    /*-------------MARK AS UNDONE---------------*/
}else if($_GET['as'] == "mark_goal_und") {
    if(isset($_GET['item'])) {
        $item = $_GET['item'];

        $doneQuery = $db->prepare("
        UPDATE goals
        SET done = 0
        WHERE id = :item
        AND user = :user
        ");

        $doneQuery->execute([
            'item' => $item,
            'user' => $u_id
        ]);
    }
    header('Location: ../index.php');
    /*-------------DELETE GOAL---------------*/
} else if($_GET['as'] == "del_goal") {

    if(isset($_GET['item'])) {
        $item = $_GET['item'];

                $doneQuery = $db->prepare ("DELETE FROM goals WHERE id = :item");

                $doneQuery->execute([
                    'item' => $item
                ]);
    }

    header('Location: ../index.php');
    /*------------ADD SKILL----------------*/
} else if ($_POST['as'] == "new_skill") {

    $name = trim($_POST['name']);
    $prepare = $db ->prepare("SELECT * FROM skills WHERE name = :name AND user = :user");
    $prepare->execute([
        'name' => $name,
        'user' => $u_id
    ]);
    $count = $prepare->rowCount();//тут проверка на дубликат

    if ($count >= 1) {
        echo 'already';

    }else if($_POST['name'] == '') {
        echo 'missing';
    }else{
        $addedQuery = $db -> prepare("INSERT INTO skills(user, name, created)
    VALUES(:user, :name, NOW())");
        $addedQuery->execute([
            'user' => $u_id,
            'name' => $_POST['name']
        ]);

        echo 'added';
    }
    /*----------DELETE SKILL----------------*/
} else if($_GET['as'] == "del_skill") {
    if(isset($_GET['skill'])) {

        $skill = $_GET['skill'];

        $deleteQuery = $db->prepare("DELETE from skills WHERE name = :name AND user = :user");
        $deleteThemeQuery = $db->prepare("DELETE from themes WHERE language = :language AND user = :user");
        $deleteQuery->execute([
            'name' => $skill,
            'user' => $u_id
        ]);
        $deleteThemeQuery->execute ([
            'language' => $skill,
            'user' => $u_id
        ]);

    }

    header('Location: ../index.php');
/*------------------NEW THEME CHECK------------------------*/
} else  if($_POST['as'] == "new_th_check") {/////////////////////////////////////////////////////////////////////////////проверить юзеров

    $lang = $_POST['language'];
    $name = trim($_POST['name']);
    $prepare = $db ->prepare("SELECT * FROM themes WHERE language = :language AND name = :name");
    $prepare->execute([
        'language' => $lang,
        'name' => $name
    ]);
    $count = $prepare->rowCount();//тут проверка на дубликат

    if ($count >= 1) {
        echo 'already';
    } else if ($name == ''){
        echo 'missing';
    } else {
        $addQuery = $db -> prepare("INSERT INTO themes(user, name, created, language)
    VALUES(:user, :name, NOW(), :language)");
        $addQuery -> execute([
            'user' => $u_id,
            'name' => $name,
            'language' => $lang
        ]);

        echo 'added';
    }
    /*----------------DELETE THEME-------------------*/
} else if($_GET['as'] == "del_theme") {
    if(isset($_GET['as'], $_GET['theme'], $_GET['skill'])) {

        $skill = $_GET['skill'];
        $theme = $_GET['theme'];


        $delQuery = $db->prepare("DELETE FROM themes WHERE name = :name AND language = :language");

        $delQuery->execute([/*-----------------добавить проверку юзера*/
            'name' => $theme,
            'language' => $skill
        ]);

    }

    header("Location: ../templates/template.php?skill={$_GET['skill']}");
    /*------------ADD & CHANGE ARTICLE--------------*/
}else if($_POST['as'] == "ch_art") {
    $theme = $_POST['theme'];
    $skill = $_POST['skill'];
    $article = $_POST['article'];

    $doneQuery = $db -> prepare("UPDATE themes SET article = :article WHERE name = :name AND language = :language");

    $doneQuery->execute([
        'article' => $article,
        'name' => $theme,
        'language' => $skill
    ]);

    header('Location: ../index.php');
    /*-----------ADD THEME NOTE--------------------*/
}else if($_POST['as'] == "add_th_note") {
    if(isset($_POST['theme'], $_POST['skill'], $_POST['name'])) {
        $theme = trim($_POST['theme']);
        $skill = trim($_POST['skill']);
        $name = trim($_POST['name']);

        if(!empty($name)) {
            $noteAddQuery = $db->prepare("
        INSERT INTO theme_notes (user, name, theme, language) VALUES (:user, :name, :theme, :language)
        ");

            $noteAddQuery->execute([
                'user' => $u_id,
                'name' => $name,
                'theme' => $theme,
                'language' => $skill
            ]);
        }
    }
    /*-----------DELETE THEME NOTE------------------*/
} else if($_GET['as'] == "del_th_note") {
    if(isset($_GET['note'])) {

        $note = $_GET['note'];

        $doneQuery = $db->prepare("DELETE FROM theme_notes WHERE id = :note");

        $doneQuery -> execute([
            'note' => $note
        ]);

    }

    header("Location: ../templates/theme_template.php?theme={$_GET['theme']}&skill={$_GET['skill']}");
}
