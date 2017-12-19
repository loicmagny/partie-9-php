<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $datetime1 = new DateTime('2016-02-01');
        $datetime2 = new DateTime('2016-03-01');
        $interval = $datetime1->diff($datetime2);
        echo $interval->format('%R%a days');
        ?>
    </body>
</html>
