<?php

include("connect.php");

$resultaten = $conn->prepare("SELECT `id`, `titel`, `content`, `date` FROM `portfolio_items` WHERE `active` = 1");
$resultaten->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Projecten</title>
    </head>
    <body>
    <a href="portfolio_item.php">Project toevoegen</a>
        <?php
        foreach ($resultaten as $row) {
            echo "<b>".$row['titel']."</b> - ".date_format(date_create($row['date']),'d-m-Y'). "<br>";
            echo $row['content'];
            echo "<a href= 'portfolio_item_edit.php?id=" .$row['id'] . "'>
                Bewerken</a><hr />";
        }
        ?>  
    </body>
</html>