<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['employeeEntry'])) {
        if(!isset($_SESSION['post_id']) || ($_SESSION['post_id'] != $_POST['post_id']) ){
            $_SESSION['post_id'] = $_POST['post_id'];
            $first_name = $_POST["first_name"];
            $last_name = $_POST["last_name"];
            $message = addEmployee($first_name, $last_name, connection());
        }
        $modalWindow = 'main';      
    } else if (isset($_POST['clientEntry'])) {
        if(!isset($_SESSION['post_id']) || ($_SESSION['post_id'] != $_POST['post_id']) ){
            $_SESSION['post_id'] = $_POST['post_id'];
            $name = $_POST["name"];
            $message = addClient($name, connection());
        }
        $modalWindow = 'main';  
    } else if (isset($_POST['reserve'])) {
        $date = $_POST['reserve'];
        $clients = selectClients(connection(), $date);
        $hairdressers = selectHairdressers(connection(), $date);
        $modalWindow = 'reserve'; 
    } else if (isset($_POST['clientreserve'])) {
        $date = $_POST['clientreserve']; 
        $client = true;
        $hairdressers = selectHairdressers(connection(), $date);
        $modalWindow = 'reserve'; 
    } else if (isset($_POST['reserveEntry'])) {
        if (!isset($_SESSION['post_id']) || ($_SESSION['post_id'] != $_POST['post_id'])) {
            $_SESSION['post_id'] = $_POST['post_id'];
            $client_id = isset($_POST['client_id']) ? $_POST['client_id'] : "";
            $message = reserveTime($_POST['date'], $client_id, $_POST['hairdresser_id'], connection());
            $modalWindow = 'reserve'; 
        }
    } else if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $modalWindow = 'delete'; 
    } else if (isset($_POST['deleteEntry'])) {
        if (!isset($_SESSION['post_id']) || ($_SESSION['post_id'] != $_POST['post_id'])) {
            $_SESSION['post_id'] = $_POST['post_id'];
            $message = deleteReservation($_POST['id'], connection());
            $modalWindow = 'delete'; 
        }
    } else if (isset($_POST['edit'])) { 
        $date = $_POST['date'];       
        $id = $_POST['edit'];
        $reservation = selectReservation(connection(), $id);
        $clients = selectClients(connection(), $date, $id);
        $hairdressers = selectHairdressers(connection(), $date, $id);
        $modalWindow = 'edit'; 
    } else if (isset($_POST['editReservation'])) {
        if (!isset($_SESSION['post_id']) || ($_SESSION['post_id'] != $_POST['post_id'])) {
            $_SESSION['post_id'] = $_POST['post_id'];
            $message = updateReservation($_POST['id'], $_POST['client_id'], $_POST['hairdresser_id'], connection());
            $modalWindow = 'edit'; 
        }
    } else if (isset($_POST['deleteClient'])) {
        $id = $_POST['deleteClient'];
        $modalWindow = 'deleteClient'; 
    } else if (isset($_POST['deleteClientForm'])) {
        if (!isset($_SESSION['post_id']) || ($_SESSION['post_id'] != $_POST['post_id'])) {
            $_SESSION['post_id'] = $_POST['post_id'];
            if (checkReservationClient($_POST['id'], connection())) {
                $message = deleteClient($_POST['id'], connection());
            } else {
                $message = "Klientas turi rezervaciją!";
            }            
            $modalWindow = 'deleteClient'; 
        }
    } else if (isset($_POST['editClient'])) { 
        $id = $_POST['editClient'];
        $clients = selectClientsWithParameters(connection(), $id);
        $modalWindow = 'editClient'; 
    } else if (isset($_POST['editClientForm'])) {
        if (!isset($_SESSION['post_id']) || ($_SESSION['post_id'] != $_POST['post_id'])) {
            $_SESSION['post_id'] = $_POST['post_id'];
            $message = updateClient($_POST['id'], $_POST['name'], connection());
            $modalWindow = 'editClient'; 
        }
    } 
}