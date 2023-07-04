<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Ajout d'un patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>

    <!-- Add patient form -->
    <form action="controllers.php" method="post">
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

        <input type="submit" name="addPatient" value="Ajouter">
    </form>
</body>
</html>
