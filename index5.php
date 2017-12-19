<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $now = time();
        $date2 = strtotime('2016-05-16 00:00:00');

        function dateDiff($date1, $date2) {
            $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
            $retour = array();

            $tmp = $diff;
            $retour['second'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['second']) / 60);
            $retour['minute'] = $tmp % 60;

            $tmp = floor(($tmp - $retour['minute']) / 60);
            $retour['hour'] = $tmp % 24;

            $tmp = floor(($tmp - $retour['hour']) / 24);
            $retour['day'] = $tmp;

            return $retour;
        }

// Test de la fonction
        var_dump(dateDiff($now, $date2));
        ?>
    </body>
</html>
