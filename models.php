<?php

require_once('connexion.php');

$db = dbConnect();

// Crée un nouveau patient
function createPatient($lastname, $firstname, $birthDate, $phone, $email) {
    global $db;

    $request = $db->prepare('INSERT INTO patients (lastname, firstname, birthdate, phone, mail) VALUES (?, ?, ?, ?, ?);');
    $requestIsOK = $request->execute([$lastname, $firstname, $birthDate, $phone, $email]);

    if ($requestIsOK) return 'OK';

    return 'Erreur lors de l\'insertion en base de données';
}

// Liste les patients
function getAllPatients($perPage = 3, $page = 0) {
    global $db;

    $request = $db->prepare('SELECT * FROM patients ORDER BY lastname ASC LIMIT :perpage OFFSET :page;');
    $request->bindValue(':perpage', $perPage, PDO::PARAM_INT);
    $request->bindValue(':page', $perPage * $page, PDO::PARAM_INT);
    $request->execute();
    $patientList = $request->fetchAll(PDO::FETCH_ASSOC);

    return $patientList;
}

// Détails d'un seul patient
function getDetailsPatient($id) {
    global $db;

    $request = $db->prepare('SELECT * FROM patients WHERE id = :id;');
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
    $patient = $request->fetch();

    return $patient;
}

// Met à jour les données d'un patient
function updatePatient($id, $lastname, $firstname, $birthDate, $phone, $email) {
    global $db;

    $request = $db->prepare('UPDATE patients SET lastname = ?, firstname = ?, birthdate = ?, phone = ?, mail = ? WHERE id = ?;');
    $requestIsOK = $request->execute([$lastname, $firstname, $birthDate, $phone, $email, $id]);

    if ($requestIsOK) return 'OK';

    return 'Erreur lors de l\'insertion en base de données';
}

// Crée un nouveau rendez-vous
function createAppointment($dateHour, $patient) {
    global $db;

    $request = $db->prepare('INSERT INTO appointments (dateHour, idPatients) VALUES (?, ?);');
    $requestIsOK = $request->execute([$dateHour, $patient]);

    if ($requestIsOK) return 'OK';

    return 'Erreur lors de l\'insertion en base de données';
}

// Liste les rendez-vous
function getAllAppointments() {
    global $db;

    $request = $db->query('SELECT * FROM appointments ORDER BY dateHour ASC;');
    $appointsList = $request->fetchAll(PDO::FETCH_ASSOC);

    return $appointsList;
}

// Détails d'un seul rendez-vous
function getDetailsAppointments($id) {
    global $db;

    $sql = 'SELECT lastname, firstname, ap.id, dateHour, idPatients ';
    $sql .= 'FROM appointments ap ';
    $sql .= 'INNER JOIN patients p ON ap.idPatients = p.id ';
    $sql .= 'WHERE ap.id = :id';

    $request = $db->prepare($sql);
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
    $appointment = $request->fetch();

    return $appointment;
}

// Met à jour les données d'un rendez-vous
function updateAppointment($id, $dateHour, $patient) {
    global $db;

    $request = $db->prepare('UPDATE appointments SET dateHour = ?, idPatients = ? WHERE id = ?;');
    $requestIsOK = $request->execute([$dateHour, $patient, $id]);

    if ($requestIsOK) return 'OK';

    return 'Erreur lors de l\'insertion en base de données';
}

// Liste des rendez-vous d'un patient
function getAppointmentsForPatient($id) {
    global $db;

    $request = $db->prepare('SELECT * FROM appointments WHERE idPatients = :id;');
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
    $appoints = $request->fetchAll();

    return $appoints;
}

// Supprime un rendez-vous
function deleteAppointment($id) {
    global $db;

    $request = $db->prepare('DELETE FROM appointments WHERE id = :id;');
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
}

// Supprime les rendez-vous d'un patient
function deleteAppointmentsForPatient($id) {
    global $db;

    $request = $db->prepare('DELETE FROM appointments WHERE idPatients = :id;');
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
}

// Supprime un patient
function deletePatient($id) {
    global $db;

    $request = $db->prepare('DELETE FROM patients WHERE id = :id;');
    $request->bindValue(':id', $id, PDO::PARAM_INT);
    $request->execute();
}

// Recherche un patient par son nom
function getSearch($search) {
    global $db;

    $request = $db->prepare('SELECT * FROM patients WHERE lastname LIKE :search;');
    $request->bindValue(':search', $search . '%', PDO::PARAM_STR);
    $request->execute();
    $patients = $request->fetchAll();

    return $patients;
}

// Compte le nombre de patients
function countPatients() {
    global $db;

    $request = $db->query('SELECT COUNT(*) AS total FROM patients;');
    $total = $request->fetch();

    return $total;
}

// Retourne le dernier id inséré dans la table patients
function getLastIDInsert() {
    global $db;

    $request = $db->query('SELECT MAX(id) AS id FROM patients;');
    $total = $request->fetch();

    return $total;
}

?>
