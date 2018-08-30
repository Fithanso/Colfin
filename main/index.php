<?php
require_once "functions/functions.php";
require_once "../db.php";
$itemsQuery = $db->prepare("
 SELECT id, name, done
 FROM goals
 WHERE user = :user
 ORDER BY id DESC
");

$itemsQuery->execute(['user' => $_SESSION['logged_user']->id]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];//если rowcount выдаёт >=0, то присваиваем значение itemsQuery, если нет, то пустой массив
?>
<!DOCTYPE html>
<html>
<head>
    <title>Colfin</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/goals.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:700i|Song+Myung" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Monoton|Pathway+Gothic+One|Prompt" rel="stylesheet">
    <?php
    $blocks = getBlocks();
    ?>
    <script>
       $(document).ready(function () {

           $('#toggle_skill').on('click', function() {
               $('#goals').hide();
               $('#skills').toggle();
           });

           $('#toggle_goal').on('click', function() {
               $('#skills').hide();
               $('#goals').toggle();
           });

       });
    </script>
</head>
<body>
<div id="aside">
    <div class="img"> <img src="img/ivy.svg"> </div>
    <div id="first" class="aside_titles">
        <div class="titles_img"><img class="img_s" src="img/skills_img.svg"></div>
        <div class="titles" id="toggle_skill"><h2>Skills</h2></div>
    </div>
    <div id="second" class="aside_titles">
        <div class="titles_img"><img class="img_s" src="img/goals_img.svg"></div>
        <div class="titles" id="toggle_goal"><h2>Goals</h2></div>
    </div>
    <div id="second" class="aside_titles">
        <div class="titles"><h2>Projects</h2></div>
    </div>

</div>


<div id="skills">

    <div class="info"><h1>Here are your skills</h1></div>

    <div id="add_smth"><a href="adds&checks/template.php?as=n_sk">New skill?</a></div>

    <div id="kill_zone"><!--рабочая область-где все блоки-->

        <?php
        for ($i = 0; $i < count($blocks); $i++) {
            $href_s = $blocks[$i]['name'];
            $block_info_s = strtoupper($blocks[$i]["name"]);
            echo'<a href=templates/template.php?skill='.$href_s.'>
               <div class="skill_block">
               <h2>'.$block_info_s.'</h2>
               </div>
               </a>';

        }
        ?>

    </div>

</div>

<div id="goals">
    <div class="info"><h1>Here are your goals</h1></div>

    <div class="list">

        <?php if(!empty($items)):  ?>
        <ul class="items">
            <?php foreach($items as $item): ?>
            <li>
                <span class="item<?php echo $item['done'] ? ' done' : ''?>"><?php echo $item['name'] ?></span><!--если item['done'] = true, то тогда пишем "пробел" done, если false, то пусто-->
                <?php if(!$item['done']):?>
                    <a href="adds&checks/ultimate.php?as=mark_goal&item=<?php echo $item['id']?>" class="done_button">Mark as done</a><!--Если задача не отмечена как выполненная в БД, то добавляем кнопку-->
                <?php endif; ?>
                <a href="adds&checks/ultimate.php?as=del_goal&item=<?php echo $item['id']?>" class="del_button">Delete</a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>You haven't added any items yet.</p>
        <?php endif; ?>

        <form class="item-add" action="adds&checks/ultimate.php?as=add_goal" method="post">
            <input type="text" name="name" placeholder="Type a new goal here." class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit">
        </form>

    </div>
</div>

</body>
</html>


