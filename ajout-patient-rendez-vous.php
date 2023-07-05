<?php require_once('controllers.php'); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Nouveau patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>

    <!-- Add patient form -->
    <form action="controllers.php" method="post">

        <strong>Patient</strong><br>

        <label for="lastname">Nom :</label>
        <input type="text" name="lastname">

        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname">

        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate">

        <label for="phone">Téléphone :</label>
        <input type="tel" pattern="[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}" name="phone">

        <label for="email">E-mail :</label>
        <input type="email" name="email">

        <br><strong>Rendez-vous</strong><br>

        <label for="date">Date :</label>
        <input type="date" name="date">

        <label for="hour">Heure :</label>
        <input type="time" name="hour">

        <br><input type="submit" name="addNew" value="Créer">
    </form>
</body>
</html>
