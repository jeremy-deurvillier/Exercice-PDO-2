<?php
function dbConnect() {
    $dns = 'mysql:host=172.16.238.12;dbname=hospitalE2N';
    $user = 'root';
    $password = '';
    $db;

    try {
        $db = new PDO($dns, $user, $password);

        //echo '<p>Connecté à la base.</p>';


    } catch (Exception $error) {
        echo '<p>Une erreur est survenue.</p>';

        var_dump($error);
    }

    return $db;
}

?>
