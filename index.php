<?php
require_once "main/functions/functions.php";
require_once "main/adds&checks/db.php";
$itemsQuery = $db->prepare("
 SELECT id, name, done
 FROM goals
 Where user = :user
 ORDER BY `id` DESC
");

$itemsQuery->execute(['user' => 1]);//////////////////////////удаление: DELETE FROM `goals` WHERE `goals`.`name` = "определить name";

$items = $itemsQuery->rowCount() ? $itemsQuery : [];//если rowcount выдаёт >=0, то присваиваем значение itemsQuery, если нет, то пустой массив
?>
<!DOCTYPE html>
<html>
<head>
    <title>SERENitY</title>
    <link rel="stylesheet" href="main/styles/style.css">
    <link rel="stylesheet" href="main/styles/goals.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato:700i|Song+Myung" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Courgette|Monoton|Pathway+Gothic+One|Prompt" rel="stylesheet">
    <?php
    $blocks = getBlocks(3, $id);//по сути нам на главной странице оба аргумента не нужны, написано чтобы не было ошибки, сделано для того, чтобы передавать
    ?>
    <script>
       $(document).ready(function () {

           $('#first').on('click', function() {
               $('#goals').hide();
               $('#skills').toggle(400);

           });

           $('#second').on('click', function() {
               $('#skills').hide();
               $('#goals').toggle(400);
           });

               $('body').on('click', '.delete', function() {
                   $(this).closest('.goal').remove();
                   var parent = $(this).parent();
                   var h4 = $(parent).children(".h4");
                   $.ajax ({
                       url: "delete_goal.php",
                       type: "POST",
                       data: ({name: $(h4).text()}),
                       dataType: "html",
                       success: function (data) {
                           if(data == "true") {
                               alert("true")
                           }else if(data == "false") {
                               alert("fail");
                           }

                       }
                   });

               });
       });
    </script>
</head>
<body>
<div id="aside">
    <div id="first" class="aside_titles">
        <div class="titles"><h2>Skills</h2></div>
    </div>
    <div id="second" class="aside_titles">
        <div class="titles"><h2>Goals</h2></div>
    </div>
    <div id="second" class="aside_titles">
        <div class="titles"><h2>Projects</h2></div>
    </div>

</div>


<div id="skills">

    <div class="info"><h1>Here are themes you know</h1></div>

    <div id="add_smth"><a href="main/adds&checks/new_skill.php">New skill?</a></div>

 <div id="kill_zone"><!--рабочая область-где все блоки-->

     <?php
     for ($i = 0; $i < count($blocks); $i++) {
         $href_s = $blocks[$i]['name'];
         $block_info_s = strtoupper($blocks[$i]["name"]);
         echo '<a href="'."main/files/".$href_s.".php".'">
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

        <?php if(!empty($items)):  ?><!--Создаём всю разметку далее при условии:-->
        <ul class="items">
            <?php foreach($items as $item): ?><!--именно тут и есть "цикл", выводящий записей столько, сколько есть элементов в $items-->
            <li>
                <span class="item<?php echo $item['done'] ? ' done' : ''?>"><?php echo $item['name'] ?></span><!--если item['done'] = true, то тогда пишем "пробел" done, если false, то пусто-->
                <?php if(!$item['done']):?>
                    <a href="main/adds&checks/mark_goal.php?as=done&item=<?php echo $item['id']?>" class="done_button">Mark as done</a><!--Если задача не отмечена как выполненная в БД, то добавляем кнопку-->
                <?php endif; ?>
                <a href="main/adds&checks/del_goal.php?as=delete&item=<?php echo $item['id']?>" class="del_button">Delete</a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php else: ?>
            <p>You haven't added any items yet.</p>
        <?php endif; ?>

        <form class="item-add" action="main/adds&checks/add_goal.php" method="post">
            <input type="text" name="name" placeholder="Type a new item here." class="input" autocomplete="off" required>
            <input type="submit" value="Add" class="submit">
        </form>

    </div>
</div>

</body>
</html>


