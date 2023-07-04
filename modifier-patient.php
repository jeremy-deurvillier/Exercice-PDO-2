<?php

require_once('controllers.php');

$getInfos = (isset($_GET['id']) && !empty($_GET['id']));

$patient = ($getInfos)?showDetailsPatient(intval($_GET['id'])):'Vous êtes perdu ?';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Modifier un patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>

<?php if (is_array($patient)) { ?>
    <!--update patient form -->
    <form action="controllers.php" method="post">
        <label for="id">ID :</label>
        <input type="text" name="id" readonly value="<?= $patient['id']; ?>">

        <label for="lastname">Nom :</label>
        <input type="text" name="lastname" value="<?= $patient['lastname']; ?>">

        <label for="firstname">Prénom :</label>
        <input type="text" name="firstname" value="<?= $patient['firstname']; ?>">

        <label for="birthDate">Date de naissance :</label>
        <input type="date" name="birthDate" value="<?= $patient['birthdate']; ?>">

        <label for="phone">Téléphone :</label>
        <input type="tel" pattern="[0-9]{4} [0-9]{2} [0-9]{2} [0-9]{2}" name="phone" value="<?= $patient['phone']; ?>">

        <label for="email">E-mail :</label>
        <input type="email" name="email" value="<?= $patient['mail']; ?>">

        <input type="submit" name="updatePatient" value="Mettre à jour">
    </form>
<?php } else { ?>
    <p><?= $patient; ?></p>
<?php } ?>
</body>
</html>
