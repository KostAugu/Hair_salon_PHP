<?php
function selectSQL($conn, $offset, $limit, $searchParameters, $toClients="") {
    $limit++;
   
    $sql = "SELECT time.date, count(res.date) as count, GROUP_CONCAT(res.id SEPARATOR ',') AS id, ";
    $sql .= "GROUP_CONCAT(res.client_id SEPARATOR ',') AS client_id, GROUP_CONCAT(client.name SEPARATOR ',') AS name, ";
    $sql .= "GROUP_CONCAT(res.hairdresser_id SEPARATOR ',') AS hairdresser_id, GROUP_CONCAT(hairdresser.first_name, ' ', hairdresser.last_name  SEPARATOR ',') AS employee ";
    $sql .= "FROM hair_salon.times as time left join hair_salon.reservations as res on time.date = res.date ";
    $sql .= "left join hair_salon.clients as client on res.client_id = client.id left join hair_salon.hairdressers as hairdresser on res.hairdresser_id = hairdresser.id";

    if (!empty($searchParameters)) {
        $sql .= " WHERE ";
        $sql .= searchParam($searchParameters);
    }

    $sql .= " GROUP BY time.date ";    
    if ($toClients) {
        $sql .= " HAVING count != (select count(*) from hairdressers) ";
    }    
    $sql .= " ORDER BY time.date ASC LIMIT $limit OFFSET $offset";    

    $result = $conn->query($sql);    

    if ($result && $result->num_rows > 0) {
        return $result; 
    } else {
        return [];
    }
}

function searchParam($searchParameters) {
    $sql = '';
    $count = count($searchParameters);
    foreach($searchParameters as $key => $value) {
        $sql .= "$key LIKE '%$value%' ";
        $count--;
        if ($count != 0) {
            $sql .= " AND "; 
        }
    }
    return $sql;
}

function totalRows($conn, $searchParameters = null) {
    $sql = "SELECT count(*) as total FROM hair_salon.times";   
    if(!empty($searchParameters)) {
        $sql .= " WHERE ";
        $sql .= searchParam($searchParameters);
    }    
    $result = $conn->query($sql);   
    $row = $result->fetch_assoc(); 
    return $row['total'];
}

function selectClients($conn, $date="", $id = "") {
    $sql = "SELECT distinct c.id, c.name, c.visits FROM hair_salon.clients as c left join hair_salon.reservations as r ";
    $sql .= "on c.id = r.client_id where c.id not in (select client_id from hair_salon.reservations where date=?) OR r.id=?";
    if (!($stmt = $conn->prepare($sql))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("si", $date, $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;         
    } else {
         $stmt->bind_result($id, $name, $visits);
         $result = [];
         while ($stmt->fetch()) {
            $result[] = [
                        'id' => $id,
                        'name' => $name,
                        'visits' => $visits
                        ];
         }
         $stmt->close();
         $conn->close();
         return $result;
    }
}

function selectClientsWithParameters($conn, $id = "") {
    $sql = "SELECT distinct id, name, visits FROM hair_salon.clients";

    if (!empty($id)) {
        $sql .= " WHERE id=?";
    }

    if (!($stmt = $conn->prepare($sql))) {
        die("Error: " . $conn->error);
    }     
    
    if (!empty($id)) {
        if (!$stmt->bind_param("i", $id)) { 
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;         
    } else {
         $stmt->bind_result($id, $name, $visits);
         $result = [];
         while ($stmt->fetch()) {
            $result[] = [
                        'id' => $id,
                        'name' => $name,
                        'visits' => $visits
                        ];
         }
         $stmt->close();
         $conn->close();
         return $result;
    }
}

function selectHairdressers($conn, $date, $id = "") {
    $sql = "SELECT distinct h.id, h.first_name, h.last_name FROM hair_salon.hairdressers as h left join hair_salon.reservations as r ";
    $sql .= "on h.id = r.hairdresser_id where h.id not in (select hairdresser_id from hair_salon.reservations where date=?) OR r.id=?";
    if (!($stmt = $conn->prepare($sql))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("si", $date, $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;         
    } else {
         $stmt->bind_result($id, $first_name, $last_name);
         $result = [];
         while ($stmt->fetch()) {
            $result[] = [
                        'id' => $id,
                        'first_name' => $first_name,
                        'last_name' => $last_name
                        ];
         }
         $stmt->close();
         $conn->close();
         return $result;
    }
}

function selectReservation($conn, $id) {
    $sql = "SELECT id, date, client_id, hairdresser_id FROM hair_salon.reservations WHERE id=?";
    if (!($stmt = $conn->prepare($sql))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("i", $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;         
    } else {
        $stmt->bind_result($id, $date, $client_id, $hairdresser_id);
        $result = [];
        $stmt->fetch();
        $result[] = [
                'id' => $id,
                'date' => $date,
                'client_id' => $client_id,
                'hairdresser_id' => $hairdresser_id
                ];         
        $stmt->close();
        $conn->close();
        return $result;
    }
}

function reserveTime($date, $client_id, $hairdresser_id, $conn) {
    $insert = "INSERT INTO hair_salon.reservations (date, client_id, hairdresser_id) VALUES (?,?,?)";
    if (!($stmt = $conn->prepare($insert))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("sii", $date, $client_id, $hairdresser_id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
    } else {
        $stmt->close();
        $conn->close();
        return "Laikas rezervuotas sėkmingai.";
    }
}

function updateClient($id, $name, $conn) {
    $update = "UPDATE hair_salon.clients SET name=? WHERE id=?";
    if (!($stmt = $conn->prepare($update))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("si", $name, $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
    } else {
        return "Klientas pakoreguotas sėkmingai.";
    }
}

function updateReservation($id, $client_id, $hairdresser_id, $conn) {
    $update = "UPDATE hair_salon.reservations SET client_id=?, hairdresser_id=? WHERE id=?";
    if (!($stmt = $conn->prepare($update))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("iii", $client_id, $hairdresser_id, $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
    } else {
        return "Rezervacija pakoreguota sėkmingai.";
    }
}

function deleteReservation($id, $conn) {
    $delete = "DELETE FROM hair_salon.reservations WHERE id=?";
    if (!($stmt = $conn->prepare($delete))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("i", $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
    } else {
        return "Įrašas ištrintas.";
    }
}

function deleteClient($id, $conn) {
    $delete = "DELETE FROM hair_salon.clients WHERE id=?";
    if (!($stmt = $conn->prepare($delete))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("i", $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
    } else {
        return "Įrašas ištrintas.";
    }
}


function addEmployee($first_name, $last_name, $conn) {
    $insert = "INSERT INTO hair_salon.hairdressers (first_name, last_name) VALUES (?,?)";
    if (!($stmt = $conn->prepare($insert))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("ss", $first_name, $last_name)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
    } else {
        $stmt->close();
        $conn->close();
        return "Darbuotojas įvestas sėkmingai.";
    }
}

function addClient($name, $conn) {
    $insert = "INSERT INTO hair_salon.clients (name, visits) VALUES (?, 0)";
    if (!($stmt = $conn->prepare($insert))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("s", $name)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;    
    } else {
        $stmt->close();
        $conn->close();
        return "Klientas įvestas sėkmingai.";
    }
}

function checkReservationClient($id, $conn) {
    $sql = "SELECT id FROM hair_salon.reservations WHERE client_id=?";
    if (!($stmt = $conn->prepare($sql))) {
        die("Error: " . $conn->error);
    }                
    if (!$stmt->bind_param("i", $id)) { 
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }
    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;         
    } else {
        $stmt->bind_result($client_id);
        $stmt->fetch();
        $stmt->close();
        $conn->close();
        if (empty($client_id)) {
            return true;
        } else {
            return false;
        }        
    }
}