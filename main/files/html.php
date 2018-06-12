<?php

require "../functions/connect.php";

function getSkillDate () {
    $name = $_GET['skill'];
    global $mysqli;
    connectDB();

    $result_s = $mysqli->query("SELECT * FROM `skills` WHERE name = $name");
    closeDB();

    return skillResult($result_s);
}

function skillResult ($result_s) {
    $array = array();
    while (($row = $result_s->fetch_assoc()) != false)
        $array[] = $row;
    return $array;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../styles/skill_page.css">
    <?php $date = getSkillDate();?>
</head>
<body>
<div id="wrapper">
    <div class="header">
        <div class="text_logo head">
            <p><?php echo HTML ?></p>
        </div>
        <div class="creation_date head">
            <p>Created: <?php echo $date['created']?></p>
        </div>
        <div class="delete_skill head">
            <div id="rotate_1"></div>
            <div id="rotate_2"></div>
        </div>
    </div>

<div id="skill_body">

    <div id="aside">
       <h2>Rank:<br>Novice</h2>
       <h3>Themes you know:<br>42</h3>
    </div>

    <div id="skill_themes">
        <div class="skill"><p>Flexbox</p></div>
        <!--<div class="skill"><p>Window</p></div>
        <div class="skill"><p>Destroyer</p></div>
        <div class="skill"><p>Regular expression</p></div>
        <div class="skill"><p>Mother</p></div>
        <div class="skill"><p>Father</p></div>
        <div class="skill"><p>Sky</p></div>
        <div class="skill"><p>Force</p></div>
        <div class="skill"><p>Reloaded</p></div>
        <div class="skill"><p>Might</p></div>
        <div class="skill"><p>Fallout</p></div>
        <div class="skill"><p>The Elder Scrolls</p></div>
        <div class="skill"><p>The Order</p></div>
        <div class="skill"><p>Just cause</p></div>
        <div class="skill"><p>No Man's Sky</p></div>
        <div class="skill"><p>Far Cry</p></div>
        <div class="skill"><p>Unleashed</p></div>
        <div class="skill"><p>War Thunder</p></div>
        <div class="skill"><p>Minecraft</p></div>
        <div class="skill"><p>Navigate</p></div>
        <div class="skill"><p>Dark Souls</p></div>
        <div class="skill"><p>Firewatch</p></div>
        <div class="skill"><p>Euro Truck Simulator</p></div>
        <div class="skill"><p>The Wither</p></div>
        <div class="skill"><p>Beziehungsweise</p></div>
        <div class="skill"><p>Samsung</p></div>
        <div class="skill"><p>Nvidia</p></div>
        <div class="skill"><p>Schmetterling</p></div>
        <div class="skill"><p>Schwalbe</p></div>
        <div class="skill"><p>Pulkzerstoerer</p></div>
        <div class="skill"><p>Hitchhiker</p></div>-->
    </div>

</div>
</div>
</body>
</html>
