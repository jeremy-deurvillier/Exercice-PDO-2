<?php

require_once('controllers.php');

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Ajout d'un rendez-vous</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>

    <form action="controllers.php" method="post">
        <label for="date">Date :</label>
        <input type="date" name="date">

        <label for="hour">Heure :</label>
        <input type="time" name="hour">

        <label for="patient"></label>
        <select name="patient">
            <?= showSelectPatients(); ?>
        </select>

        <input type="submit" name="addAppointment" value="Valider">
    </form>
</body>
</html>
