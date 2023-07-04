<?php

require_once('controllers.php');

$details = (isset($_GET['pid']) && !empty($_GET['pid']))?showDetailsPatient($_GET['pid']):'Vous êtes perdu ?';

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<?php include('menu.php'); ?>

<?php

if (is_array($details)) {

?>

<div id="pid_<?= $details['id']; ?>">
    <p>ID : <?= $details['id']; ?><p>
    <p>Identité : <?= $details['lastname']; ?> <?= $details['firstname'] ?><p>
    <p>Né(e) le : <?= date('d/m/Y', strtotime($details['birthdate'])); ?><p>
    <p>Téléphone : <?= $details['phone']; ?><p>
    <p>E-mail : <?= $details['mail']; ?><p>
</div>
<form action="/modifier-patient.php" method="get">
    <input type="hidden" name="id" value="<?= $details['id']; ?>">
    <input type="submit" name="updatePatient" value="Modifier">
</form>

<strong>Rendez-vous :</strong>

<?= showAppointsForPatient($details['id']); ?>

<?php

} else {

?>

<p><?= $details; ?></p>

<?php

}

?>
</body>
</html>
