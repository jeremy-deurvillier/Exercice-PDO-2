<?php require_once('controllers.php');  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Liste des rendez-vous</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>

    <?= showAllAppointments(); ?>
</body>
</html>
