<?php

require_once('controllers.php');

$isNotFirstPage = (isset($_GET['page']) && !empty($_GET['page']));
$page = ($isNotFirstPage)?intval($_GET['page']):0;

$totalPatients = countPatients()['total'];
$patientsPerPage = 3;
$maxPage = ceil($totalPatients / $patientsPerPage);

$patientsHTMLList = showPatients($patientsPerPage, $page);

function listPagesNumber($maxpage) {
    $page = 0;
    $HTMLpages = '<nav>';

    while ($page < $maxpage) {
        if ($page === 0) {
            $HTMLpages .= '<a href="liste-patients.php">1</a>';

            $page += 1;

            continue;
        }

        $HTMLpages .= '<a href="liste-patients.php?page=' . $page . '" style="margin:0 10px;">' . ($page + 1) . '</a>';

        $page += 1;
    }

    $HTMLpages .= '</nav>';

    return $HTMLpages;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice PDO 2 - Liste des patients</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php include('menu.php'); ?>

    <form action="liste-patients.php" method="get">
        <label for="search">Rechercher un patient :</label>
        <input type="text" name="search">
        <input type="submit" name="submitSearch" value="Rechercher">
    </form>
    <div>
        <?php        
            if (isset($_GET['submitSearch']) && !empty($_GET['submitSearch'])) {
                echo search();
            } else {
                echo $patientsHTMLList;
                echo listPagesNumber($maxPage);
            }
        ?>
    </div>
</body>
</html>
