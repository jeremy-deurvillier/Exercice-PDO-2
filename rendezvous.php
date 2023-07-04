<?php

require_once('controllers.php');

$appointIsOk = (isset($_GET['id']) && !empty($_GET['id']));

$appoint = ($appointIsOk)?showDetailsAppointment($_GET['id']):'Vous êtes perdu ?';

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Rendez-vous du jour à heure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>

<?php if (is_array($appoint)) { ?>
    <div id="<?= $appoint['id'] ?>">
        <p>ID : <?= $appoint['id']; ?></p>
        <p>Date et heure : <?= date('l d F Y à H:i:s', strtotime($appoint['dateHour'])); ?></p>
        <p>
            Patient : 
            <a href="/profil-patient.php?pid=<?= $appoint['idPatients'] ?>">
            <?= $appoint['lastname']; ?> <?= $appoint['firstname']; ?>
            </a>
        </p>
        <form action="controllers.php" method="post">
            <fieldset>
                <legend>Modifier le rendez-vous</legend>

                <input type="hidden" name="id" value="<?= $appoint['id']; ?>">

                <label for="date">Date :</label>
                <input type="date" name="date" value="<?= date('Y-m-d', strtotime($appoint['dateHour'])); ?>">

                <label for="hour">Heure :</label>
                <input type="time" name="hour" value="<?= date('H:i', strtotime($appoint['dateHour'])); ?>">

                <label for="patient"></label>
                <select name="patient">
                    <?= showSelectPatients(); ?>
                </select>

                <input type="submit" name="modifyAppointment" value="Modifier">
            </fieldset>
        </form>
    </div>
<?php } else { ?>
    <p><?= $appoint; ?></p>
<?php } ?>
</body>
</html>
