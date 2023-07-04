<?php require_once('controllers.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Liste des patients</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>
    <form action="controllers.php" method="post">
        <label for="search">Rechercher un patient :</label>
        <input type="text" name="search">
        <input type="submit" name="submitSearch" value="Rechercher">
    </form>
    <div>
        <?= showPatients(); ?>
    </div>
</body>
</html>
