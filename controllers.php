<?php

require_once('models.php');

function addPatient() {
    $lastNameIsOK = isset($_POST['lastname']) && !empty($_POST['lastname']);
    $firstNameIsOK = isset($_POST['firstname']) && !empty($_POST['firstname']);
    $birthDateIsOK = isset($_POST['birthDate']) && !empty($_POST['birthDate']);
    $phoneIsOK = isset($_POST['phone']) && !empty($_POST['phone']);
    $mailIsOK = isset($_POST['email']) && !empty($_POST['email']);

    if ($lastNameIsOK && $firstNameIsOK && $birthDateIsOK && $phoneIsOK && $mailIsOK) {
        $patientAdding = createPatient($_POST['lastname'], $_POST['firstname'], $_POST['birthDate'], $_POST['phone'], $_POST['email']);

        if ($patientAdding === 'OK') {
            header('Location:liste-patients.php');
        } else {
            header('Location:ajout-patient.php');
        }
    } else {
        return ['message' => '<p>Oups ! Un problème est survenue lors du traitement du formulaire.</p>'];
    }
}

if (isset($_POST['addPatient'])) {
    addPatient();
}

// ????
function showPatients($perPage = 3, $page = 0) {
    $patientsList = getAllPatients($perPage, $page);
    $HTMLList = '';

    if (count($patientsList) > 0) {
        $HTMLList .= '<ol>';

        foreach($patientsList as $patient) {
            $HTMLList .= '<li><a href="/profil-patient.php?pid=' . $patient['id'] . '">' . $patient['lastname'] . ' ' . $patient['firstname'] . '</a>';
            $HTMLList .= '<a href="controllers.php?deletePatientId=' . $patient['id'] . '">[Supprimer]</a></li>';
        }

        $HTMLList .= '</ol>';
    } else {
        $HTMLList .= '<p>Aucun patient pour le moment</p>';
    }

    return $HTMLList;
}

// ?????
function showDetailsPatient($id) {
    $patientDetails = getDetailsPatient(intval($id));

    if (is_array($patientDetails)) {
       return $patientDetails; 
    } else {
        return 'Aucun patient avec cet identifiant.';
    }
}

// ???
function modifyPatient() {
    $idIsOK = isset($_POST['id']) && !empty($_POST['id']);
    $lastNameIsOK = isset($_POST['lastname']) && !empty($_POST['lastname']);
    $firstNameIsOK = isset($_POST['firstname']) && !empty($_POST['firstname']);
    $birthDateIsOK = isset($_POST['birthDate']) && !empty($_POST['birthDate']);
    $phoneIsOK = isset($_POST['phone']) && !empty($_POST['phone']);
    $mailIsOK = isset($_POST['email']) && !empty($_POST['email']);

    if ($lastNameIsOK && $firstNameIsOK && $birthDateIsOK && $phoneIsOK && $mailIsOK) {
        $patientAdding = updatePatient($_POST['id'], $_POST['lastname'], $_POST['firstname'], $_POST['birthDate'], $_POST['phone'], $_POST['email']);

        if ($patientAdding === 'OK') {
            header('Location:profil-patient.php?pid='.$_POST['id']);
        } else {
            header('Location:modifier-patient.php');
        }
    } else {
        return ['message' => '<p>Oups ! Un problème est survenue lors du traitement du formulaire.</p>'];
    }
}

if (isset($_POST['updatePatient'])) {
    modifyPatient();
}

// ????
function showSelectPatients() {
    $totalPatients = countPatients()['total'];
    $patientsList = getAllPatients($totalPatients, 0);
    $HTMLList = '';

    if (count($patientsList) > 0) {

        foreach($patientsList as $patient) {
            $HTMLList .= '<option value="' . $patient['id'] . '">' . $patient['lastname'] . ' ' . $patient['firstname'] . '</option>';
        }

    }

    return $HTMLList;
}

function addAppointment() {
    $dateIsOK = isset($_POST['date']) && !empty($_POST['date']);
    $hourIsOK = isset($_POST['hour']) && !empty($_POST['hour']);
    $patientIsOK = isset($_POST['patient']) && !empty($_POST['patient']);

    if ($dateIsOK && $hourIsOK && $patientIsOK) {
        $dateHour = date('Y-m-d H:i:s', strtotime($_POST['date'] . ' ' . $_POST['hour']));
        $appointmentAdding = createAppointment($dateHour, $_POST['patient']);

        if ($appointmentAdding === 'OK') {
            header('Location:liste-rendezvous.php');
        } else {
            header('Location:ajout-rendezvous.php');
        }
    } else {
        header('Location:ajout-rendezvous.php');
    }
}

if (isset($_POST['addAppointment'])) {
    addAppointment();
}

// ????
function showAllAppointments() {
    $appointsList = getAllAppointments();
    $HTMLList = '';

    if (count($appointsList) > 0) {
        $HTMLList .= '<ol>';

        foreach($appointsList as $appoint) {
            $HTMLList .= '<li><a href="/rendezvous.php?id=' . $appoint['id'] . '">' . date('l d F Y à H:i:s', strtotime($appoint['dateHour'])) . '</a>';
            $HTMLList .= '<form action="controllers.php" method="post"><input type="hidden" name="deleteId" value="' . $appoint['id'] . '">';
            $HTMLList .= '<input type="submit" name="deleteAppoint" value="Supprimer"></form></li>';
        }

        $HTMLList .= '</ol>';
    } else {
        $HTMLList .= '<p>Aucun rendez-vous pour le moment</p>';
    }

    return $HTMLList;
}

// ?????
function showDetailsAppointment($id) {
    $appointDetails = getDetailsAppointments(intval($id));

    if (is_array($appointDetails)) {
       return $appointDetails; 
    } else {
        return 'Aucun rendez-vous avec cet identifiant.';
    }
}

function modifyAppointment() {
    $idIsOK = isset($_POST['id']) && !empty($_POST['id']);
    $dateIsOK = isset($_POST['date']) && !empty($_POST['date']);
    $hourIsOK = isset($_POST['hour']) && !empty($_POST['hour']);
    $patientIsOK = isset($_POST['patient']) && !empty($_POST['patient']);

    if ($idIsOK && $dateIsOK && $hourIsOK && $patientIsOK) {
        $dateHour = date('Y-m-d H:i:s', strtotime($_POST['date'] . ' ' . $_POST['hour']));
        $appointmentAdding = updateAppointment(intval($_POST['id']), $dateHour, $_POST['patient']);

        if ($appointmentAdding === 'OK') {
            header('Location:liste-rendezvous.php');
        } else {
            header('Location:rendezvous.php?id=' . $_POST['id']);
        }
    } else {
        header('Location:rendezvous.php?id=' . $_POST['id']);
    }
}

if (isset($_POST['modifyAppointment'])) {
    modifyAppointment();
}

function showAppointsForPatient($id) {
    $appoints = getAppointmentsForPatient(intval($id));
    $HTMLList = '';

    if (is_array($appoints)) {
        $HTMLList = '<ul>';


        foreach($appoints as $appoint) {
            $HTMLList .= '<li><a href="/rendezvous.php?id=' . $appoint['id'] . '">' . date('l d F Y à H:i:s', strtotime($appoint['dateHour'])) . '</a></li>';
        }

        $HTMLList .= '</ul>';
    } else {
        return 'Aucun rendez-vous pour ce patient.';
    }

    return $HTMLList;
}

function removeAppointment() {
    $deleteIdIsOk = (isset($_POST['deleteId']) && !empty($_POST['deleteId']));

    if ($deleteIdIsOk) {
        deleteAppointment(intval($_POST['deleteId']));
    }

    header('Location:liste-rendezvous.php');
}

if (isset($_POST['deleteAppoint']) && !empty($_POST['deleteAppoint'])) {
    removeAppointment();
}

function removePatient() {
    $deleteIdIsOk = (isset($_GET['deletePatientId']) && !empty($_GET['deletePatientId']));

    if ($deleteIdIsOk) {
        deleteAppointmentsForPatient(intval($_GET['deletePatientId']));
        deletePatient(intval($_GET['deletePatientId']));
    }

    header('Location:liste-patients.php');
}

if (isset($_GET['deletePatientId']) && !empty($_GET['deletePatientId'])) {
    removePatient();
}

function search() {
    $searchIsOk = (isset($_GET['search']) && !empty($_GET['search']));
    $patientsSearched = ($searchIsOk)?getSearch(strval($_GET['search'])):[];
    $HTMLList = '';

    if (count($patientsSearched) > 0) {
        $HTMLList .= '<ul>';

        foreach($patientsSearched as $patient) {
            $HTMLList .= '<li><a href="/profil-patient.php?pid=' . $patient['id'] . '">' . $patient['lastname'] . ' ' . $patient['firstname'] . '</a>';
            $HTMLList .= '<a href="controllers.php?deletePatientId=' . $patient['id'] . '">[Supprimer]</a></li>';
        }

        $HTMLList .= '</ul>';
    } else {
        $HTMLList .= '<p>Aucun patient avec ces critères de recherche.</p>';
    }

    return $HTMLList;
}

// Nouveau patient ET nouveau rendez-vous
function addNewPatient() {
    $lastNameIsOK = isset($_POST['lastname']) && !empty($_POST['lastname']);
    $firstNameIsOK = isset($_POST['firstname']) && !empty($_POST['firstname']);
    $birthDateIsOK = isset($_POST['birthDate']) && !empty($_POST['birthDate']);
    $phoneIsOK = isset($_POST['phone']) && !empty($_POST['phone']);
    $mailIsOK = isset($_POST['email']) && !empty($_POST['email']);
    $dateIsOK = isset($_POST['date']) && !empty($_POST['date']);
    $hourIsOK = isset($_POST['hour']) && !empty($_POST['hour']);

    if ($lastNameIsOK && $firstNameIsOK && $birthDateIsOK && $phoneIsOK && $mailIsOK && $dateIsOK && $hourIsOK) {
        $patientAdding = createPatient($_POST['lastname'], $_POST['firstname'], $_POST['birthDate'], $_POST['phone'], $_POST['email']);
        $lastId = getLastIDInsert()['id'];
        $dateHour = date('Y-m-d H:i:s', strtotime($_POST['date'] . ' ' . $_POST['hour']));
        $appointmentAdding = createAppointment($dateHour, $lastId);

        if ($patientAdding === 'OK' && $appointmentAdding === 'OK') {
            header('Location:liste-patients.php');
        } else {
            header('Location:ajout-patient-rendez-vous.php');
        }
    } else {
        header('Location:ajout-patient-rendez-vous.php');
    }
}

if (isset($_POST['addNew'])) {
    addNewPatient();
}

?>
