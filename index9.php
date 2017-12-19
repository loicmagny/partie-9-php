<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Exercice 9</title>
        <link rel="stylesheet" href="style9.css">
    </head>
    <body>
        <form method="post" action="index9.php">
            <select class="form-control" id="select" name="month">
                <?php $months = $_POST['month'];?>
                <option value="00"<?php if(isset($_POST['month']) && $_POST['month'] == "00"){echo 'selected';}?>> Mois</option>
                <option value="01"<?php if(isset($_POST['month']) && $_POST['month'] == "01"){echo 'selected';}?>> Janvier</option>
                <option value="02"<?php if(isset($_POST['month']) && $_POST['month'] == "02"){echo 'selected';}?>> Février</option>
                <option value="03"<?php if(isset($_POST['month']) && $_POST['month'] == "03"){echo 'selected';}?>> Mars</option>
                <option value="04"<?php if(isset($_POST['month']) && $_POST['month'] == "04"){echo 'selected';}?>> Avril</option>
                <option value="05"<?php if(isset($_POST['month']) && $_POST['month'] == "05"){echo 'selected';}?>> Mai</option>
                <option value="06"<?php if(isset($_POST['month']) && $_POST['month'] == "06"){echo 'selected';}?>> Juin</option>
                <option value="07"<?php if(isset($_POST['month']) && $_POST['month'] == "07"){echo 'selected';}?>> Juillet</option>
                <option value="08"<?php if(isset($_POST['month']) && $_POST['month'] == "08"){echo 'selected';}?>> Août</option>
                <option value="09"<?php if(isset($_POST['month']) && $_POST['month'] == "09"){echo 'selected';}?>> Septembre</option>
                <option value="10"<?php if(isset($_POST['month']) && $_POST['month'] == "10"){echo 'selected';}?>> Octobre</option>
                <option value="11"<?php if(isset($_POST['month']) && $_POST['month'] == "11"){echo 'selected';}?>> Novembre</option>
                <option value="12"<?php if(isset($_POST['month']) && $_POST['month'] == "12"){echo 'selected';}?>> Décembre</option>
            </select>
                <select class ="form-control" name="year">
                <?php
                for ($years = 1990; $years < 2030; $years++) {
                    ?> <option value="<?php echo $years ?>"<?php if($_POST['year'] == $years){echo 'selected';}?>><?php echo $years ?></option>
                <?php }?>
                </select>
            <button type="submit" name="validate">Valider</button>
        </form>
        <?php
        if (isset($_POST['month'])) {
            $years = $_POST['year'];
            if ($_POST['month'] == 0) {
                echo '<p>Merci de choisir un mois</p>';
            } else {
                echo '<p>' . $_POST['month'] . '/' . $_POST['year'] . '</p>';
                $numbDays = date("t", mktime(0, 0, 0, $months, 1, $years)); // nombre de jours dans le mois
                $firstDay = date("w", mktime(0, 0, 0, $months, 1, $years)); // numéro du premier jour
                $tab_jours = array("", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche"); // array des jours
                $daysBefore = date("t", mktime(0, 0, 0, ($months - 1 < 12) ? 12 : $months -= 1, 1, $years)); // nombre de jours du mois d'avant
                $daysAfter = date("t", mktime(0, 0, 0, ($months + 1 > 12) ? 1 : $months += 1, 1, $years)); // nombre de jours du mois d'apres
                $tab_cal = array(array(), array(), array(), array(), array(), array()); // tab_cal[Semaine][Jour de la semaine]
                $numbDays = ($numbDays == 0) ? 7 : $numbDays;
                $time = 1;
                $p = "";
                for ($i = 0; $i < 6; $i++) {
                    for ($day = 0; $day < 7; $day++) {
                        if ($day + 1 == $firstDay && $time == 1) {
                            $tab_cal[$i][$day] = $time;
                            $time++;
                        } // on stocke le premier jour du mois
                        elseif ($time > 1 && $time <= $numbDays) {
                            $tab_cal[$i][$day] = $p . $time;
                            $time++;
                        } // on incremente à chaque fois...
                        elseif ($time > $numbDays) {
                            $p = "*";
                            $tab_cal[$i][$day] = $p . "1";
                            $time = 2;
                        } // on a mis tout les numeros de ce mois, on commence à mettre ceux du suivant
                        elseif ($time == 1) {
                            $tab_cal[$i][$day] = "*" . ($daysAfter - ($firstDay - ($day + 1)) + 1);
                        } // on a pas encore mis les num du mois, on met ceux de celui d'avant
                    }
                }
                ?>
                <table>
                    <?php
                    echo'<thead>';
                    for ($i = 1; $i <= 7; $i++) {
                        echo('<th id="thead">' . $tab_jours[$i] . '</td>'); // on affiche les jours
                    }
                    echo'</thead>';

                    for ($i = 0; $i < 6; $i++) { // on modifie les jours spéciaux: jour actuel + jours hors mois
                        echo "<tr>";
                        for ($day = 0; $day < 7; $day++) {
                            echo "<td" . (($months == date("n") && $years == date("Y") && $tab_cal[$i][$day] == date("j")) ? ' class="today";"' : null) . ">" . ((strpos($tab_cal[$i][$day], "*") !== false) ? '<div class="wrongMonth">' . str_replace("*", "", $tab_cal[$i][$day]) . '</font>' : $tab_cal[$i][$day]) . "</td>";
                        }
                        echo "</tr>";
                    }
                }
            }
            ?>
        </table>
    </body>
</html>
