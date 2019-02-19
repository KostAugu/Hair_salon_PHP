<?php

function createPassword($length)
{
    $chars = "abcdefghijkmnopqrstuvwxyz023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;    
    while ($i <= ($length - 1)) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }    
    return $pass;
}


function displayModal($modalWindow) {
    if ($modalWindow == 'delete') {
        echo "<script>$('#deleteForm').modal({backdrop: 'static', keyboard: false}, 'show');</script>";
    } else if ($modalWindow == 'main') {        
        echo "<script>$('#mainForm').modal({backdrop: 'static', keyboard: false}, 'show');</script>";        
    } else if ($modalWindow == 'reserve') {
        echo "<script>$('#reserveForm').modal({backdrop: 'static', keyboard: false}, 'show');</script>";
    } else if ($modalWindow == 'edit') {
        echo "<script>$('#editReserveForm').modal({backdrop: 'static', keyboard: false}, 'show');</script>";
    } else if ($modalWindow == 'deleteClient') {
        echo "<script>$('#deleteClientForm').modal({backdrop: 'static', keyboard: false}, 'show');</script>";
    } else if ($modalWindow == 'editClient') {
        echo "<script>$('#editClientForm').modal({backdrop: 'static', keyboard: false}, 'show');</script>";
    }
}

function offsetLink () {
    $params = [];
    foreach ($_GET as $key => $value) {
        if($key !='offset') {
            $params[$key] = $value;
        }
    }
    $new_query_string = http_build_query( $params );
    return $new_query_string;
}

